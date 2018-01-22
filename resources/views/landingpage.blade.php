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
<div class=" header-right" style="margin-top: 16vh; margin-bottom: 1vh;">
        <div class="banner">
        <div id="spinner" class="spinner" style="display:none;">
                  <img id="img-spinner" style="z-index: 1" src="{{asset('/uploads/resources/loading.gif')}}" alt="Loading"/><br>Loading...
                </div>
             <div class="slider">
                <div class="callbacks_container">
                  <ul class="rslides" id="slider">             
                     <li>
                         <div class="banner1">
                            <div class="caption">
                                <h3><span>Imigrasi</span> Kediri</h3>
                                <p><a class="cek_lokasi btn btn-success">Laporkan</a></p>
                            </div>
                        </div>
                     </li>
                     <li>
                         <div class="banner2">
                            <div class="caption">
                                <h3><span>Imigrasi</span> memberi pelayanan</h3>
                                <p><a class="cek_lokasi btn btn-success">Laporkan</a></p>
                            </div>
                        </div>
                     </li>
                     <li>
                         <div class="banner3">
                            <div class="caption">
                                <h3><span>Imigrasi</span> bekerja keras</h3>
                                <p><a class="cek_lokasi btn btn-success">Laporkan</a></p>
                            </div>
                        </div>
                     </li>
                  </ul>
              </div>
            </div>
        </div>
    </div>

<script src="js/bootstrap.js"></script>
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
<script src="js/bootstrap-select.js"></script>
<script>
var flag=0;
        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        };
        var options = {
            enableHighAccuracy: true,
          timeout: 2000,
          maximumAge: 0
        };
        function success(pos){
            if(pos.coords.latitude){
                window.location.replace("lapor");
            }
            else{
            $('#status_lokasi').empty();
            $('#status_lokasi').append("Masuk ELSE");
            alert("Hidupkan GPS terlebih dahulu!");
          }
        };
 
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
    $('.cek_lokasi').click(function(){
            $('#spinner').show();
          navigator.geolocation.getCurrentPosition(success,error,options);
          setTimeout(function(){
              alert('Pastikan GPS hidup!');
              $('#spinner').hide();
          },4000);
        });
  });
</script>
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
                            
        $().UItoTop({ easingType: 'easeOutQuart' });
                            
        });
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
@stop

@section('script')
@stop