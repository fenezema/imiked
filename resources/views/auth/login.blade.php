<!DOCTYPE html>
<html lang="en">
<!-- head -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title></title>

<link href="template/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="template/css/bootstrap-select.css">
<link href="template/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
<script type='text/javascript' src='template/js/jquery-2.2.3.min.js'></script>
<link href="template/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Recharge Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Oxygen:300,400,700&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<script src="jquery-3.2.1.min.js"></script>
<style type="text/css">
.spinner {
    position: fixed;
    top: 50%;
    left: 15%;
    margin-left: -50px; /* half width of the spinner gif */
    margin-top: -50px; /* half height of the spinner gif */
    text-align:center;
    z-index:1;
    overflow: auto;
    width: 100%; /* width of the spinner gif */
    height: 100%; /*hight of the spinner gif +2px to fix IE8 issue */
}
</style>
</head>
<!-- //head -->

<!-- body -->
<body >
<div class="container-fluid" style="background-image: url(template/images/IMG_5445.JPG);">
    <div id="loginbox" style="margin-top:20vh; margin-bottom: 30vh;" class="mainbox col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-2">
    <div class="text-center">
        <h2 style="color: white;"><span style="font-weight: bold;">PELAPORAN </span>IMIGRASI</h2>
    </div>
        <br>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title text-center" style="font-weight: bold;">Masuk</div>
            </div>     

            <div style="padding-top:30px" class="panel-body">
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div style="margin-bottom: 25px" class="input-group{{ $errors->has('email') ? ' has-error' : '' }}"">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="nip" placeholder="NIP">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn btn-warning" value="Login">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Masukan NIP dan password dengan Benar
                            </div>
                        </div>
                    </div>    
                </form>     
            </div>                     
        </div>  
    </div>
</div>

<script src="template/js/bootstrap.js"></script>
<!-- //for bootstrap working --><!-- Responsive-slider -->
    <!-- Banner-slider -->
<script src="template/js/responsiveslides.min.js"></script>
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
    <!-- //Banner-slider -->
<!-- //Responsive-slider -->   
<!-- Bootstrap select option script -->
<script src="template/js/bootstrap-select.js"></script>
<script>
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
  });
</script>
<!-- //Bootstrap select option script -->
    
<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="template/css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
    <!-- here stars scrolling icon -->
            <script type="text/javascript">
                $(document).ready(function() {
                                        
                    $().UItoTop({ easingType: 'easeOutQuart' });
                                        
                    });
            </script>
            <!-- start-smoth-scrolling -->
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

            <script>
                function gotomap()
                {
                     location.href = "www.yoursite.com";
                } 
            </script>
            <!-- start-smoth-scrolling -->
        <!-- //here ends scrolling icon -->
</body>
<!-- //body -->
</html>