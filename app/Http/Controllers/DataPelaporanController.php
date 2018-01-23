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
    public function n_notif(){
        $query="select * from data_pelaporans where status=0";
        $stat = DB::select($query);
        $count=Count($stat);
        return Response::json($count);
    }
    public function getByFilter(Request $req,$kota)
    {
        if($kota==="tampilkan"){
            $query="select kot, count(*) as jumlah from data_pelaporans s group by s.kot
            union
            select wilayah, 0 from wilayah where wilayah not in (
            select kot from data_pelaporans s group by s.kot)";
        }
        else{
            $cari_kota="select id from wilayah where wilayah=".'"'.$kota.'"';
            $id_kota=DB::select($cari_kota);
            foreach ($id_kota as $key) {
                $id_kota=$key->id;
            }

            $query="select kec, count(*) as jumlah from data_pelaporans s where s.kot=".'"'.$kota.'"'." group by s.kec
            union
            select kecamatan, 0 from kecamatan where fk_wilayah=".'"'.$id_kota.'"'." and kecamatan not in (
            select kec from data_pelaporans s where s.kot=".'"'.$kota.'"'." group by s.kec)";
        }

        $stat = DB::select($query);
        return Response::json($stat);
    }
    public function getByFilterDate($kota,$tanggal_start,$tanggal_stop){
        if($kota==="tampilkan"){
            $query="select kot, count(*) as jumlah from data_pelaporans s where date(created_at) >=".'"'.$tanggal_start.'"'." and date(created_at) <=".'"'.$tanggal_stop.'"'." group by s.kot
            union
            select wilayah, 0 from wilayah where wilayah not in (
            select kot from data_pelaporans s group by s.kot)";
        }
        else{
            $cari_kota="select id from wilayah where wilayah=".'"'.$kota.'"';
            $id_kota=DB::select($cari_kota);
            foreach ($id_kota as $key) {
                $id_kota=$key->id;
            }

            $query="select kec, count(*) as jumlah from data_pelaporans s where date(created_at) >=".'"'.$tanggal_start.'"'." and date(created_at) <=".'"'.$tanggal_stop.'"'." and s.kot=".'"'.$kota.'"'." group by s.kec
            union
            select kecamatan, 0 from kecamatan where fk_wilayah=".'"'.$id_kota.'"'." and kecamatan not in (
            select kec from data_pelaporans s where s.kot=".'"'.$kota.'"'." group by s.kec)";
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
        
        //return redirect()->route('home');
        return Response::json($ss);
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
    public function tayar($id_modal)
    {
        $flag=0;
        $user = User::findorfail(Auth::user()->id);
        $user = $user['name'];

        $cek_dist=transaksi::where('nama_petugas',$user)->get();
        foreach ($cek_dist as $key) {
            if($key->nama_petugas===$user and $key->id_laporan==$id_modal){
                $flag=1;
            }
        }
        if ($flag==1)
        {
            $ss=1;
            return Response::json($ss);
        }
        transaksi::create([
            'nama_petugas' => $user,
            'id_laporan' => $id_modal 
        ]);

        $ss = 1;
        DataPelaporan::where('id',$id_modal)->update([
            'status' => $ss,
        ]);
        
        return Response::json($ss);
    }

    public function pdf($id)
    {
        $pdf = new \fpdf\FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12,0,0);

        $data1 = DataPelaporan::where('id',$id)->get();
        $data2 = transaksi::where('id_laporan',$id)->get();
        foreach ($data2 as $key)
        {
            $key = $key->nama_petugas;
        }

        foreach ($data1 as $n) 
        {
            $pdf->Image(asset('/uploads/resources/'.$n->foto),55,30,90,60);
            $pdf->Cell(40,90,'',0,1);
            $pdf->Cell(40,10,'Nama',0,0);
            $pdf->Cell(50,10,': '.$n->created_at,0,1);
            $pdf->Cell(40,10,'Tanggal',0,0);
            $pdf->Cell(50,10,': '.$n->created_at,0,1);
            $pdf->Cell(40,10,'Nomor telepon',0,0);
            $pdf->Cell(50,10,': '.$n->noTelp,0,1);
            $pdf->Cell(40,10,'Keterangan',0,0);
            $pdf->Cell(50,10,': '.$n->keterangan,0,1);
            $pdf->Cell(40,10,'Lokasi',0,0);
            $pdf->Cell(50,10,': '.$n->lokasi,0,1);
            $pdf->Cell(40,10,'Detail Lokasi',0,0);
            $pdf->Cell(50,10,': '.$n->lokasi,0,1);
        }
        $pdf->Output();
        die;
    }
}
