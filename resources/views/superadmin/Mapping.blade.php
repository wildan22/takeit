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
				<a href="/admin/index"><img src={{ ('/image/logo_ptpn7.png') }} width="50px" class="img-responsive logo"></a>
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
						<li><a href="/superadmin" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/superadmin/user_management" class=""><i class="lnr lnr-user"></i> <span>User Management</span></a></li>
						<li><a href="/superadmin/cobit5" class=""><i class="lnr lnr-chart-bars"></i> <span>Cobit 5 Management</span></a></li>
                        <li><a href="/superadmin/mapping" class="active"><i class="lnr lnr-book"></i> <span>Mapping Tujuan TI</span></a></li>
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
                                    <a href="/superadmin/mapping/new_mapping" class="btn btn-outline-primary"><i class="lnr lnr-plus-circle"></i>  Tujuan TI</a>
                                </div>

                                {{-- alert -> tindakan yang dilakukan --}} @if (session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                                @endif
                                <div class="panel-body">
                                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th width="13%">Sub Domain</th>
                                                <th>Tujuan Teknologi Informasi</th>
                                                <th width="18%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>EDM01</td>
                                                <td>Kerangka Kerja Tata Kelola TI</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="lnr lnr-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>EDM01</td>
                                                <td>Komite TI</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="lnr lnr-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>EDM01</td>
                                                <td>Organisasi fungsional TI</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="lnr lnr-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>EDM01</td>
                                                <td>Koordinasi Pengelolaan Layanan TI dalam Organisasi Fungsional TI</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="lnr lnr-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>EDM01</td>
                                                <td>Implementasi Pedoman, Standar, dan Prosedur TI</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="lnr lnr-trash"></i></a></td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    Halaman :
                                    <br/> Jumlah Data :
                                    <br/>

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