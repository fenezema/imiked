<?php

namespace App\Http\Controllers;

use App\DataPelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Mapper;
use Image;
use File;
class DataPelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelaporan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adduser()
    {
        return view('makeuser');
    }

    public function storeuser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'role' => "user",
            'password' => bcrypt($request->password),
        ]);
        $data=DataPelaporan::orderBy('created_at','desc')->get();
        return view('home',compact('data'));
    }
    public function store(Request $request)
    {
        if($request->hasFile('foto')){
            $foto=$request->file('foto');
            $filename=time().".".$foto->getClientOriginalExtension();
        }
        else{
            $filename="None";
        }
        

        $status=DataPelaporan::create([
                'keterangan'=>$request->keterangan,
                'lat'=>$request->lat,
                'lon'=>$request->lon,
                'lokasi'=>$request->lokasi,
                'ketlok'=>$request->ketlok,
                'noTelp'=>$request->noTelp,
                'foto'=>$filename,
            ]);
        // // The message
        // $message = "Do not reply.\r\nPELAPORAN BARU DITERIMA DARI ".$request->noTelp;

        // // In case any of our lines are larger than 70 characters, we should use wordwrap()
        // $message = wordwrap($message, 70, "\r\n");

        // // Send
        // mail('findryankurnia@gmail.com', 'PELAPORAN', $message);
        if($request->hasFile('foto')){
            Image::make($foto)->resize(1050, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path('/uploads/resources/'.$filename));
            if ($status){
                return redirect(route('lapor.submit'))->with('success', trans('Pelaporan Sukses!'));
            }
            return back()->with('error', trans('Terjadi Kesalahan. Silakan coba lagi.'));
        }
        if ($status){
            return redirect(route('lapor.submit'))->with('success', trans('Pelaporan Sukses!'));
        }
        return back()->with('error', trans('Terjadi Kesalahan. Silakan coba lagi.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataPelaporan  $dataPelaporan
     * @return \Illuminate\Http\Response
     */
    public function show(DataPelaporan $dataPelaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataPelaporan  $dataPelaporan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPelaporan $dataPelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataPelaporan  $dataPelaporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPelaporan $dataPelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataPelaporan  $dataPelaporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPelaporan $dataPelaporan,$id)
    {
        $del=DataPelaporan::findorfail($id);
        $del->delete();
        return redirect(route('home'))->with('delsuccess',trans('Laporan telah dihapus'));
    }
}
