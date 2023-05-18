<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;


class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $tasks = Task::get();

        // Perform further operations with the $tasks
        
        return view('teacher.teacher', ['tasks' => $tasks]);
    }
}
