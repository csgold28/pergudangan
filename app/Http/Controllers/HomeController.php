<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $project = Project::with(['user','client'])->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $client = Client::where('user_id',Auth::user()->id)->orderBy('name','ASC')->get();
        return view('home',compact('project','client'));
    }
}
