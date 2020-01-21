<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tata Kelola TI</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

         {{-- bootstrap css --}}
     <link rel="stylesheet" href="css/bootstrap.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
      {{-- font awesome css --}}
    <link rel="stylesheet" href="/assets/lib/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
 
     {{-- google font --}}
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:200,400,600&display=swap">
     
     {{-- css manual --}}
     <link href="/css/style.css" rel="stylesheet">
     <link href="/css/fontawesome.css" rel="stylesheet">
     <script src="css/all.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark" style="background-color:black;" height="1px" >
            <a class="navbar-brand" href="https://api.whatsapp.com/send?phone=085274544239&text=Permisi, Mohon Bantuan untuk Aplikasi Tata Kelola TI - PTPN7">Bantuan : <i class="fa fa-phone"></i> +6285274544239 </a>
            
          </nav>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if(Session::get('level')==1)
                        <a href="{{ url('/superadmin') }}">Home</a>
                        @elseif(Session::get('level')==2)
                        <a href="{{ url('/itstaff') }}">Home</a>
                        @elseif(Session::get('level')==3)
                        <a href="{{ url('/auditor') }}">Home</a>
                        @elseif(Session::get('level')==4)
                        <a href="{{ url('/eksekutif') }}">Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>

                        @if (Route::has('register'))
                            {{-- <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a> --}}
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src={{ ('/image/logo_ptpn7.png') }} width="590px">
                </div>
                
                <footer>
                    <div class="container-fluid position-relative mt-5 text-muted">
                            <center> Powered By :<p class="copyright"><a href="https://www.ptpn7.com" target="_blank"> IT-Team PTPN7</a>. All Rights Reserved.</p>
                        </div>
                </footer>
            </div>
        </div>
    </body>
</html>
