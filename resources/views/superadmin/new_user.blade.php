<!doctype html>
<html lang="en">

<head>
    <title>Tata Kelola TI - PTPN7</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="/assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ ('/image/logo_ptpn7.png') }}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="/admin/index"><img src={{ ( '/image/logo_ptpn7.png') }} width="50px" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth ml-5"><i class="lnr lnr-arrow-left-circle ml-5"></i></button>
                </div>

                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-user"></i> <span> {{ Auth::user()->name }}!</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-smile"></i> <span>My Profile</span></a></li>
                                <li><a href="{{ url('/logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
						<li><a href="#" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/superadmin/user_management" class="active"><i class="lnr lnr-user"></i> <span>User Management</span></a></li>
						<li><a href="/superadmin/cobit5" class=""><i class="lnr lnr-chart-bars"></i> <span>Cobit 5 Management</span></a></li>
                        <li><a href="/superadmin/tatakelola" class=""><i class="lnr lnr-map"></i> <span>Tata kelola Management</span></a></li>
						</ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="co-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title" class="">Tambah User</h3>
                                    <a href="/superadmin/user_management" class="btn btn-outline-primary"><i class="lnr lnr-trash"></i>  Batal</a>
                                </div>
                                <div class="panel-body">
                                {{-- form new Product --}}

                                <form method="post" action="/superadmin/user_management/new_user/proses" enctype="multipart/form-data">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="inputGroupSelect01">Level</label>
                                        </div>
                                        <select name="level" class="form-control" id="inputGroupSelect01" required>
                                        <option selected>Pilih Level</option>
                                        @foreach($level as $l)
                                        <option value="{{$l->id}}">{{$l->keterangan_level}}</option>
                                        @endforeach
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama Anda"> @if ($errors->has('name'))
                                        <div class="text-danger">
                                            {{ $errors->first('name')}}
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                      <label for="email">Alamat E-Mail</label>
                                      <input type="email" name="email" class="form-control" placeholder="Alamat E-Mail"> @if ($errors->has('email'))
                                      <div class="text-danger">
                                          {{ $errors->first('email')}}
                                      </div>
                                      @endif
                                  </div>

                                  <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"> @if ($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password"> @if ($errors->has('konfirmasi_password'))
                                    <div class="text-danger">
                                        {{ $errors->first('konfirmasi_password')}}
                                    </div>
                                    @endif
                                </div>
                                    <div class="form-group mt-3">
                                        <input type="submit" class="btn btn-success" value="Simpan">
                                    </div>
                                </form>

                                {{-- akhir form --}}
                                </div>
                            </div>
                        </div>
                        <!-- END BASIC TABLE -->
                    </div>

                    <!-- BASIC TABLE -->

                    <!-- END MAIN -->
                    <div class="clearfix"></div>
                    <footer>
                        <div class="container-fluid position-relative">
                            <p class="copyright"><a href="https://www.themeineed.com" target="_blank"> IT-Team PTPN7</a>. All Rights Reserved.</p>
                        </div>
                    </footer>
                </div>
                <!-- END WRAPPER -->
                <!-- Javascript -->
                <script src="/assets/vendor/jquery/jquery.min.js"></script>
                <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
                <script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
                <script src="/assets/scripts/klorofil-common.js"></script>
</body>

</html>