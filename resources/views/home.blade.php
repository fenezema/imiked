@extends('base_.base')
@section('title')
    Pelaporan Imigrasi
@stop
@section('head')
@stop

@section('count')
    <?php
        $jml = Count($stat);
    ?>
    {{$jml}}
@stop

@section('notif')
    <?php $ii=0; ?>
    @foreach($stat as $n)
        <div class="dropdown-divider"></div>
        <button class="hehe dropdown-item" value="{{$n->id}}" data-toggle="modal" data-target="#{{$n->id}}">
            <span class="text-success">
            <strong>
            <i class="fa fa-long-arrow-up fa-fw"></i>{{$n->noTelp}}</strong>
            </span>
            <span class="small float-right text-muted">{{$n->kot}}</span>
            <div class="dropdown-message small">{{$n->keterangan}}</div>
        </button>
        @if($ii==2)
           @break
        @endif
        <?php $ii++; ?>
    @endforeach
        <div class="dropdown-divider"></div>
        <a class="dropdown-item small" href="{{URL::to('/unread')}}">Lihat semua laporan</a>
@stop

@section('content')
<div class="container">
    <div class="row" style="margin-top: 5vh;">
        <div class='col-sm-3'>
            <label>Tanggal Awal</label>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input id="start_date" type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-3'>
            <label>Tanggal Akhir</label>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input id="stop_date" type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label>Kota/Kab</label>
            <div class="form-group">
                <select id="kota_filter" class="form-control" data-live-search="true" >
                    <option selected disabled>Pilih Kota</option>
                    <option value="tampilkan">Tampilkan Semua</option>
                    <option>Kediri</option>
                    <option>Kota Kediri</option>
                    <option>Kabupaten Jombang</option>
                    <option>Kabupaten Nganjuk</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <label style="color:transparent;">-</label>
            <div class="form-group">
                <input type='submit' id="submit_filter" class="form-control btn btn-primary" value="Tampilkan" />
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-2"></div>
        <div id="results-graph" class="col-sm-8">
            <canvas id="densityChart" width="100%" height="25"></canvas>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if(session('delsuccess'))
    <div class="col-sm-12 col-xs-12">
        <div class="alert alert-success">
            {{session('delsuccess')}}
        </div>
    </div>
    @endif

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Hasil Laporan</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Telp</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Status</th>
                @if(Auth::user()->role=="admin")
                    <th>Option</th>
                @endif
              </tr>
            </thead>
            <tbody>
            @for($i=0;$i< Count($data);$i++)
                <?php $datas = $data[$i]; ?>
              <tr>
                <td>{{$i+1}}</td>
                <td>{{$datas->created_at->format('M d,Y h:i a')}}</td>
                <td>{{$datas->noTelp}}</td>
                <td>{{$datas->lokasi}}</td>
                <td>{{$datas->keterangan}}</td>
                <td id="sutayar{{$datas->id}}">
                    @if($datas->status == 0)
                        <button id="pop_modal" class="hehe btn btn-warning btn-sm" value="{{$datas->id}}" data-toggle="modal" data-target="#{{$datas->id}}"><span class="fa fa-eye-slash"></span>&nbsp;Unread</button>
                        <input type="hidden" id="cek_reader" value="{{$datas->id}}">
                    @else
                        <button id="pop_modal" class="hehe btn btn-success btn-sm" value="{{$datas->id}}" data-toggle="modal" data-target="#{{$datas->id}}"><span class="fa fa-eye"></span>&nbsp;Read</button>
                        <input type="hidden" id="cek_reader" value="{{$datas->id}}">
                    @endif
                </td>
                @if(Auth::user()->role=="admin")
                    <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$datas->id}}"><span class="fa fa-times"></span>&nbsp;Delete</button></td>
                @endif
              </tr>
                    
                 <!-- Modal -->
                <div class="modal fade" id="delModal{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data oleh {{$datas->noTelp}}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Anda yakin menghapus data dari {{$datas->noTelp}}.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="{{URL::to('/home/'.$datas->id)}}">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data dari {{$datas->noTelp}}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('/uploads/resources/'.$datas->foto)}}" style="width:100%; height: 50vh;">
                                <p><span style="font-weight: bold;">Tanggal :</span> {{$datas->created_at->format('M d,Y h:i a')}}</p>
                                <p><span style="font-weight: bold;">Nomor HP :</span>{{$datas->noTelp}}</p>
                                <p><span style="font-weight: bold;">Keterangan :</span>{{$datas->keterangan}}</p>
                                <p>{{$datas->lokasi}}</p>
                                <p>Detail lokasi : {{$datas->ketlok}}</p>
                                <p>Dikonfirmasi oleh :</p>
                                <p class="dibaca_oleh"></p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" target="_blank" href="{{URL::to('https://www.google.co.id/maps/place/'.$datas->lat.",".$datas->lon)}}"><i class="fa fa-map-o fa-1x"></i> Tampilkan Map</a>

                                <a class="btn btn-primary" target="_blank" href="{{URL::to('/pdf/'.$datas->id)}}"><i class="fa fa-clone fa-1x"></i> PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>
@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        (function worker(){
            $.get('n_notif',function(jumlah){
                $('#n_notif').empty();
                console.log(jumlah+"laporan yang ada");
                $('#n_notif').text(jumlah+" Laporan");
                setTimeout(worker,5000);
            });
        })();
        var nama=[];
        var data2=[];
        var densityData=undefined;
        var barChart=undefined;
        var tanggal_start=""; 
        var tanggal_stop=""; 
        var date_flag=0;
        function gambar_map(){
            $('#densityChart').remove();
            $('#results-graph').append('<canvas id="densityChart" width="600" height="400"></canvas>')
            var densityCanvas = $('#densityChart');

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            densityData = {
                label: 'Hasil Pelaporan',
                data: data2,
                 backgroundColor: [
                    'rgba(0, 0, 225, 0.8)',
                    'rgba(0, 50, 225, 0.8)',
                    'rgba(0, 100, 225, 0.6)',
                    'rgba(0, 150, 225, 0.6)',
                    'rgba(0, 200, 225, 0.6)',
                    'rgba(50, 200, 225, 0.6)',
                    'rgba(100, 200, 225, 0.6)'
                  ],
                hoverBorderWidth: 100
            };

            barChart = new Chart(densityCanvas, {
                type: 'horizontalBar',
                data: {
                    labels: nama,
                    datasets: [densityData],
                }
            });    
            nama=[];
            data2=[];
            date_flag=0; 
            tanggal_start=""; 
            tanggal_stop=""; 
            console.log(nama);
            console.log(data2);
        }
        $('#submit_filter').click(function(){
            var kota_val=$('#kota_filter').val();
            console.log(kota_val);
            if(kota_val=="tampilkan" && date_flag==0){
                console.log("masuk if 1");
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
                    gambar_map();
                });    
            }
            else if(kota_val!="tampilkan" && date_flag==0){
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
                    gambar_map();
                });
            }
            else if(kota_val=="tampilkan" && date_flag==1){
                console.log("masuk if 3");
                $.get('statistic/'+kota_val+"/"+tanggal_start+"/"+tanggal_stop,function(stat){
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
                    gambar_map();
                });   
            }
            else if(kota_val!="tampilkan" && date_flag==1){
                $.get('statistic/'+kota_val+"/"+tanggal_start+"/"+tanggal_stop,function(stat){
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
                    gambar_map();
                });   
            }
            else if(kota_val=="Lainnya" && date_flag==0){
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
                    gambar_map();
                });   
            }
            else if(kota_val=="Lainnya" && date_flag==1){
                $.get('statistic/'+kota_val+"/"+tanggal_start+"/"+tanggal_stop,function(stat){
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
                    gambar_map();
                });   
            }
        });
        
        $('.hehe').click(function()
        {
            var a = $(this).val();
            console.log("tayar"+a)
            $.get('tayar/'+a,function(tampan){
                console.log(tampan);
                $('#sutayar'+a).html("<button id=\"pop_modal\" class=\"hehe btn btn-success btn-sm\" value=\""+a+"\" data-toggle=\"modal\" data-target=\"#"+a+"\"><span class=\"fa fa-eye\"></span>&nbsp;Read</button>\
                        <input type=\"hidden\" id=\"cek_reader\" value=\""+a+"\">");
                $.get('n_notif',function(jumlah){
                    $('#n_notif').empty();
                    $('#n_notif').text(jumlah+" Laporan");
                });
            })
            var id_modal = $(this).val();
            console.log(id_modal);
            $.get('user/'+id_modal,function(reader)
            {
                var panjang_reader = reader.length
                var pembaca="";
                for(var i=0;i<panjang_reader;i+=1)
                {
                    pembaca+=reader[i].nama_petugas+" ";
                }
                $('.dibaca_oleh').empty();
                $('.dibaca_oleh').append(pembaca);
            });
        });

        $('#start_date').change(function(){ 
            if(tanggal_stop!=""){ 
                date_flag=1; 
            } 
            tanggal_start=$(this).val(); 
        }); 
        $('#stop_date').change(function(){ 
           if(tanggal_start!=""){ 
                date_flag=1; 
            } 
            tanggal_stop=$(this).val(); 
        }); 
    });
</script>
@stop