<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    private $request;

    /**
     * Create an instance of ProjectController
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return void
    */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * Project index
     * 
     * @return Illuminate\View\View
    */
    public function index()
    {
        $allProjects = Project::all();

        return view('home')->with('allProjects', $allProjects);
    }

    /**
     * Create a new project
     * 
     * @return Illuminate\Routing\Redirector
    */
    public function create()
    {
        $project = Project::create($this->request->all());

        return redirect()->back();
    }
}
