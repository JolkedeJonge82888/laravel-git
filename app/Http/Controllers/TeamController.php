<?php

namespace App\Http\Controllers;

use App\Description;
use App\Offerte;
use App\Opdracht;
use App\TeamUser;
use Illuminate\Http\Request;
use App\Team;
use App\Users;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teams = Team::all();
        return view('team.index')->with('teams', $teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->isDocent()) {
            return view('team.create');
        } else {
            return redirect('/team');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isDocent()) {

            $request->validate([
                'team_name'=>'required|string|min:4|max:255',
            ]);

           Team::insert([
               'name' => $request->input('team_name'),
               'point' => 1000,
            ]);

            return redirect('/team')->with('success', 'Team has been added');
        } else {
            return redirect('/team');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $members = Team::find($id)->Users;
        $team = Team::find($id)->first();
        return view('team.show')->with('members', $members)->with('team', $team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(empty($id) || $id == '' || !isset($id) || $id == null) {
            return redirect('/team');
        } else {
            if (auth()->user()->isDocent()) {
                $team = Team::find($id);

                return view('team.edit')->with('team', $team);
            } else {
                return redirect('/team');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->isDocent()) {

            $request->validate([
                'team_name'=>'required|string|min:4|max:255',
            ]);

            $team = Team::find($id);

            $team->name = $request->input('team_name');

            $team->save();

            return redirect('/team')->with('success', 'Team has been updated');


        } else {

            return redirect('/team');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(auth()->user()->isDocent()) {

            $team = Team::find($id);
            $team->delete();

            return redirect('/team')->with('success', 'Team has been deleted successfully');

        } else {
            return redirect('/team');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function member($id)
    {
        if (auth()->user()->isDocent()) {
            $team = Team::find($id)->first();
            $users = Users::doesntHave('Team')->get();



            return view('team.member')->with('users', $users)->with('team', $team);
        } else {
            return redirect('/team');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function addMember(Request $request, $id)
    {
        if(auth()->user()->isDocent()) {

            $request->validate([
                'user'=>'required',
            ]);
            foreach($request->input('user') as $item) {

                TeamUser::insert([
                    'users_id' => (int)$item,
                    'team_id' => $id,
                ]);

            }


            return redirect('/team')->with('success', 'Member(s) has been added!');


        } else {
            return redirect('/team');
        }
    }



}
