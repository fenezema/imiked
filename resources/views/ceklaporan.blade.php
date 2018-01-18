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
        <a class="dropdown-item" href="#">
            <span class="text-success">
            <strong>
            <i class="fa fa-long-arrow-up fa-fw"></i>{{$n->kot}}</strong>
            </span>
            <span class="small float-right text-muted">{{$n->created_at}}</span>
            <div class="dropdown-message small">{{$n->keterangan}}</div>
        </a>
        @if($ii==2)
           @break
        @endif
        <?php $ii++; ?>
    @endforeach
        <div class="dropdown-divider"></div>
        <a class="dropdown-item small" href="{{URL::to('/unread')}}">Lihat semua laporan</a>
@stop

@section('content')
<div class="support w3layouts-content" style="margin-top: 17vh;">
    <div class="container">
        <h3 class="w3-head">Tambah Admin Baru</h3>
        <div class="col-md-8 w3ls-supportform">
            <form action="{{route('addUser.submit')}}" method="POST" id="contactForm">
            {{csrf_field()}}
                <div class="control-group form-group">
                    <div class="controls">
                        <label class="inputLabel">Nama:</label>
                        <input type="text" class="form-control" placeholder="Nama" id="name" name="name" required data-validation-required-message="Tulis nama anda">
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label class="inputLabel">Username:</label>
                        <input type="text" class="form-control" placeholder="NIP" id="nip" name="nip" required data-validation-required-message="Tulis NIP anda">
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label class="inputLabel">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="password" id="password" required="" data-validation-required-message="Masukan password" aria-invalid="false">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label class="inputLabel">Confirm Password:</label>
                        <input type="password" class="form-control" name="phone" placeholder="Konfirmasi password" id="" name="password_confirmation" required="" data-validation-required-message="Masukan konfirmasi password" aria-invalid="false">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div id="success"></div>
                <button type="submit" class="submit btn btn-primary">Daftarkan</button>
                <div class="clearfix"></div>    
            </form>
        </div>

        <div class="col-md-4 bann-info1">
            <i class="train-icon fa fa-user-circle-o"></i>
        </div>
        <div class="clearfix"></div>
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

        $('#pop_modal').click(function()
        {
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