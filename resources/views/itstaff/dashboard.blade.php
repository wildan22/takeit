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
				<a href="/itstaff"><img src={{ ('/image/logo_ptpn7.png') }} width="50px" class="img-responsive logo"></a>
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
						<li><a href="/itstaff" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
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
                    <h3 class="page-title">Selamat Datang IT Staff</h3>
                    <div class="row">
                        <div class="co-12">
                        
								@foreach($periode_audit as $p)
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">

                                    {{-- alert -> tindakan yang dilakukan --}} 
									@if (session('status'))
                                    <div class="panel-body">
                                        <div class="alert alert-danger">
                                            {{session('status')}}
                                        </div>
                                    </div>
                                    @endif {{-- alert -> tindakan yang dilakukan --}} 
									
									
                                </div>
                                <div class="panel-body">
                                    <h3 class="panel-title" style="font-family: lora; color: #1B2690;">Periode {{myHelpers::dateConvert($p->tanggal_audit)}}</h3>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr style="color:black">
												<b>
                                                <th width="9%">Cobit 5</th>
                                                <th >Proses</th>
												<th width="18%" colspan="2">Kematangan Level %</th>
												<th width="8%">Keterangan</th>
												<th>Detail</th>
												</b>
											</tr>
                                        </thead>
                                        <tbody>
											@foreach($hasil_audit as $h)
											@if($h->id_periode_audit == $p->id_periode_audit)
                                            <tr>
                                                <td>{{$h->kode_subdomain}}</td>
                                                <td>{{$h->proses}}</td>
                                                <td>
													<?php
													$percentage = ($h->yescount/$h->totaldata)*100;
													echo round($percentage,1)."%";
													?>
												</td>
												<td >
													<?php
													if($percentage >= 50){
														echo "<div class='box' style='display: inline' >
																<i class='fas fa-star' style='color:#CCCC00'></i>
															</span>";
													}
													?>
												</td>
                                                <td>
													@if($percentage < 50)
													Level 0
													@elseif($percentage>=50 AND $percentage<=85)
													Level 1
													@elseif($percentage>85)
													Level 1>
													@else
													Nothing
													@endif
												</td>
												<td>
                                                    <button type="button" class="badge badge-primary" data-toggle="modal" data-target="#showAuditorArgument{{$h->id}}">
                                                        <i class="lnr lnr-magnifier"></i>
                                                    </button>
                                                </td>
                                            </tr>
											@endif
											@endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							<!-- END BASIC TABLE -->
							
							<!-- Show Auditor Argument Modal -->
						@foreach($hasil_audit as $h)
                        <div class="modal fade" id="showAuditorArgument{{$h->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{$h->argumen_auditor}}
                                    </div>
                                    <div class="modal-footer">
                                            <input type="hidden" name="id" value="id">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
						<!-- Show Auditor Argument Modal -->
						
                        </div>
						@endforeach
                        <!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
				<div class="container-fluid position-relative text-muted">
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
