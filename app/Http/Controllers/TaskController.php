<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    protected $request;

    /**
     * Create a new instance of TaskController
     * 
     * @return void
    */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * Create new task on stage
     * 
     * @return 
    */
    public function create()
    {
        $task = Task::create($this->request->all());

        return $task ? $task : false;
    }
}
