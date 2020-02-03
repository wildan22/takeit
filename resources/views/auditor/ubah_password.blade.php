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
								<li><a href="/auditor/ubah_password"><i class="lnr lnr-cog"></i> <span>Ubah Password</span></a></li>
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
						<li><a href="/auditor" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>
                            <a href="#subDataMaster" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Tata Kelola TI</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
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
					<h3 class="page-title">Ubah Password</h3>
					<div class="row">
						<div class="co-12">
							<div class="panel"  >
								<div class="panel-body">
									{{-- alert -> tindakan yang dilakukan --}} @if (session('status'))
									<div class="panel-body">
										<div class="alert alert-danger">
											{{session('status')}}
										</div>
										</div>
									@endif
									{{-- alert -> tindakan yang dilakukan --}}
									<form id="ubahPassForm" method="post" action="/auditor/ubah_password/proses" enctype="multipart/form-data">
										@csrf
									<div class="form-group">
                                        <label for="password">Password Sekarang</label>
                                        <input type="password" name="password"  class="form-control" placeholder="Password Sekarang" required> @if ($errors->has('password'))
                                        <div class="text-danger">
                                            {{ $errors->first('password')}}
                                        </div>
                                        @endif
									</div>

									<div class="form-group">
                                        <label for="new_password">Password Baru (Min. 8 Digit)</label>
                                        <input type="password" name="new_password" id="password" class="form-control" placeholder="Password Baru" required> @if ($errors->has('new_password'))
                                        <div class="text-danger">
                                            {{ $errors->first('new_password')}}
                                        </div>
                                        @endif
									</div>

									<div class="form-group">
                                        <label for="konfirmasi_password">Konfirmasi Password (Min. 8 Digit)</label><span id='message'></span>
                                        <input type="password" name="konfirmasi_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required> @if ($errors->has('konfirmasi_password'))
                                        <div class="text-danger">
                                            {{ $errors->first('konfirmasi_password')}}
                                        </div>
                                        @endif
									</div>
									
									<div class="form-group mt-3">
                                        <input id="simpanBtn" disabled="disabled" type="submit" class="btn btn-success" value="Simpan">
									</div>
									</form>
									
								</div>
							</div>
                        </div>
                        <!-- BASIC TABLE -->
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
	<script type="text/javascript">
		$('#password, #confirm_password').on('keyup', function () {
  			if ($('#password').val() == $('#confirm_password').val()) {
    				$('#message').html('Matching').css('color', 'green');
  				} else 
    				$('#message').html('Not Matching').css('color', 'red');
		});
	</script>
	<script>
		ubahPassForm.addEventListener('input',() =>{
		   if(password.value.length > 7 &&
		   confirm_password.value.length > 7){
			simpanBtn.removeAttribute('disabled');
			   } else {
				simpanBtn.setAttribute('disabled', 'disabled');
			   }
	   });
	</script>
</body>

</html>
