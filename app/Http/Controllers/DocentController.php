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
        //DB::enableQueryLog(); // Enable query log
        //dd();
        $opdrachten = Users::find(Auth::user()->id)->Opdracht->pluck('id')->all();
        foreach($opdrachten as $opdracht)
        {
            $gespreken = Opdracht::find($opdracht)->TeamGesprek;
            return view('docent')->with('gespreken', $gespreken);
        }
        //dd(DB::getQueryLog());

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
