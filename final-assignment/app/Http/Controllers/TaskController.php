<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function updateTasks(Request $request, $id)
    {
        $task = Task::findOrFail($id);

       $task->points = $request->input('points', $task->points);
       $task->available = $request->has('checkbox');
       $task->dateFrom = $request->input('date1', $task->dateFrom);
       $task->dateTo = $request->input('date2', $task->dateTo);

       $task->save();


        $tasks = Task::get();

        // Perform further operations with the $tasks
        
        return view('teacher.teacher', ['tasks' => $tasks]);
        // Return a response indicating the successful update
     
    }

    public function displayStudentTable(){


        $users = User::all();

        return view('teacher.teacherStudentsTable', ['users' => $users]);
    }

   
    public function  displayStudentTasks($id){



        $user = User::findOrFail($id);

        return view('teacher.teacherStudentFocus', ['user' => $user]);
    }
}
