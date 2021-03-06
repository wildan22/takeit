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
                <a href="/itstaff"><img src={{ ( '/image/logo_ptpn7.png') }} width="50px" class="img-responsive logo"></a>
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
                        <li><a href="/itstaff/laporan" class="active"><i class="lnr lnr-file-add"></i> <span>Laporan TI</span></a></li>
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
                                <center>
									<h3 style="font-family: lora; color: #1B2690;">Laporan Proses TI</h3>
									<hr width="23%">
								</center>
                                <div class="panel-heading">
                                    <a href="/itstaff/laporan/new_laporan" class="btn btn-outline-primary"><i class="lnr lnr-plus-circle"></i>  Laporan</a>
                                </div>

                                {{-- alert -> tindakan yang dilakukan --}} @if (session('status'))
                                <div class="panel-body">
                                    <div class="alert alert-success">
                                        {{session('status')}}
                                    </div>
                                    </div>
                                    {{-- alert -> tindakan yang dilakukan --}}
                                    
                                @endif
                                <div class="panel-body">
                                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="40%">Judul Laporan</th>
                                                <th>Uploader</th>
                                                <th width="18%">Periode</th>
                                                <th width="0%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($laporan as $l)
                                            <tr>
                                                <td>{{$l->nama_laporan}}</td>
                                                <td>{{$l->name}}</td>
                                                <td>{{myHelpers::dateConvert($l->tanggal_audit)}}</td>
                                                <td width="18%">
                                                    <a href="/{{$l->lokasi_laporan}}" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;" class="btn btn-warning"><i class="lnr lnr-magnifier"></i></a>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$l->id}}">
                                                        <i class="lnr lnr-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END BASIC TABLE -->
                        </div>
                        <!-- BASIC TABLE -->

                        <!-- Delete Modal -->
                        @foreach($laporan as $l)
                        <div class="modal fade" id="deleteModal-{{$l->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        Apakah Anda Yakin, Menghapus <b>{{$l->nama_laporan}} ?</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="/itstaff/laporan/hapus">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$l->id}}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
                        <!-- Delete Modal -->

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