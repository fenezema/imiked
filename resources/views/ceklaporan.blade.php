@extends('master.master')
@section('title') Pelaporan
@stop
@section('head')
@stop

@section('content')
    <div class="agile-movies w3layouts-content" id="hehe">
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
                            <div class="contact-section w3layouts-content">
                                <div class="container">
                                    <h3 class="w3-head">Detail</h3>
                                    <div class="contact-main">
                                      <div class="col-md-4 map">
                                        <img src="{{asset('/uploads/resources/'.$datas->foto)}}" style="width:100%; height: 50vh;">
                                      </div>
                                      <div class="col-md-6 contact-in">
                                        <p class="sed-para">Lokasi</p>
                                                    <p class="para1">{{$datas->lokasi}}</p>
                                                    <p class="para1">{{$datas->ketlok}}</p>
                                                  <p class="sed-para">Keterangan</p>
                                                    <p class="para1">{{$datas->keterangan}}<br>Nomor HP : {{$datas->noTelp}}<br>Tanggal : {{$datas->created_at->format('M d,Y h:i a')}}</p>
                                      </div>
                                      <div class="clearfix"> </div>
                                    </div>
                                </div>
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