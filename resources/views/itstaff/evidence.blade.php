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
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Ubah Password</span></a></li>
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
						<li><a href="/home" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/itstaff/laporan" class=""><i class="lnr lnr-file-add"></i> <span>Laporan TI</span></a></li>
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
							<div class="panel"  >
								<div class="panel-heading">
                                    <h5>Terdapat pada dokumen apa</h5>
									</div>
								
								{{-- alert -> tindakan yang dilakukan --}}
								@if (session('status'))
								<div class="alert alert-success">
									{{session('status')}}
								</div>
								@endif
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
                                                <th>Kode Output</th>
												<th>Output dari Proses</th>
												<th>Deskripsi</th>
												<th>Terdapat Pada</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tBody>
											<tr>
												<td>EDM01-WP1</td>
												<td>Enterprise governance guiding principles</td>
												<td>Dokumen yang berisi prinsip-prinsip dasar yang mempunyai kesamaan dengan ISO 38500 seperti halnya kerangka kerja COBIT 5</td>
												<td>Tambahkan</td>
												<td><a href="/itstaff/evidence/edit_evidence" class="btn btn-warning"><span class="lnr lnr-pencil"></span></a></td>
											</tr>
											<tr>
												<td>EDM01-WP2</td>
												<td>Enterprise governance guiding principles</td>
												<td>Dokumen yang berisi prinsip-prinsip dasar yang mempunyai kesamaan dengan ISO 38500 seperti halnya kerangka kerja COBIT 5</td>
												<td>Belum ada, IT governance framework baru akan disusun.</td>
												<td><a href="#" class="btn btn-warning"><span class="lnr lnr-pencil"></span></a></td>
											</tr>
											<tr>
												<td>EDM01-WP3</td>
												<td>Enterprise governance guiding principles</td>
												<td>Dokumen yang berisi prinsip-prinsip dasar yang mempunyai kesamaan dengan ISO 38500 seperti halnya kerangka kerja COBIT 5</td>
												<td>Belum ada, IT governance framework baru akan disusun.</td>
												<td><a href="#" class="btn btn-warning"><span class="lnr lnr-pencil"></span></a></td>
											</tr>
										</tBody>
									</table>
									
									Halaman :  <br/>
									Jumlah Data :  <br/>
									Data per Halaman :  <br/>
									
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
