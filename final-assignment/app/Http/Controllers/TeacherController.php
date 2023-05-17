<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        return view('teacher.teacher');
    }
}

//    private function extractQuestions($filePath)
//    {
//        $fileContents = file_get_contents(storage_path('app/public/' . $filePath));
//        $pattern = '/\\\\begin{task}(.*?)\\\\end{task}(.*?)\\\\begin{solution}(.*?)\\\\end{solution}/s';
//        preg_match_all($pattern, $fileContents, $matches, PREG_SET_ORDER);
//
//        $questions = [];
//
//        foreach ($matches as $match) {
//            $question = trim($match[1]);
//            $solution = trim($match[3]);
//            $imagePattern = '/\\\\includegraphics{(.*?)}/';
//            preg_match($imagePattern, $question, $imageMatch);
//
//            $imageName = isset($imageMatch[1]) ? $imageMatch[1] : null;
//            $imageName = basename($imageName); // Extract only the image name without the path
//            $image = $imageName ? $imageName : null;
//
//            // Remove the \includegraphics{} tag from the question
//            $question = preg_replace($imagePattern, '', $question);
//
//            // Convert LaTeX to MathML using MathJax API
//            $response = Http::post('https://api.mathjax.org/v4/tex', [
//                'format' => 'MathML',
//                'tex' => $question,
//            ]);
//            $mathML = $response->json('mathml');
//
//            $questions[] = (object) [
//                'question' => $mathML,
//                'solution' => $solution,
//                'image' => $image,
//            ];
//        }
//
//        return $questions;
//    }
