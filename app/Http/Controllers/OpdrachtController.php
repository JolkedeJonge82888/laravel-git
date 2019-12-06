<?php

namespace App\Http\Controllers;

use App\UserOpdracht;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Opdracht;
use App\Description;
use Illuminate\Support\Facades\DB;


class OpdrachtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->middleware('auth');
        $opdrachts = Opdracht::with('Description')->get();
        return view('opdracht.index')->with('opdrachts', $opdrachts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->isDocent()) {
            return view('opdracht.create');
        } else {
            return redirect('/opdracht');
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
                'opdracht_title'=>'required|string|min:8|max:255',
                'opdracht_startdate'=> 'required|date',
                'opdracht_enddate'=> 'required|date',
                'opdracht_description' => 'required|string'
            ]);

            $description = Description::create(['text' => $request->input('opdracht_description')]);

            $opdrachtID = Opdracht::insertGetId([
                'title' => $request->input('opdracht_title'),
                'start_date' => $request->input('opdracht_startdate'),
                'end_date' => $request->input('opdracht_enddate'),
                'description_id' => $description->id,
            ]);

            UserOpdracht::insert([
                'users_id' => Auth::user()->id,
                'opdracht_id' => $opdrachtID,
            ]);

            return redirect('/opdracht')->with('success', 'Opdracht has been added');
        } else {
            return redirect('/opdracht');
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

        $opdracht = Opdracht::find($id);
        $klant = Opdracht::find($id)->Users->pluck('name')->first();

        return view('opdracht.show')->with('opdracht', $opdracht)->with('klant', $klant);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->isDocent()) {
            $opdracht = Opdracht::find($id);

            return view('opdracht.edit')->with('opdracht', $opdracht);
        } else {
            return redirect('/opdracht');
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
                'opdracht_title'=>'required|string|min:8|max:255',
                'opdracht_startdate'=> 'required|date',
                'opdracht_enddate'=> 'required|date',
                'opdracht_description' => 'required|string'
            ]);

            $opdracht = Opdracht::find($id);

            $opdracht->title = $request->input('opdracht_title');
            $opdracht->start_date = $request->input('opdracht_startdate');
            $opdracht->end_date = $request->input('opdracht_enddate');
            $description = Description::find($opdracht->klant_id);
            $description->text = $request->input('opdracht_description');
            $opdracht->save();
            $description->save();

            return redirect('/opdracht')->with('success', 'Opdracht has been updated');


        } else {
            return redirect('/opdracht');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(auth()->user()->isDocent()) {
            $share = Opdracht::find($id);
            $share->delete();

            return redirect('/opdracht')->with('success', 'Opdracht has been deleted Successfully');

        } else {
            return redirect('/opdracht');
        }
    }
}
