<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Package;
use Illuminate\Http\Request;

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
        try
        {  $packages=Package::where('status',1)->get();
           $curriences=Currency::where('status',1)->get();
            return view('home',compact('packages','curriences'));
        }
        catch(\Exception $e)
        {
            return $this->ErrorMessage($e);
        }

    }
}
