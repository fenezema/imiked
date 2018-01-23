<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    
      <h4>
          <img src="{!! asset('/uploads/resources/logo.PNG') !!}" alt="" height="40" width="40" />
          @if(Auth::guest())
            <a href="{{route('lapor')}}" style="color: #FEE901;"><span style="color: white;">PELAPORAN </span>ONLINE</a>
          @else
            <a href="{{route('home')}}" style="color: #FEE901;"><span style="color: white;">PELAPORAN </span>ONLINE</a>
          @endif
      </h4>
  
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('home')}}">
            <i class="fa fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        @if(Auth::user()->role=="admin")
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('addUser')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Tambah Petugas</span>
          </a>
        </li>
        @endif
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="">Semua laporan</a>
            </li>
            <li>
              <a href="">Belum dibaca</a>
            </li>
            <li>
              <a href="">Sudah dibaca</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
              <span id="n_notif" class="badge badge-pill badge-primary">@yield('count') Laporan</span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Laporan baru:</h6>
            @yield('notif')
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-sign-out"></i>
              <span class="badge badge-pill badge-warning">{{ Auth::user()->name }}</span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Option</h6>
            @if(Auth::user()->role=="admin")
            <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('addUser')}}">
                Tambah User
              </a>
            @endif

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </li>
        <li class="nav-item dropdown">
          <div class="row">
            <div class="col-sm-1">
              <div style="color:transparent;">aaaa</div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>