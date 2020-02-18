<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;


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
                'team_name'=>'required|string|min:5|max:255',
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
}
