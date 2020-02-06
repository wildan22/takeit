
<head>
    <title>Login | Aplikasi Tata Kelola TI</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ ('image/logo_ptpn7.png') }}">

</head>

<body background="{{ ('image/bg.jpg') }}">
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="container">
                    <div class="col-6">
                        <center>
                            {{-- alert -> tindakan yang dilakukan --}} @if (session('status'))
                            <div class="panel-body">
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                                </div>
                            @endif
                            {{-- alert -> tindakan yang dilakukan --}}
                            @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
                            {{-- alert -> error login --}} @if (session('error'))
                            <div class="panel-body">
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                                </div>
                            @endif
                            {{-- alert -> error login --}}
                        </center>
                    </div>
                </div>
                <div class="auth-box">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="{{ ('image/logo_ptpn7.png') }}" alt="ptpn7 Logo" width="192px"></div>
                                <p class="lead">Login dengan akun anda</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Alamat Email</label>   
                                        <input id="email" placeholder="Alamat Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                
                                <div class="row">
                                    <div class="form-group">
                                        <div class="captcha">
                                            <span>{!! captcha_img('black') !!}</span>
                                            <button type="button" class="btn btn-success btn-sm"><i class="lnr lnr-redo" id="refresh"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">APLIKASI TATA KELOLA TI</h1>
                            <p>PTPN7</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
    <br><br>
    <!-- Javascript -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $('#refresh').click(function(){
        $.ajax({
            type:'GET',
            url:'/refreshcaptcha',
            success:function(data){
                $(".captcha span").html(data.captcha);
            }
        });
        });
    </script>
</body>

