<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // File:files
       header('Content-Type: text/html; charset=UTF-8');
        $directory = File::files(storage_path('app/public/questions'));
        $pattern= '/\\\\begin{task}(.*?)\\\\end{task}(.*?)\\\\begin{solution}(.*?)\\\\end{solution}/s';



        

        //$files = scandir($directory);
        $latexFileNames = [];

       // foreach ($directory as $file) {
      //     $latexFileNames[] = $file->getFilename();
      //  }

        foreach ($directory as $file) {
               if (pathinfo($file, PATHINFO_EXTENSION) === 'tex') {
                         $filePath = $file->getPathname();
                         
                         $latexContent = file_get_contents($filePath);
                         $latexContent = preg_replace('/\\\\begin{equation\*}(.*?)\\\\end{equation\*}/s', '$1',  $latexContent);
                         //dd($pattern);
                         preg_match_all($pattern, $latexContent, $matches, PREG_SET_ORDER);
                        // dd($matches);
                         
                         $questions = [];

         foreach ($matches as $match) {
            
           
            $question = trim($match[1]);
            $solution = trim($match[3]);
            $imagePattern = '/\\\\includegraphics{(.*?)}/';
            preg_match($imagePattern, $question, $imageMatch);

            $imageName = isset($imageMatch[1]) ? $imageMatch[1] : null;
            $imageName = basename($imageName); // Extract only the image name without the path
            $image = $imageName ? $imageName : null;

            // Remove the \includegraphics{} tag from the question
            $question = preg_replace($imagePattern, '', $question);

            $questions[] = (object)[
                'text' => $question,
                'solution' => $solution,
                'image' => $image,
            ];
        }
        
        
            Task::Create([
                'available' => true,
                'file' => $file->getFilename(),
                'tasks' => json_encode($questions, JSON_UNESCAPED_UNICODE), // Add JSON_UNESCAPED_UNICODE option
                    'created_at' => now(),
                    'updated_at' => now(),
            ]
            );
    }
    $questions = [];
  
}    
    }
}
