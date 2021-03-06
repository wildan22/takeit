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
                <a href="/superadmin"><img src={{ ( '/image/logo_ptpn7.png') }} width="50px" class="img-responsive logo"></a>
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
                                <li><a href="/superadmin/ubah_password"><i class="lnr lnr-cog"></i> <span>Ubah Password</span></a></li>
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
                        <li><a href="/superadmin" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="/superadmin/periode_audit" class=""><i class="lnr lnr-calendar-full"></i> <span>Periode Tata Kelola</span></a></li>
						<li><a href="/superadmin/user_management" class=""><i class="lnr lnr-user"></i> <span>User Management</span></a></li>
						<li>
                            <a href="#subDataMaster" class="active" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subDataMaster" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/superadmin/cobit5" ><i class="lnr lnr-chart-bars"></i> <span>COBIT 5</a></li>
                                    <li><a href="/superadmin/tujuan_ti"><i class="lnr lnr-graduation-hat"></i> <span>Proses TI</a></li>
                                    <li><a href="/superadmin/mapping"><i class="lnr lnr-map"></i> <span>Mapping Proses TI</a></li>
                                    <li><a href="/superadmin/tatakelola"><i class="lnr lnr-layers"></i> <span>Work Proses</a></li>
                                </ul>
                            </div>
						</li>
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
                                    <h3 class="panel-title" class="">Tambah COBIT 5</h3>
                                    <a href="/superadmin/cobit5" class="btn btn-outline-primary"><i class="lnr lnr-trash"></i>  Batal</a>
                                </div>
                                <div class="panel-body">
                                {{-- form new Product --}}

                                <form method="post" action="/superadmin/cobit5/proses" enctype="multipart/form-data">
                                    @csrf


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="inputGroupSelect01">Domain Cobit</label>
                                        </div>
                                        <select name="domain" class="form-control" id="inputGroupSelect01" required>
                                          <option value hidden disable>Pilih Domain</option>
                                          @foreach ($domains as $d)
                                          <option value="{{$d->id_domain}}">{{$d->kode_domain}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <br>
                                    <div class="form-group">
                                        <label for="subdomain">Sub Domain</label>
                                        <input type="text" name="subdomain"  class="form-control" placeholder="Contoh: EDM02" required> @if ($errors->has('subdomain'))
                                        <div class="text-danger">
                                            {{ $errors->first('subdomain')}}
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="proses">Proses</label>
                                        <input type="text" name="proses"  class="form-control" placeholder="Contoh: Ensure Benefits Delivery" required> @if ($errors->has('proses'))
                                        <div class="text-danger">
                                            {{ $errors->first('proses')}}
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
                            <p class="copyright"><a href="https://www.ptpn7.com" target="_blank"> IT-Team PTPN7</a>. All Rights Reserved.</p>
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