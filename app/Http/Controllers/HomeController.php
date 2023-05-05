<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
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
        // $videos = DB::table('videos')->orderByDesc('id')->paginate(5);
        $videos = Video::orderBy('id', 'DESC')->paginate(15);
        return view('home', ['videos' => $videos]);
    }
}
