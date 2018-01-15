@extends('master.masterlaporan')
@section('title') Pelaporan
@stop
@section('head')
@stop

@section('content')
<div class="container" style="margin-top: 18vh;">
    <h3 class="text-center"><span style="font-weight: bold;"> Kota/Kab </span>Kediri
        <span style="font-weight: bold;"> Kec </span>Sukolilo</h3>
    <h4 class="text-center"><span style="font-weight: bold;"> Tanggal </span>18 Januari 2018</h4>
    <div class="row" style="margin-top: 5vh;">
        <div class='col-sm-4'>
            <label>Tanggal</label>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <label>Kota/Kab</label>
            <div class="form-group">
                <select class="form-control" data-live-search="true" >
                    <option>Kediri</option>
                    <option>Jombang</option>
                    <option>Jakarta</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <label>Kecamatan</label>
            <div class="form-group">
                <select class="form-control" data-live-search="true" >
                    <option>Kediri</option>
                    <option>Jombang</option>
                    <option>Jakarta</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @if(session('delsuccess'))
        <div class="col-sm-12 col-xs-12">
            <div class="alert alert-success">
                {{session('delsuccess')}}
            </div>
        </div>
        @endif
        @foreach($data as $datas)
        <div class="col-md-4 movie-preview">
            <a href="" class="mask">
                <img src="{{asset('/uploads/resources/'.$datas->foto)}}" class="img-responsive zoom-img" style="height: 25vh; width: 100%;" alt="" />
            </a>
            <div class="m-movie-title">
                <a class="m-movie-link" href="">{{$datas->keterangan}}</a>
                <p><i class="fa fa-calendar-o"></i>&nbsp;{{$datas->created_at->format('d M Y h:i a')}}</p>
                <a href="" data-toggle="modal" data-target="#{{$datas->id}}">Detail</a>
                @if(Auth::user()->role=="admin")
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#delModal">Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="delModal" role="dialog">
                        <div class="modal-dialog">

                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Data oleh {{$datas->noTelp}}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Hapus data dari {{$datas->noTelp}}. Anda yakin? </p>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="{{URL::to('/home/'.$datas->id)}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="modal fade" id="{{$datas->id}}" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                            <h3>Detail</h3>
                                <div class="col-sm-6">
                                    <img src="{{asset('/uploads/resources/'.$datas->foto)}}" style="width:100%; height: 50vh;">
                                </div>
                                <div class="col-sm-6">
                                    <p class="sed-para">Lokasi</p>
                                    <p class="para1">{{$datas->lokasi}}</p>
                                    <p class="para1">{{$datas->ketlok}}</p>
                                    <p class="sed-para">Keterangan</p>
                                    <p class="para1">{{$datas->keterangan}}</p>
                                    <p class="para1">Nomor HP : {{$datas->noTelp}}</p>
                                    <p class="para1">Tanggal : {{$datas->created_at->format('M d,Y h:i a')}}</p>
                                    <p class="para1"><form action="{{URL::to('https://www.google.co.id/maps/place/'.$datas->lat.",".$datas->lon)}}">
                                        <button class="btn btn-primary">Tampilkan Map&nbsp;<span class="fa fa-map fa-2x"></span></button>
                                    </form></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 5vh;">
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>        
</div>
@stop

@section('script')
@stop