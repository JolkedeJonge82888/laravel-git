<?php
namespace App\Http\Controllers;
use App\Description;
use App\Gesprek;
use App\Opdracht;
use App\TeamOpdracht;
use App\UserOpdracht;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function docent()
    {

        //dd();

        $opdrachten = Users::find(Auth::user()->id)->Opdracht->pluck('id')->all();
        //DB::enableQueryLog(); // Enable query log
        foreach($opdrachten as $opdracht)
        {

            $gespreken[] = Opdracht::find($opdracht)->TeamGesprek;

        }

        if($opdrachten == null) {

            return view('docent');

        }

        return view('docent')->with('gespreken', $gespreken);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function acceptInterview($id)
    {
        if(auth()->user()->isDocent()) {
            if(Gesprek::find($id)->pluck('check')->first() != 1) {

                $gesprek = Gesprek::find($id);
                $gesprek->check = 1;
                $gesprek->save();
                return redirect('/teacher')->with('success', 'Interview has been done!');

            } else {
                return redirect('/teacher');
            }
        } else {
            return redirect('/teacher');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     *
     * @return Response
     */
    public function assignUsertoOpdracht(Request $request)
    {
        if(auth()->user()->isDocent()) {


            $request->validate([
                'team_id'=>'required',
                'opdracht_id'=> 'required',
                'coin'=>'required',
                'startdate'=> 'required|date|after:yesterday',
                'enddate'=> 'required|date|after:startdate',

            ]);

            TeamOpdracht::insert([
                'team_id' => (int)$request->input('team_id'),
                'opdracht_id' => (int)$request->input('opdracht_id'),
                'point' => (int)$request->input('coin'),
                'start_date' => $request->input('startdate'),
                'end_date' => $request->input('enddate'),
            ]);
            Gesprek::where('opdracht_id', '=', (int)$request->input('opdracht_id'))->delete();
            return redirect('/teacher')->with('success', 'Added team to this assignment');
        } else {
            return redirect('/teacher');
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

        } else {
            return redirect('/teacher');
        }
    }

}
