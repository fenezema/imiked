@extends('master.master')
@section('title') Pelaporan
@stop
@section('head')
    <style>
      #map {
        height: 60vh;
        width: 100%;
      }
     #latlng {
        width: 100%;
      }

      [hidden] {
        display: none !important;
        }
    </style>
@stop

@section('content')
<div class="categories-section main-grid-border" id="mobilew3layouts">
    <div class="container">
        <div class="category-list">
            <div id="parentVerticalTab">
                <div class="resp-tabs-container hor_1">
                    <div class="container-fluid">
                        <div class="tabs-box">
                            <div class="clearfix"></div>
                            <div class="tab-grids">
                                <div id="spinner" class="spinner" style="display:none;">
                                    <img id="img-spinner" src="{{asset('/uploads/resources/loading.gif')}}" alt="Loading"/>
                                </div>
                                @if(session('success'))
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="alert alert-success">
                                            {!! session('success') !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="alert alert-danger">
                                            {!! session('error') !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div id="tab1" class="row">  
                                    <div class="login-form">  
                                        <form  enctype="multipart/form-data" method="POST" id="signup" action="{{route('lapor.submit')}}">
                                        {{csrf_field()}}
                                        <ol>
                                            <li class="text-right">
                                                <label>
                                                    <i class="icon fa fa-camera fa-2x" style="color:#FEE901;">&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                                    <input id="myFile" class="submit" type="file" name="foto" accept="image/*" hidden>
                                                </label>
                                                <h4 id="camera" class="">Ambil gambar</h4>
                                            </li>

                                            <li>
                                                <h4><i class="icon fa fa-phone-square fa-1x" style="color:#FEE901;"></i>&nbsp;&nbsp;Nomer HP</h4>
                                                <input type="number" id="tel" name="noTelp" class="noTelp_" pattern="\d{10}" placeholder="Nomor HP" required="required" />
                                                <p class="validation01">
                                                    <span class="invalid">Masukan nomor</span>
                                                    <span class="valid">Benar</span>
                                                </p>
                                            </li>
                                            <li>
                                                <h4><i class="fa fa-map-marker fa-1x" aria-hidden="true" style="color:#FEE901"></i>&nbsp;&nbsp;Lokasi</h4>
                                                <h4 id="lokasi2"></h4>
                                                <input type="hidden" id="lat" name="lat" placeholder="Lokasi">
                                                <input type="hidden" id="lon" name="lon" placeholder="Lokasi">
                                                <input type="hidden" id="lokasi" name="lokasi" placeholder="Lokasi">
                                                <div id="ketlokasi">
                                                    <input type="text" id="tel" class="ketlok_" name="ketlok"  placeholder="Detail lokasi" required="required" />
                                                </div>
                                                <button type="button" id="button1" style="color: black; background-color: #FEE901; border-color: #FEE901;" class="btn btn-warning">
                                                    <h4>Cari lokasi &nbsp;<span class="glyphicon glyphicon-search"></span></h4>
                                                </button>
                                            </li>
                                            <li>
                                                <h4><i class="fa fa-pencil-square" aria-hidden="true" style="color:#FEE901"></i>&nbsp;&nbsp;Keterangan</h4>
                                                <textarea style="opacity: 0.7;" name="keterangan" id="keterangan_" class="form-control" rows="3" placeholder="Tulis Keterangan"></textarea>
                                                <p class="validation01">
                                                    <span class="invalid">Keterangan</span>
                                                    <span class="valid">Benar</span>
                                                </p>
                                            </li>
                                            <li>
                                                <button class="btn btn-warning btn-lg" style="background-color: #FEE901; color: black; border-color: #FEE901;" id="sub" type="submit"><h4 style="font-weight: bold; font-size: 14px;">Laporkan</h4>
                                                </button>
                                            </li>
                                            <li>
                                                @include('map')
                                            </li>
                                        </ol>
                                        </form>                                         
                                    </div>  
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <script>
                            $(document).ready(function() {

                                $('#myFile').change(function () {
                                    var search_id = $(this).val();
                                    console.log(search_id);
                                    var filename=search_id.split('\\');
                                    console.log(filename);
                                    var sump = $('#camera');
                                    sump.empty();
                                    sump.append(filename[2]);
                                });

                                $("#tab2").hide();
                                $("#tab3").hide();
                                $("#tab4").hide();
                                $("#map").hide();
                                $('#ketlokasi').hide();
                                $('#button1').click(function(){
                                    $('#map').show();
                                });
                                $(".tabs-menu a").click(function(event){
                                    event.preventDefault();
                                    var tab=$(this).attr("href");
                                    $(".tab-grid").not(tab).css("display","none");
                                    $(tab).fadeIn("slow");
                                });
                                $('#sub').click(function(){
                                    if($('#keterangan_').val()!="" && $('.noTelp_').val()!="" && $('#lat').val()!="" && $('#lon').val()!="" && $('#lokasi').val()!="" && $('.ketlok_').val()!=""){
                                        $('#spinner').show();    
                                    }
                                    
                                });
                            });
                        </script>            
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
@stop