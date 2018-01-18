@extends('base_.base')
@section('title')
    Pelaporan Imigrasi
@stop
@section('head')
@stop


@section('content')
<div class="container">
    <h3 class="w3-head">Tambah Admin Baru</h3>
    <div class="row">
        <div class="col-sm-8">
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
        <div class="col-sm-1"></div>
        <div class="col-sm-2" style="margin-top: 20vh;">
            <i class="fa fa-user-circle-o fa-5x"></i>
        </div>
    </div>
</div>
@stop

@section('script')
@stop