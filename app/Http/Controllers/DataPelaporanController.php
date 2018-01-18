<?php

namespace App\Http\Controllers;

use App\DataPelaporan;
use App\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Mapper;
use Image;
use File;
use DB;
use Response;
use Auth;

class DataPelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByFilter(Request $req,$kota)
    {
        if($kota==="tampilkan"){
            $query="select kot, count(*) as jumlah from data_pelaporans s group by s.kot";    
        }
        else{
           $query="select kec, count(*) as jumlah from data_pelaporans s where kot=".'"'.$kota.'"'." group by s.kec";
        }


        $stat = DB::select($query);
        return Response::json($stat);
    }
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
        $query="select * from data_pelaporans where status=0";
        $stat = DB::select($query);
        return view('home',compact('data','stat'));
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
        
        $ss = 0;

        $status=DataPelaporan::create([
                'keterangan'=>$request->keterangan,
                'lat'=>$request->lat,
                'lon'=>$request->lon,
                'lokasi'=>$request->lokasi,
                'kot'=>$request->kot,
                'kec'=>$request->kec,
                'ketlok'=>$request->ketlok,
                'noTelp'=>$request->noTelp,
                'foto'=>$filename,
                'status' => $ss,
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

    public function unread()
    {
        $data=DataPelaporan::where('status',0)->orderBy('created_at','desc')->get();
        $query="select * from data_pelaporans where status=0";
        $stat = DB::select($query);
        //$data = DB::select($query);
        return view('home',compact('data','stat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataPelaporan  $dataPelaporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail(Auth::user()->id);
        $user = $user['name'];

        transaksi::create([
            'nama_petugas' => $user,
            'id_laporan' => $id 
        ]);

        $ss = 1;
        DataPelaporan::where('id',$id)->update([
            'status' => $ss,
        ]);
        
        return redirect()->route('home');
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

    public function getname($id_modal)
    {
        $query = transaksi::where('id_laporan',$id_modal)->get();
        return Response::json($query);
    }
}
