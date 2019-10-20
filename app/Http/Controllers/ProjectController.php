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
     * Projects list
     * 
     * @return Illuminate\View\View
    */
    public function index()
    {
        $allProjects = Project::all();

        return view('home')->with('allProjects', $allProjects);
    }

    /**
     * Project board
    */
    public function project($id) 
    {
        $project = Project::with('stages')->findOrFail($id);

        return view('project')->with('project', $project);
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

    /**
     * Delete the project
     * 
     * @return Illuminate\Routing\Redirector
    */
    public function delete()
    {
        $project = Project::findOrFail($this->request->input('id-project'));
        $project->delete();

        return redirect()->back();
    }
}
