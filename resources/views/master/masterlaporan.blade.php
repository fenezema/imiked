<!DOCTYPE html>
<html lang="en">
<!-- head -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>@yield('title')</title>

@yield('head')
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
<header>
    <div class="container">

            <div class="logo">
                <h1>
                    <img src="{!! asset('template/images/logo.PNG') !!}" alt="" height="50" width="50" />
                    <a href="{{route('lapor')}}" style="color: #FEE901;"><span style="color: white;">PELAPORAN </span>ONLINE</a>
                </h1>
            </div>
            <div class="w3layouts-login">
                 <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="glyphicon glyphicon-user"> </i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div> 
          <!-- <div class="w3layouts-login">
                <a data-toggle="modal" data-target="#myModal" href="#"><i class="glyphicon glyphicon-user"> </i>Login/Register</a>
            </div>   -->  
                <div class="clearfix"></div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;</button>
                        <h4 class="modal-title" id="myModalLabel">
                            Pelaporan Online</h4>
                    </div>
                    
                </div>
            </div>
        </div>
    <!--//Login modal-->
    </div>
</header>

<!--//-->     
    @yield('content')
    <!--Vertical Tab-->
    @yield('script')
    <!--Plug-in Initialisation-->
    <script type="text/javascript">
    $(document).ready(function() {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<!-- //Categories -->   

<!--footer-->
<footer>
    <div class="w3l-footer-bottom">
        <div class="container-fluid">
            <div class="col-md-4 w3-footer-logo">
                <h2><a href="index.html">IMIGRASI KEDIRI</a></h2>
            </div>
            <div class="col-md-8 agileits-footer-class">
                <p >© Dikembangkan 2018. Dibuat dan di desain oleh  <a href="http://w3layouts.com/" target="_blank" style="color:#FEE901;">Imigrasi Kediri dan ITS</a> </p>
            </div>
        <div class="clearfix"> </div>
        </div>
    </div>
</footer>
<!--//footer-->
    
<!-- for bootstrap working -->
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
            <!-- start-smoth-scrolling -->
        <!-- //here ends scrolling icon -->
</body>
<!-- //body -->
</html>
<!-- //html -->