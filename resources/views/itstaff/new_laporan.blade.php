<!doctype html>
<html lang="en">

<head>
    <title>Tata Kelola TI - PTPN7</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/all.css">
    <link rel="stylesheet" href="/assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="/assets/vendor/chartist/css/chartist-custom.css">
    <!-- MDBootstrap Datatables  -->
    <link href="/assets/mdbootstrap/datatables.min.css" rel="stylesheet">

    <!-- SELECT2  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

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
                                <li><a href="/itstaff/ubah_password"><i class="lnr lnr-cog"></i> <span>Ubah Password</span></a></li>
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
                        <li><a href="/itstaff" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="#" class="active"><i class="lnr lnr-file-add"></i> <span>Laporan TI</span></a></li>
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
                                    <h3 class="panel-title" class="">Input Laporan</h3>
                                    <br>
                                    <a href="/itstaff/laporan" class="btn btn-outline-primary"><i class="lnr lnr-trash"></i>  Batal</a>
                                </div>
                                <div class="panel-body">
                                    {{-- form new Product --}}

                                    <form method="post" action="/itstaff/laporan/proses" enctype="multipart/form-data">
                                        @csrf

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Periode</label>
                                            </div>
                                            <select name="periode" class="form-control select2" id="inputGroupSelect01" required readonly="readonly">
                                                @foreach($periode as $p)
                                                <option value="{{$p->id_periode_audit}}" selected="true">{{myHelpers::dateConvert($p->tanggal_audit)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Proses Teknologi Informasi</label>
                                            </div>
                                            <select name="proses_ti" class="form-control select2" id="inputGroupSelect02" required>
                                                <option value hidden disable>---Pilih---</option>
                                                @foreach($proses_ti as $pti)
                                                <option value="{{$pti->id}}">{{$pti->proses_ti}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="judul_laporan">Judul Laporan</label>
                                            <input type="text" name="judul_laporan" class="form-control" placeholder="Contoh: Proses Pemetaan Lahan Menggunakan Drone" required> @if ($errors->has('judul_laporan'))
                                            <div class="text-danger">
                                                {{ $errors->first('judul_laporan')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="customFile">Upload File Laporan (PDF)</label>
                                            <input type="file" name="laporan" class="custom-file-input form-control" id="customFile" accept="application/pdf" required>
                                        </div>
                                        <br>
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

                 <!-- MDBootstrap Datatables  -->
                 <script type="text/javascript" src="/assets/mdbootstrap/datatables.min.js"></script>
                 <!-- SELECT2  -->
                 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

                 <script>
                     $(".select2").select2({
                         tags: true
                     });
                 </script>
                 <script type="text/javascript">
                     // Basic example
                     $(document).ready(function() {
                         $('#dtBasicExample').DataTable({
                             "searching": true // false to disable search (or any other option)
                         });
                         $('.dataTables_length').addClass('bs-select');
                     });
                 </script>
</body>

</html>