<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Stage;

class StageController extends Controller
{
    protected $request;

    /**
     * Create an instance of StageController
     * 
     * @return void
    */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * Create a new stage on project
     * 
     * @return Illuminate\Routing\Redirector
    */
    public function create()
    {
        $project = Project::findOrFail($this->request->input('project_id'));
        $stage = $project->stages()->create($this->request->all());

        return redirect()->back();
    }

    /**
     * Delete a stage on database
     * 
     * @return
     */
    public function delete()
    {
        $stage = Stage::findOrFail($this->request->input('stage_id'));
        $stage->delete();

        return redirect()->back();
    }
}
