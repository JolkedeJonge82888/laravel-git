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
        if (auth()->user()->isDocent()) {// do your magic here
            return redirect('/teacher');
        }

        if (auth()->user()->isAdmin()) {// do your magic here
            return redirect('/admin');
        }

        //DB::enableQueryLog(); // Enable query log
        $team = Users::find(Auth::user()->id)->Team->pluck('id')->first();
        //dd($team);
        if(is_null($team)) {

            return view('home');

        } else {
            $teamName = Team::all();
            $users = Team::find($team)->Users;
            return view('home', ['users' => $users, 'teams' => $teamName]);
        }

        //dd($team);
        //

    }



}
