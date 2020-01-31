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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <li><a href="/auditor/edm01" class=""><i class="lnr lnr-screen"></i><span>EDM</span></a></li>
                                    <li><a href="/auditor/apo01" class=""><i class="lnr lnr-pie-chart"></i><span>APO</span></a></li>
                                    <li><a href="/auditor/bai01" class=""><i class="lnr lnr-apartment"></i><span>BAI</span></a></li>
                                    <li><a href="/auditor/dss01" class=""><i class="lnr lnr-cog"></i><span>DSS</span></a></li>
                                    <li><a href="/auditor/mea01" class=""><i class="lnr lnr-eye"></i><span>MEA</span></a></li>
                                </ul>
                            </div>
                        </li>
                        {{--
                        <li><a href="/auditor/laporan" class=""><i class="lnr lnr-text-align-left"></i> <span>Laporan</span></a></li> --}}
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
                                    @foreach($subdomain as $s)
                                    <a href="/auditor/{{strtolower($s->kode_subdomain)}}" class="btn {{ Request::path() === 'auditor/'.strtolower($s->kode_subdomain) ? 'btn-primary' : 'btn-outline-primary' }}"><i class="lnr lnr-pencil"></i>{{$s->kode_subdomain}}</a> @endforeach
                                </div>
                                <div class="panel-body audit-section">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%">Kode</th>
                                                <th width="14%">Outpur dari Proses</th>
                                                <th>Deskripsi</th>
                                                <th width="23%">Terdapat/Lokasi</th>
                                                <th width="5%">Opsi</th>
                                                <th>Y/N</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wp_view as $w)
                                            <tr>
                                                <td>{{$w->kode_wp}}</td>
                                                <td>{{$w->wp_name}}</td>
                                                <td>{{$w->wp_deskripsi}}</td>
                                                <td>
                                                    <div id="txtArea{{$w->id}}">{{$w->keputusan_laporan}}</div>
                                                    <div id="inputArea{{$w->id}}" class="form-group hidden">
                                                        <textarea id="editArea{{$w->id}}" placeholder="{{$w->keputusan_laporan}}" class="form-control" type="textarea" rows="3"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button id="editButton{{$w->id}}" class="btn btn-warning editButton" value="{{$w->id}}"><span class="lnr lnr-pencil"></span></button>
                                                    <button id="saveButton{{$w->id}}" class="btn btn-success hidden saveButton" value="{{$w->id}}"><span class="lnr lnr-checkmark-circle" style="z-index-1"></span></button>
                                                </td>
                                                <td align="center">
                                                    <div class="form-group">
                                                        <input class="toggle-event" type="checkbox" {{$w->answer === 'YES' ? 'checked' : ''}} data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="{{$w->id}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <b>
                                        <div class="datayes">Data Yes : </div>
                                        <div class="datano">Data No :	</div>
                                        <div class="percentage">Persentase :</div>
                                        <br> <br>
                                    </b>
                                    <form method="POST" action="/auditor/simpanargumen">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$hasilaudit_view->id}}">
										<input type="hidden" name="subdomain" value="{{$hasilaudit_view->id_subdomain}}">
                                        <div class="form-group">
                                            <label for="argumen">Argumen</label>
                                            <textarea id="argumen" name="argumen" class="form-control" rows="10" placeholder="{{$hasilaudit_view->argumen_auditor != '' ? $hasilaudit_view->argumen_auditor :'Contoh: Jadwal operasional layanan belum terdokumentasi dan belum disosialisasikan, namun jadwal pemeliharaan komponen layanan khususnya di area infrastruktur sudah dibuat. Diperlukan konsistensi pelaksanaan, monitoring, dan review hasil pelaksanaan operasional layanan maupun pemeliharaan sesuai rencana, baik di area infrastruktur dan aplikasi. Diperlukan juga kebijakan, prosedur, dan standar baku mengenai quality assurance maupun quality control atas output dari proses-proses operasional layanan TI. Dalam hal awareness mengenai keselamatan, kesehatan, dan lingkungan (SHE), TI menginduk pada kebijakan SMK 3, namun diperlukan penyusunan SMK3 yang spesifik di area operasional TI baik di lingkungan internal organisasi TI maupun lingkungan unit bisnis sebagai pengguna layanan TI. Selain itu, diperlukan juga rencana audit terhadap operasional TI hingga aspek SHE-nya'}}" required></textarea> @if ($errors->has('argumen'))
                                            <div class="text-danger">
                                                {{ $errors->first('argumen')}}
                                            </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deleteModal-id">
                                            <i class="lnr lnr-lock"> Simpan</i>
                                        </button>

                                        <!-- Simpan Argumen Modal -->
                                        <div class="modal fade" id="deleteModal-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        Apakah Anda Yakin Menyimpan Data ini?
                                                        <br>
                                                        <i class="lnr lnr-warning"></i> Data Ini Tidak Akan Bisa diUbah Kembali
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										</form>	
                                        <!-- Simpan Argumen Modal -->

                                    
                                </div>
                            </div>
                            <!-- END BASIC TABLE -->
                        </div>

                        {{-- Sektor Laporan per Domain/Subdomain --}}
                        <div class="panel">
                            <div class="panel-body laporan-section">
                                <div class="accordion" id="accordionExample">

                                    @foreach($laporan as $l)
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
										  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$l->id}}" aria-expanded="false" aria-controls="collapseTwo">
											{{$l->nama_laporan}}
										  </button>
										</h2>
                                        </div>
                                        <div id="collapse{{$l->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="graph-outline">
                                                    <object width="100%" height="700px" data="/{{$l->lokasi_laporan}}" type="application/pdf">
                                                        <embed src="/{{$l->lokasi_laporan}}" type="application/pdf" />
                                                    </object>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Sektor Laporan per Domain/Subdomain --}}
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
                <script src="/assets/vendor/bootstrap/js/bootstrap-toggle.min.js"></script>
                <script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
                <script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
                <script src="/assets/vendor/chartist/js/chartist.min.js"></script>
                <script src="/assets/scripts/klorofil-common.js"></script>
                <script src="/assets/scripts/notify.js"></script>

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
                    window.onload = function() {
                        //$(".audit-section :input").prop("disabled", true);
                        totaldata = (document.querySelectorAll('input[type="checkbox"]').length);
                        //Calculate Yes Data
                        datayes = (document.querySelectorAll('input[type="checkbox"]:checked').length);
                        $(".yescount").remove();
                        $(".datayes").append("<a class='yescount'>" + datayes + "</a>");

                        //Calculate No Data
                        datano = (document.querySelectorAll('input[type="checkbox"]:not(:checked)').length);
                        $(".nocount").remove();
                        $(".datano").append("<a class='nocount'>" + datano + "</a>");

                        //Calculate Percentage
                        percentage = (datayes / totaldata) * 100;
                        $(".percentagecount").remove();
                        $(".percentage").append("<a class='nocount'>" + percentage.toFixed(2) + " %</a>");
                    }
                </script>

                <script>
                    $(function() {
                        $('.toggle-event').change(function() {
                            id = $(this).val();
                            totaldata = (document.querySelectorAll('input[type="checkbox"]').length);

                            //Calculate Yes Data
                            datayes = (document.querySelectorAll('input[type="checkbox"]:checked').length);
                            $(".yescount").remove();
                            $(".datayes").append("<a class='yescount'>" + datayes + "</a>");

                            //Calculate No Data
                            datano = (document.querySelectorAll('input[type="checkbox"]:not(:checked)').length);
                            $(".nocount").remove();
                            $(".datano").append("<a class='nocount'>" + datano + "</a>");

                            //Calculate Percentage
                            percentage = (datayes / totaldata) * 100;
                            $(".percentagecount").remove();
                            $(".percentage").append("<a class='nocount'>" + percentage.toFixed(2) + " %</a>");

                            console.log(id);
                            if ($(this).prop('checked')) {
                                //console.log("TRUE");
                                $.ajax({
                                    url: "/auditor/ubahstatusasync/" + id + "/yes",
                                    cache: false,
                                    success: function(html) {
                                        console.log("SUCCESS");

                                    }
                                });

                            } else {
                                console.log("FALSE");
                                $.ajax({
                                    url: "/auditor/ubahstatusasync/" + id + "/no",
                                    cache: false,
                                    success: function(html) {
                                        //console.log("SUCCESS");
                                        $("#results").append(html);
                                    }
                                });
                            }
                        })
                    })
                </script>
                <script>
                    $(document).ready(function() {
                        $(".editButton").click(function() {
                            console.log('Save Showed');
                            id = $(this).val();
                            console.log('#inputArea' + id);
                            $(this).addClass('hidden');
                            $("#saveButton" + id).removeClass('hidden');
                            $('#txtArea' + id).addClass('hidden');
                            $('#inputArea' + id).removeClass('hidden');

                        });
                        $(".saveButton").click(function() {
                            console.log('Edit Showed');
                            id = $(this).val();
                            $(this).addClass('hidden');
                            $("#editButton" + id).removeClass('hidden');
                            $('#txtArea' + id).removeClass('hidden');
                            $('#inputArea' + id).addClass('hidden');
                            textval = $("#editArea" + id).val();
                            console.log(textval);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                // url: "/auditor/ubahkeputusanlaporan/"+id+"/"+textval,
                                // cache: false,
                                type: 'POST',
                                url: "/auditor/ubahkeputusanlaporan",
                                data: {
                                    id: id,
                                    keputusan: textval + ""
                                },
                                success: function(data) {
                                    console.log("UPDATE SUCCESS");
                                    $.notify("Data Berhasil Diupdate", "success");
                                }
                            });
                            $("#editArea" + id).attr("placeholder", textval).val('');
                            $('#txtArea' + id).text(textval);
                        });
                    });
                </script>
</body>

</html>