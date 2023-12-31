<?php

namespace App\Http\Controllers;

use App\Team;
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
//        if (auth()->user()->functieId === 1){
//            $currentjob = auth()->user()->task;
//            $team = auth()->user()->currentTeam;
//            if ($team !== null){
//                $teamleden = auth()->user()->currentTeam->users;
//                return view('home')->with('teamleden' , $teamleden)->with('team', $team);
//            }
//            if ($currentjob !== null){
//                return view('home')->with('currentjob' , $currentjob);
//            }
//            return view('home');
//        }

//        if (auth()->user()->functieId === 2){
        $tasks = auth()->user()->tasks;
        $projects = auth()->user()->project;
        $team = auth()->user()->currentTeam;
        if ($projects && $tasks) {
            return view('admin.home')->with('projecten', $projects)->with('tasks' , $tasks);
        }
        if ($team) {
            $teamleden = auth()->user()->currentTeam->users;
            return view('admin.home')->with('teamleden', $teamleden)->with('team', $team);
        }
        if ($projects) {
            return view('admin.home')->with('projecten', $projects);
        }
        if ($tasks) {
            return view('admin.home')->with('tasks', $tasks);
        }
        return view('admin.home');
//        }

    }
}
