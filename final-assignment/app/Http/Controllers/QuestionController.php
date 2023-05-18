<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update(Request $request)
    {
        $assignmentId = $request->input('assignment_id');
        $answer = $request->input('answer');

        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->answer = $answer;
        $assignment->status = 1;
        $assignment->points = 3;
        $assignment->save();

        return redirect()->back()->with('success', 'Answer updated successfully.');
    }


    public function index()
    {
        $latexFileNames = [];
        $assignments  = Assignment::where('student_id', Auth::user()->id)->get();
        $user = Auth::user()->name;

        if (Schema::hasTable('tasks')) {
            $tasks = DB::table('tasks')
                ->where('available', 1)
                ->where(function ($query) {
                    $now = Carbon::now();
                    $query->where(function ($subquery) use ($now) {
                        $subquery->whereNull('dateFrom')
                            ->whereNull('dateTo');
                    })
                        ->orWhere(function ($subquery) use ($now) {
                            $subquery->whereDate('dateFrom', '<=', $now)
                                ->whereDate('dateTo', '>=', $now);
                        });
                })
                ->get();


            foreach ($tasks as $task) {
//                $filePath = Storage::path('questions/' . $task->file);
//                if (Storage::exists($filePath)) {
                    $latexFileNames[] = $task->file;
//                }
            }
        }

        if (empty($latexFileNames)) {
            $latexFiles = Storage::files('public/questions');
            foreach ($latexFiles as $file) {
                $filename = basename($file);
                $latexFileNames[] = $filename;
            }

        }

        return view('questions.index', compact('latexFileNames', 'assignments', 'user'));
    }

    public function getRandomQuestion(Request $request)
    {
        $selectedFiles = $request->input('latex_files');

        if (!empty($selectedFiles)) {
            $selectedFile = $selectedFiles[array_rand($selectedFiles)];
            $questions = $this->extractQuestions('questions/' . $selectedFile);

            if (count($questions) > 0) {
                $randomQuestion = $questions[rand(0, count($questions) - 1)];

                $assignment = new Assignment();
                $assignment->student_id = Auth::user()->id;
                $assignment->question = $randomQuestion->question;
                $assignment->solution = $randomQuestion->solution;
                $assignment->image_path = $randomQuestion->image;
                $assignment->status = 0;
                $assignment->points = 0;
                $assignment->save();

                return redirect()->back()->with('success', 'File selected successfully.');
            } else {
                return redirect()->back()->with('error', 'No questions found in the selected file.');
            }
        } else {
            return redirect()->back()->with('error', 'No file selected.');
        }
    }



    private function extractQuestions($filePath)
    {
        $fileContents = Storage::get('public/' . $filePath);
        $pattern = '/\\\\begin{task}(.*?)\\\\end{task}(.*?)\\\\begin{solution}(.*?)\\\\end{solution}/s';
        preg_match_all($pattern, $fileContents, $matches, PREG_SET_ORDER);

        $questions = [];

        foreach ($matches as $match) {
            $question = trim($match[1]);
            $solution = trim($match[3]);
            $imagePattern = '/\\\\includegraphics{(.*?)}/';
            preg_match($imagePattern, $question, $imageMatch);

            $imageName = isset($imageMatch[1]) ? $imageMatch[1] : null;
            $imageName = basename($imageName); // Extract only the image name without the path
            $image = $imageName ? $imageName: null;

            // Remove the \includegraphics{} tag from the question
            $question = preg_replace($imagePattern, '', $question);

            $questions[] = (object) [
                'question' => $question,
                'solution' => $solution,
                'image' => $image,
            ];
        }

        return $questions;
    }

}
