@extends('master.masterlaporan')
@section('title') Pelaporan
@stop
@section('head')
@stop

@section('content')
<div class="container" style="margin-top: 18vh;">
    <div class="col-sm-12" id="judul">
        <h3 class="text-center"><span style="font-weight: bold;"> Kota/Kab </span>Kediri
            <span style="font-weight: bold;"> Kec </span>Sukolilo</h3>
        <h4 class="text-center"><span style="font-weight: bold;"> Tanggal </span>18 Januari 2018</h4>
    </div>
    <div class="row" style="margin-top: 5vh;">
        <div class='col-sm-3'>
            <label>Tanggal Awal</label>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-3'>
            <label>Tanggal Akhir</label>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label>Kota/Kab</label>
            <div class="form-group">
                <select id="kota_filter" class="form-control" data-live-search="true" >
                    <option selected disabled>Pilih</option>
                    <option value="tampilkan">Tampilkan Semua</option>
                    <option>Kediri</option>
                    <option>Kabupaten Jombang</option>
                    <option>Kabupaten Nganjuk</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="color:transparent;">-</label>
            <div class="form-group">
                <input type='submit' id="submit_filter" class="form-control btn btn-primary" />
            </div>
        </div>
    </div>
</div>

<hr size="5px">

<div class="container">
    <div class="row">

        <div id="results-graph" class="col-sm-8 col-sm-offset-2">
            <canvas id="densityChart" width="600" height="400"></canvas>
        </div>

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
                <a class="m-movie-link" href=""><i class="fa fa-calendar-o"></i>&nbsp;{{$datas->created_at->format('d M Y h:i a')}}</a>
                
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$datas->id}}"><span class="fa fa-eye"></span>&nbsp;Detail</button>
                @if(Auth::user()->role=="admin")
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$datas->id}}"><span class="fa fa-times"></span>&nbsp;Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="delModal{{$datas->id}}" role="dialog">
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
                                        <button class="btn btn-primary">Tampilkan Map&nbsp;<span class="fa fa-map fa-1x"></span></button>
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
<script type="text/javascript">
    $(document).ready(function(){
        var nama=[];
        var data2=[];
        var densityData=undefined;
        var barChart=undefined;
        $('#submit_filter').click(function(){
            densityData=undefined;
            barChart=undefined;
            // var filt = $('#kota_filter').val();
            // console.log(filt);
            // $.get('statistic/kota',function(stat){
            //     var panjang=stat.length;
            //     for(var i=0;i<panjang;i+=1){
            //         nama.push(stat[i].kec);
            //         data2.push(stat[i].jumlah);
            //     }
            //     console.log(stat);
            //     console.log(nama);
            //     console.log(data2);
            // });
            $('#densityChart').remove();
            $('#results-graph').append('<canvas id="densityChart" width="600" height="400"></canvas>')
            var densityCanvas = $('#densityChart');

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            
                // var nama=[];
                // var data2=[];
                // var panjang=data.length;
                // for(var i=0;i<panjang;i+=1){
                //     nama.push(data[i].kot);
                //     data2.push(data[i].jumlah);
                // }
            // nama = ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"];
            // data2 = [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638];

            densityData = {
                label: 'Hasil Pelaporan',
                data: data2,
                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                borderColor: 'rgba(0, 99, 132, 1)'
            };

            barChart = new Chart(densityCanvas, {
                type: 'bar',
                data: {
                    labels: nama,
                    datasets: [densityData]
                }
            });    
            nama=[];
            data2=[];
            console.log(nama);
            console.log(data2);
        });

        $('#kota_filter').change(function(){
            var kota_val=$('#kota_filter').val();
            console.log(kota_val);
            if(kota_val=="tampilkan"){
                $.get('statistic/'+kota_val,function(stat){
                    var panjang=stat.length;
                    if(nama.length>0 && data2.length>0){
                        nama=[];
                        data2=[];
                    }
                    for(var i=0;i<panjang;i+=1){
                        nama.push(stat[i].kot);
                        data2.push(stat[i].jumlah);
                    }
                    console.log(stat);
                    console.log(nama);
                    console.log(data2);
                });    
            }
            else{
                $.get('statistic/'+kota_val,function(stat){
                    var panjang=stat.length;
                    if(nama.length>0 && data2.length>0){
                        nama=[];
                        data2=[];
                    }
                    for(var i=0;i<panjang;i+=1){
                        nama.push(stat[i].kec);
                        data2.push(stat[i].jumlah);
                    }
                    console.log(stat);
                    console.log(nama);
                    console.log(data2);
                });
            }
                
        });
    });
    
</script>
@stop