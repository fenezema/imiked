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
    @foreach($stat as $n)
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
            <span class="text-success">
            <strong>
            <i class="fa fa-long-arrow-up fa-fw"></i>{{$n->kot}}</strong>
            </span>
            <span class="small float-right text-muted">{{$n->created_at}}</span>
            <div class="dropdown-message small">{{$n->keterangan}}</div>
        </a>
    @endforeach
@stop

@section('content')
<div class="container">
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
            @foreach($data as $datas)
              <tr>
                <td>1</td>
                <td>{{$datas->created_at->format('M d,Y h:i a')}}</td>
                <td>{{$datas->noTelp}}</td>
                <td>{{$datas->lokasi}}</td>
                <td>{{$datas->keterangan}}</td>
                <td>
                    @if($datas->status == 0)
                        <button id="pop_modal" class="btn btn-warning btn-sm" value="{{$datas->id}}" data-toggle="modal" data-target="#{{$datas->id}}"><span class="fa fa-eye"></span>&nbsp;Unread</button>
                    @else
                        <button id="pop_modal" class="btn btn-success btn-sm" value="{{$datas->id}}" data-toggle="modal" data-target="#{{$datas->id}}"><span class="fa fa-eye"></span>&nbsp;Read</button>
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
                                <p>{{$datas->ketlok}}</p>
                                <p>Dibaca oleh :</p>
                                <p id="dibaca_oleh"></p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ URL::to('/lapor/'.$datas->id) }}" method="post">
                                    {{csrf_field()}}
                                    @if($datas->status == 0)
                                        <button type="submit" class="btn btn-warning">Unread&nbsp;<span class="fa fa-eye fa-1x"></span></button>
                                    @else
                                        <button type="submit" class="btn btn-warning" disabled>Read&nbsp;<span class="fa fa-eye fa-1x"></span></button>
                                    @endif
                                </form>
                                <form action="{{URL::to('https://www.google.co.id/maps/place/'.$datas->lat.",".$datas->lon)}}">
                                    <button class="btn btn-primary">Tampilkan Map&nbsp;<span class="fa fa-map fa-1x"></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
        var nama=[];
        var data2=[];
        var densityData=undefined;
        var barChart=undefined;
        $('#submit_filter').click(function(){
            $('#densityChart').remove();
            $('#results-graph').append('<canvas id="densityChart" width="600" height="400"></canvas>')
            var densityCanvas = $('#densityChart');

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

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
        $('#pop_modal').click(function(){
            var id_modal = $(this).val();
            console.log(id_modal);
            $.get('user/'+id_modal,function(reader){
                var panjang_reader = reader.length
                var pembaca="";
                for(var i=0;i<panjang_reader;i+=1)
                {
                    pembaca+=reader[i].id_user+" ";
                }
                $('#dibaca_oleh').html(pembaca);
            });
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