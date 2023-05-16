<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directory = 'C:/xampp/htdocs/remove/app/tasks';
        $patternForText = '/\\\\begin{task}((?:(?!\\\\begin{task}).)*)\\\\end{task}/s';
        $patternForSolution = '/\\\\begin{solution}((?:(?!\\\\begin{task}).)*)\\\\end{solution}/s';

        $files = scandir($directory);

        foreach ($files as $file) {
               if (pathinfo($file, PATHINFO_EXTENSION) === 'tex') {
                         $filePath = $directory . '/' . $file;
                         $latexContent = file_get_contents($filePath);
                         preg_match_all($patternForText, $latexContent, $matchesText);
                         preg_match_all($patternForSolution, $latexContent, $matcheSolution);

        $taskContentText = $matchesText[1];
        $taskContentSolution = $matcheSolution[1];
        
        for ($i = 0; $i < count($taskContentText); $i++) {
            $text = $taskContentText[$i];
            $solution = $taskContentSolution[$i];

            $taskData = [
                'id' => $i,
                'text' => $text,
                'solution' => $solution,
                
            ];

            $allTasksData[] = $taskData;
        }
        
            Tasks::Create([
                'available' => true,
                'tasks' => json_encode($allTasksData, JSON_UNESCAPED_UNICODE), // Add JSON_UNESCAPED_UNICODE option
                    'created_at' => now(),
                    'updated_at' => now(),
            ]
            );
    }
    $allTasksData = [];
  
}





       
    }
}
