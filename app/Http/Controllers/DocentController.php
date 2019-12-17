<?php
namespace App\Http\Controllers;
use App\Gesprek;
use App\Opdracht;
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
            $gespreken = Opdracht::where('id', '=', $opdracht)->with('TeamGesprek')->get();
            //dd(DB::getQueryLog());
            return view('docent')->with('gespreken', $gespreken);
        }

        return view('docent');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function acceptInterview(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function assignUsertoOpdracht(Request $request)
    {

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
