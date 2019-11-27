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


        DB::enableQueryLog(); // Enable query log
        $team = Users::find(Auth::user()->id)->Team->pluck('id');

        if(is_null($team) || empty($team) || strlen($team) < 1 ? NULL : $team) {

            return view('home');

        } else {

            $users = Team::where('id', '=', $team)->with('Users')->pluck('name');
            dd($users);


            return view('home', ['users' => $user]);
        }

        //dd($team);
        //

    }



}
