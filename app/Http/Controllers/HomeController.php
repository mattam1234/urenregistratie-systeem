<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\teams;
use App\functie;
use App\verlof;
use App\currentJobs;
use App\jobs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $teams = Teams::all();
        $teamleden = User::all();
        $teamsId = teams::all('werknemerNummer');

        return view('home');
    }
}
