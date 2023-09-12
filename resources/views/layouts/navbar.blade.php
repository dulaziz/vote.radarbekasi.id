<link rel="stylesheet" href="{{ asset('css/navStyle.css') }}">

{{-- Navbar --}}
<nav id="navBar" class="navbar navbar-expand-lg py-2">
  <div class="container">

    {{-- Logo --}}
    @if (Auth::guard('admin')->user())
    <a class="navbar-brand navlogo" href="{{ route('admin.home') }}">
      <img src="{{ asset('img/logoradarbekasi.png') }}" alt="logo radar bekasi">
    </a>
    @else
    <a class="navbar-brand navlogo" href="{{ '/' }}">
      <img src="{{ asset('img/logoradarbekasi.png') }}" alt="logo radar bekasi">
    </a>
    @endif
    {{-- Burger Menu --}}
    <button
    class="navbar-toggler collapsed d-flex d-lg-none flex-column justtify-content-around"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#toggleMobileMenu"
    aria-controls="toggleMobileMenu"
    aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="toggler-icon top-bar"></span>
    <span class="toggler-icon middle-bar"></span>
    <span class="toggler-icon bottom-bar"></span>
    </button>
    {{-- Menu --}}
    <div class="collapse navbar-collapse" id="toggleMobileMenu">
      <ul class="navbar-nav text-center fw-bold ms-auto d-flex align-items-center">
        <li class="nav-item">
          @if (Auth::guard('admin')->user())
              <a href="{{ route('admin.home') }}" class="nav-link txt">Beranda</a>
            @else
              <a href="{{ '/' }}" class="nav-link txt">Beranda</a>
          @endif
        </li>
        @if (Auth::user())
            <li class="nav-item dropdown">
                <a class="nav-link txt dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{Auth::user()->name}}
                  {{-- <img src="{{ asset('img/favicon-96x96.png' ) }}" class="img-thumbnail rounded-circle"   alt="User Image" style="width: 25px;"> --}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow p-3 mt-3" style="width: 250px;">
                  <li>
                    <div class="d-flex justify-content-center mb-1">
                        @if (Auth::guard('admin')->user())
                            <img src="{{ asset('img/favicon-96x96.png' ) }}" class="img-thumbnail rounded-circle"   alt="User Image">
                            @else
                            <img src="{{Auth::user()->avatar}}" class="img-thumbnail rounded-circle" alt="User Image">
                        @endif
                    </div>
                    <div class="text-center mb-1 text-uppercase">
                      {{Auth::user()->name}}
                    </div>
                  </li>
                  <hr class="my-2">
                    @if(Auth::guard('admin')->user())
                    <li class="d-flex justify-content-around">
                      <a href="/admin" class="btn btn-primary btn-sm"><i class="fas fa-home"></i> Home</a>
                      <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm"><i class="fas fa-power-off"></i> Logout</a>
                    </li>

                      {{-- <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fas fa-power-off"></i> Logout</a> --}}
                    @else
                    <li class="d-flex justify-content-around">
                      <a href="/" class="btn btn-primary btn-sm"><i class="fas fa-home"></i> Home</a>
                      <a class="btn btn-danger btn-sm" href="{{ route('logout') }}"><i class="fas fa-power-off"></i> Logout</a>
                    </li>
                    @endif
                </ul>
            </li>
          @endif
      </ul>
    </div>

  </div>
</nav>

<script src="js/script.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

