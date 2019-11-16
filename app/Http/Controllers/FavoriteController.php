<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class FavoriteController extends Controller
{
    /**
     * Create an instance of FavoriteController
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all favorites
     * 
     * @return Illuminate\View\View
    */
    public function index()
    {
        $favorites = Project::where('favorite', true)->get();

        return view('favorite')->with('favorites', $favorites);
    }
}
