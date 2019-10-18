<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $allProjects = Project::all();

        return view('home')->with('allProjects', $allProjects);
    }
}
