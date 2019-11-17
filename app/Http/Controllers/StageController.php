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
     * Get a stage using id
     * 
     * @return App\Stage
     */
    public function stage($id)
    {
        $stage = Stage::findOrFail($id);

        return $stage;
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
     * Update the stage
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function update()
    {
        $stage = Stage::findOrFail($this->request->input('stage_id'));
        $stage->update($this->request->all());

        return redirect()->back();
    }

    /**
     * Delete a stage on database
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function delete()
    {
        $stage = Stage::findOrFail($this->request->input('stage_id'));
        $stage->delete();

        return redirect()->back();
    }
}
