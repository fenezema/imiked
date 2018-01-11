<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="template/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="template/css/sb-admin.css" rel="stylesheet">

</head>

  <!-- Navigation-->
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="categories-section main-grid-border" id="mobilew3layouts">
        <div class="container">
          <div class="category-list">  
            <div id="parentVerticalTab">
              <div class="resp-tabs-container hor_1">
                <div>
                  <div class="tabs-box">
                    <div class="clearfix"> </div>
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
                      <div id="tab1" class="tab-grid">  
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
                                  <button type="button" id="button1" style="color: black; background-color: Transparent; border-color: #FEE901;" class="btn btn-warning">
                                      <span class="glyphicon glyphicon-search"></span><h4>Cari lokasi</h4>
                                  </button>
                              </li>
                              <li>
                                  <h4><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#FEE901"></i>&nbsp;&nbsp;Keterangan</h4>
                                  <textarea style="opacity: 0.7;" name="keterangan" id="keterangan_" class="form-control" rows="3" placeholder="Tulis Keterangan"></textarea>
                                  <p class="validation01">
                                      <span class="invalid">Keterangan</span>
                                      <span class="valid">Benar</span>
                                  </p>
                              </li>
                              <li>
                                  <input style="color: black; background-color: #FEE901; font-weight: bold;" id="sub" type="submit" class="submit" value="Laporkan" />
                              </li>

                              <li>
                                  <!-- @include('map') -->
                              </li>
                          </ol>
                          </form> 
                                                                                              
                          </div>  

                      </div>
                  </div>
                  

              <div class="clearfix"> </div>
          </div>

      <!-- script -->

          
          <script>
              $(document).ready(function() {

                  $('#myFile').change(function () {
                      var search_id = $(this).val();
                      var sump = $('#camera');
                      sump.empty();
                      sump.append(search_id);
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

    </div>
  </div>
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="template/vendor/chart.js/Chart.min.js"></script>
    <script src="template/vendor/datatables/jquery.dataTables.js"></script>
    <script src="template/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="template/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="template/js/sb-admin-datatables.min.js"></script>
    <script src="template/js/sb-admin-charts.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#example').DataTable();
        });
    </script>

</body>

</html>
