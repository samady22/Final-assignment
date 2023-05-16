<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tasks;

class TeacherController extends Controller
{

    public function index()
    {
        
        $tasks = Tasks::get();

        // Perform further operations with the $tasks
        
        return view('teacher.teacher', ['tasks' => $tasks]);
    }
}
