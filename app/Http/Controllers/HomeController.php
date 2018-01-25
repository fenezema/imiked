<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataPelaporan;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DataPelaporan::orderBy('created_at','desc')->get();
        $query="select * from data_pelaporans where status=0  order by created_at desc";
        $stat = DB::select($query);
        return view('home',compact('data','stat'));
    }
}
