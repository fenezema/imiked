@extends('master.masterlaporan')
@section('title') Pelaporan
@stop
@section('head')
@stop

@section('content')
    <div class="agile-movies w3layouts-content" id="hehe" style="margin-top: 10vh;">
        <div class="container">
            <div class="now-showing-movies">
                <h3 class="m-head">List Laporan</h3>
                @foreach($data as $datas)
                <div class="col-md-4 movie-preview">
                    <a href="" class="mask">
                        <img src="{{asset('/uploads/resources/'.$datas->foto)}}" class="img-responsive zoom-img" style="height: 25vh; width: 100%;" alt="" />
                        <div class="m-movie-title">
                            <a class="m-movie-link" href="">{{$datas->keterangan}}</a>
                            <div class="clearfix"></div>
                            <div class="m-r-date">
                                <p><i class="fa fa-calendar-o"></i>{{$datas->created_at->format('M d,Y h:i a')}}</p>
                                <a href="" data-toggle="modal" data-target="#{{$datas->id}}">Detail</a>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                    </a>
                </div>

                <!-- MODAL -->
                <div class="modal fade" id="{{$datas->id}}" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <h3 class="w3-head">Detail</h3>
                                    <div class="col-sm-4">
                                        <img src="{{asset('/uploads/resources/'.$datas->foto)}}" style="width:100%; height: 50vh;">
                                    </div>
                                    <div class="col-sm-4">
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
                            <div style="margin-bottom: 5vh;">
                                
                            </div>
                        </div>
                    </div>
                </div>    
                <!-- END OF MODAL -->

                @endforeach
            </div>
        </div>
    </div>
@stop

@section('script')
@stop