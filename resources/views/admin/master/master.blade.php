<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="/img/favicon.ico"/>
    <title>@yield('title')</title>
    <meta name="description" content="Abdul Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('admin/style/style')

<body>
<!-- /#left-panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="@yield('active_1')">
                        <a href="/admin/dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>

                    <li class="@yield('active_5')">
                        <a href="/admin/organisasi"><i class="menu-icon fa fa-sitemap"></i>Organisasi</a>
                    </li>

                    <li class="@yield('active_3')">
                        <a href="/admin/karyawan"><i class="menu-icon fa fa-users"></i>Karyawan</a>
                    </li>

                    <li class="@yield('active_4')">
                        <a href="/admin/shift"><i class="menu-icon fa fa-refresh"></i>Shift</a>
                    </li>

                    <li class="@yield('active_7')">
                        <a href="/admin/cuti"><i class="menu-icon fa fa-scissors"></i>Cut Off</a>
                    </li>

                    <li class="@yield('active_2')">
                        <a href="/admin/absensi"><i class="menu-icon fa fa-book"></i>Rekap Absensi</a>
                    </li>

                    <li class="@yield('active_6')">
                        <a href="/admin/pinjaman"><i class="menu-icon fa fa-handshake-o"></i>Rekap Loan</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">

            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/admin/dashboard"><img src="/res_admin/images/logo3.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="/admin/dashboard"><img src="/res_admin/images/logo3.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    {{-- <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div> --}}
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/res_admin/images/boss.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/admin/gantiPassword"></i>Ganti Password</a>
                            <a class="nav-link" href="/admin/logout"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->

        <!-- Content -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{$error}}</span>
                @endforeach
            </div>
        @endif

        @if (session()->has('alert-success'))
            <div class="alert alert-success" role="alert">
                {{session()->get('alert-success')}}
            </div>
        @endif

        @if (session()->has('alert-danger'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('alert-danger')}}
            </div>
        @endif

        @if (session()->has('alert-warning'))
            <div class="alert alert-warning" role="alert">
                {{session()->get('alert-warning')}}
            </div>
        @endif

        @if (Session()->has('alert-modal-success'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body alert-success">
                    <p><h5>{{session()->get('alert-modal-success')}}</h5></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          @endif

          @if (Session()->has('alert-modal-danger'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body alert-danger">
                    <p><h5>{{session()->get('alert-modal-danger')}}</h5></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          @endif

          @if (Session()->has('alert-modal-warning'))
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body alert-warning">
                    <p><h5>{{session()->get('alert-modal-warning')}}</h5></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          @endif

        @yield('content')
        <!-- /.content -->

        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>

    <!-- /#right-panel -->
    <!-- Scripts -->
    @include('admin/script/script')
</body>
</html>
