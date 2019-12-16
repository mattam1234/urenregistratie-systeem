<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mpociot\Teamwork\TeamworkTeam;
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
        return view('home');
    }
}
