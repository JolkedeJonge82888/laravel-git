<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Users;
use App\Team;


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
        DB::enableQueryLog();



        DB::enableQueryLog(); // Enable query log
        $team = Users::find(Auth::user()->id)->Team->pluck('id');
        if($team == null) {

            return view('home');

        } else {
            $user = Team::find($team)->Users->pluck('name');
            dd(DB::getQueryLog());
//            $teamMembers = Teams::join('Team_student', 'Team.ID', '=', 'Team_student.TeamID')
//                ->join('users', 'Team_student.userID', '=', 'users.id')
//                ->select('users.name', 'users.username')
//                ->where('Team.ID', '=', $team)
//                ->get();

            return view('home', ['team' => $teamMembers]);
        }

        //dd($team);
        //dd(DB::getQueryLog());

    }



}
