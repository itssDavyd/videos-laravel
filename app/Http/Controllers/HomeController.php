<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //Asi tenemos dispuesto todos los videos de la tabla usando queryBuilder.
        $videos = DB::table('videos')->orderByDesc('id')->paginate(5);
        return view('home', ['videos' => $videos]);
    }
}
