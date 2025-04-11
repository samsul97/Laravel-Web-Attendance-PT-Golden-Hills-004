<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/res_user/assets/img/apple-icon.png">
  <link rel="icon"  href="/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title') | Abdul (Absen Dulu)
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  @include('user/style/style')
  @yield('style')

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="danger" data-background-color="white" data-image="/res_user/assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="/user/dashboard" class="simple-text logo-normal">
          <img src="/img/logo_long.png" width="90px">
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item @yield('active1')">
                <a class="nav-link" href="/user/dashboard">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item @yield('active3')">
                <a class="nav-link" href="/user/catatanKehadiran">
                <i class="material-icons">note</i>
                <p>Catatan Kehadiran</p>
                </a>
            </li>

            <li class="nav-item @yield('active4')">
                <a class="nav-link" href="/user/riwayatPinjaman">
                <i class="material-icons">history</i>
                <p>Riwayat Pinjaman</p>
                </a>
            </li>

            <li class="nav-item @yield('active5')">
                <a class="nav-link" href="/user/riwayatCuti">
                <i class="material-icons">content_cut</i>
                <p>Riwayat Cuti</p>
                </a>
            </li>

            <li class="nav-item @yield('active2')">
                <a class="nav-link" href="/user/tentang">
                <i class="material-icons">info_outline</i>
                <p>Tentang</p>
                </a>
            </li>

        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <img src="/img/logo.png" width="35px">
                <a class="navbar-brand">@yield('title')</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <form class="navbar-form" hidden>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                    </button>
                </div>
                </form>
                <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                        Akun
                    </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="/user/profil">Profil</a>
                    <a class="dropdown-item" href="/user/gantiPassword">Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user/logout">Log out</a>
                    </div>
                </li>
                </ul>
            </div>
        </div>
      </nav>
      <!-- End Navbar -->

      {{-- Content --}}
      <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger alert-with-icon" role="alert" data-notify="container">
                <i class="material-icons" data-notify="icon">add_alert</i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                @foreach ($errors->all() as $error)
                    <span>{{$error}}</span>
                @endforeach
            </div>
        @endif

        @if (session()->has('alert-success'))
            <div class="alert alert-success alert-with-icon" role="alert" data-notify="container">
                <i class="material-icons" data-notify="icon">add_alert</i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{session()->get('alert-success')}}</span>
            </div>
        @endif

        @if (session()->has('alert-danger'))
            <div class="alert alert-danger alert-with-icon" role="alert" data-notify="container">
                <i class="material-icons" data-notify="icon">add_alert</i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{session()->get('alert-danger')}}</span>
            </div>
        @endif

        @if (session()->has('alert-warning'))
            <div class="alert alert-warning alert-with-icon" role="alert" data-notify="container">
                <i class="material-icons" data-notify="icon">add_alert</i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{session()->get('alert-warning')}}</span>
            </div>
        @endif
        @yield('content')
    </div>

        {{-- Footer --}}
        <footer class="footer">
            <div class="container-fluid">
            <div class="copyright float-right">
                Copyright
                &copy;
                <script>
                document.write(new Date().getFullYear())
                </script>
            </div>
            </div>
        </footer>
    </div>
  </div>

  {{-- Filter Select --}}
  <div class="fixed-plugin" hidden>
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
              <span class="badge filter badge-rose active" data-color="rose"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="/res_user/assets/img/sidebar-1.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="/res_user/assets/img/sidebar-2.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="/res_user/assets/img/sidebar-3.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="/res_user/assets/img/sidebar-4.jpg" alt="">
          </a>
        </li>
      </ul>
    </div>
  </div>

  @include('user/script/script')
  @yield('script')
</body>

</html>
