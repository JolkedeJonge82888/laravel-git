<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DocentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function docent()
    {
        return view('docent');
    }
}
