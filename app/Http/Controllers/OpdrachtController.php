<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Opdracht;
use App\Description;


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


            $description = Description::create(['text' => $request->input('opdracht_description')]);

            Opdracht::insert([
                'klant_id' => Auth::user()->id,
                'title' => $request->input('opdracht_title'),
                'start_date' => $request->input('opdracht_startdate'),
                'end_date' => $request->input('opdracht_enddate'),
                'description_id' => $description->id,
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
            $opdracht = Opdracht::find($id)->Description;

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


        } else {
            return redirect('/opdracht');
        }
    }
}
