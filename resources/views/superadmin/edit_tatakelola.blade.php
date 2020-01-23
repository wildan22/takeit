<!doctype html>
<html lang="en">

<head>
    <title>Tata Kelola TI - PTPN7</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- SELECT2  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

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
                                <li><a href="#"><i class="lnr lnr-smile"></i> <span>Ubah Password</span></a></li>
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
                        <li><a href="/superadmin/user_management" class=""><i class="lnr lnr-user"></i> <span>User Management</span></a></li>
                        <li>
                            <a href="#subDataMaster" class="active" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subDataMaster" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/superadmin/cobit5"><i class="lnr lnr-chart-bars"></i> <span>COBIT 5</a></li>
                                    <li><a href="/superadmin/tujuan_ti"><i class="lnr lnr-graduation-hat"></i> <span>Proses TI</a></li>
                                    <li><a href="/superadmin/mapping"><i class="lnr lnr-map"></i> <span>Mapping Proses TI</a></li>
                                    <li><a href="/superadmin/tatakelola"><i class="lnr lnr-layers"></i> <span>Work Point</a></li>
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
                                    <h3 class="panel-title" class="">Edit Work Point</h3>
                                    <a href="/superadmin/tatakelola" class="btn btn-outline-primary"><i class="lnr lnr-trash"></i>  Batal</a>
                                </div>
                                <div class="panel-body">
                                    {{-- form new Product --}}

                                    <form method="post" action="/superadmin/tatakelola/edit_tatakelola/proses" enctype="multipart/form-data">
                                        @csrf {{--
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label for="periode">Periode Pelaksanaan</label>
                                                <input type="date" name="periode" class="form-control" required>
                                            </div>
                                        </div>
                                        <br> --}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text">Sub Domain</label>
                                            </div>
                                            <select name="subdomain" class="form-control select2" id="inputGroupSelect01" required>
                                                <option value hidden disable>---Pilih---</option>
                                                <option value="1">EDM01</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="kodeoutput">Kode Output</label>
                                            <input type="text" name="kodeoutput" class="form-control" placeholder="Contoh: EDM02-WP1" required> @if ($errors->has('kodeoutput'))
                                            <div class="text-danger">
                                                {{ $errors->first('kodeoutput')}}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="output_proses">Output dari Proses</label>
                                            <input type="text" name="output_proses" class="form-control" placeholder="Contoh: Evaluation of strategic alignment" required> @if ($errors->has('output_proses'))
                                            <div class="text-danger">
                                                {{ $errors->first('output_proses')}}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="output_prosesdeskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="10" placeholder="Contoh: Hasil dari aktifitas Tata Kelola yang nampak dari deskripsi dari tujuan perusahaan beserta kontribusi yang berkaitan dengan sasaran perusahaan" required></textarea> @if ($errors->has('deskripsi'))
                                            <div class="text-danger">
                                                {{ $errors->first('deskripsi')}}
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

                <!-- MDBootstrap Datatables  -->
                <script type="text/javascript" src="/assets/mdbootstrap/datatables.min.js"></script>
                <!-- SELECT2  -->
                <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

                {{-- Select2 --}}
                <script>
                    $(".select2").select2({
                        tags: true
                    });
                </script>
</body>

</html>