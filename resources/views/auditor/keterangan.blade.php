<!doctype html>
<html lang="en">

<head>
	<title>Tata Kelola TI - PTPN7</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	 <!-- VENDOR CSS -->
	 <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
	 <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-toggle.min.css">
	 <link rel="stylesheet" href="/assets/vendor/font-awesome/css/all.css">
	 <link rel="stylesheet" href="/assets/vendor/linearicons/style.css">
	 <link rel="stylesheet" href="/assets/vendor/chartist/css/chartist-custom.css">
	 <link rel="stylesheet" href="/assets/vendor/bootstrap/css/boot">
	 
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
						<li><a href="/auditor" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>
                            <a href="#subDataMaster" class="active" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Tata Kelola TI</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subDataMaster" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/auditor/edm01" class=""><i class="lnr lnr-sun"></i><span>EDM</span></a></li>
                                    <li><a href="/auditor/apo01" class=""><i class="lnr lnr-sun"></i><span>APO</span></a></li>
                                    <li><a href="/auditor/bai01" class=""><i class="lnr lnr-sun"></i><span>BAI</span></a></li>
                                    <li><a href="/auditor/dss01" class=""><i class="lnr lnr-sun"></i><span>DSS</span></a></li>
                                    <li><a href="/auditor/mea01" class=""><i class="lnr lnr-sun"></i><span>MEA</span></a></li>
                                </ul>
                            </div>
                        </li>
						{{-- <li><a href="/auditor/laporan" class=""><i class="lnr lnr-text-align-left"></i> <span>Laporan</span></a></li> --}}
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
                                    <a href="/auditor/edm01" class="btn btn-outline-primary"><i class="lnr lnr-trash"></i>  Batal</a>
                                </div>
                                {{-- alert -> tindakan yang dilakukan --}}
								@if (session('status'))
								<div class="alert alert-success">
									{{session('status')}}
								</div>
								@endif
								<div class="panel-body">
                                    <form method="post" action="/auditor/edm01"  enctype="multipart/form-data">
                                        @csrf
                                
                                        
                                      <div class="form-group">
                                            <label for="kodeoutput">Kode Output</label>
                                            <input type="text" disabled name="kodeoutput" class="form-control" placeholder="Contoh: EDM01-WP1 ">
                                
                                        @if ($errors->has('kodeoutput'))
                                            <div class="text-danger">
                                                {{ $errors->first('kodeoutput')}}
                                            </div>
                                        @endif
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="output_proses">Output dari Proses</label>
                                            <input type="number" disabled name="output_proses" class="form-control" placeholder="Contoh: Enterprise governance guiding principles">
                                
                                        @if ($errors->has('output_proses'))
                                            <div class="text-danger">
                                                {{ $errors->first('output_proses')}}
                                            </div>
                                        @endif
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" disabled name="deskripsi" class="form-control" rows="10" placeholder="Contoh: Dokumen yang berisi prinsip-prinsip dasar yang mempunyai kesamaan dengan ISO 38500 seperti halnya kerangka kerja COBIT 5" required></textarea> @if ($errors->has('deskripsi'))
                                            <div class="text-danger">
                                                {{ $errors->first('deskripsi')}}
                                            </div>
                                            @endif
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="nama_laporan">Terdapat pada</label>
                                            <input type="text" name="nama_laporan" class="form-control" placeholder="Contoh: Belum ada, IT governance framework baru akan disusun.">
                                
                                        @if ($errors->has('nama_laporan'))
                                            <div class="text-danger">
                                                {{ $errors->first('nama_laporan')}}
                                            </div>
                                        @endif
                                        </div> 
                                
                                        <div class="form-group mt-3">
                                            <input type="submit" class="btn btn-success" value="Simpan">    
                                        </div>
                                    </form>
                                </div>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>



						<!-- BASIC TABLE -->
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
	 <script src="/assets/vendor/bootstrap/js/bootstrap-toggle.min.js"></script>
	 <script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	 <script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	 <script src="/assets/vendor/chartist/js/chartist.min.js"></script>
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
 
	 <script>
		 $(function() {
			 $('.toggle-event').change(function() {
				 id = $(this).val();
				 console.log(id);
				 if ($(this).prop('checked')) {
					 console.log("TRUE");
					 $.ajax({
						 url: "ubah_status_async.php?id=" + id + "&status=yes",
						 cache: false,
						 success: function(html) {
							 console.log("SUCCESS");
							 $("#results").append(html);
						 }
					 });
 
				 } else {
					 console.log("FALSE");
					 $.ajax({
						 url: "ubah_status_async.php?id=" + id + "&status=no",
						 cache: false,
						 success: function(html) {
							 console.log("SUCCESS");
							 $("#results").append(html);
						 }
					 });
				 }
			 })
		 })
	 </script>
	 
</body>

</html>
