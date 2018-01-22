@extends('base_.base')
@section('title')
    Pelaporan Imigrasi
@stop
@section('head')
@stop


@section('content')
<div class="container">
    <h3 class="w3-head">Tambah User Baru</h3>
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
                        <label class="inputLabel">NIP:</label>
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
                        <input type="password" class="form-control" name="phone" placeholder="Konfirmasi password" id="confirm_password" name="password_confirmation" required="" data-validation-required-message="Masukan konfirmasi password" aria-invalid="false">
                        <p class="help-block"></p>
                        <span id='message'></span>
                    </div>
                </div>

                <div id="success"></div>
                <button type="submit" class="submit btn btn-primary">Daftarkan</button>
                <div class="clearfix"></div>    
            </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-2" style="margin-top: 20vh;">
            <i class="fa fa-user-circle-o fa-5x" style="font-size:150px;"></i>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val() && $('#password').val() != "" && $('#confirm_password').val() != "")
            {
                $('#message').html('Cocok').css('color', 'green');
            }
            else if ($('#password').val() == "" &&  $('#confirm_password').val() == "") 
            {
                $('#message').html('').css('color', 'green');
            }
            else
            {
                $('#message').html('Konfirmasi password tidak cocok').css('color', 'red');
            }
        });
    });
</script>
@stop