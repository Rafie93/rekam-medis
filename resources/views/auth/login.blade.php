<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Klinik Medishina</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/toastr/css/toastr.min.css')}}">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										{{-- <a href="#">
                                            <h2 class="text-white">Klinik Medishina</h2>
                                        </a> --}}
                                        <img class="logo-abbr" src="{{asset('images/logo.png')}}" alt="">
                                        <img class="logo-compact" src="{{asset('images/logo-text.png')}}" alt=""> 
                
									</div>
                                    {{-- <h4 class="text-center mb-4 text-white">Sign in your account</h4> --}}
                                    <br><br>
                                    <form action="{{Route('login.auth')}}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>No.Telp / HP</strong></label>
                                            <input type="number" class="form-control" placeholder="phone" value="" required name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" class="form-control"  placeholder="password" value="" required name="password">
                                        </div>
                                       
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-rounded bg-white text-primary btn-primary form-control">Masuk</button>
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/deznav-init.js')}}"></script>
    <script src="{{asset('vendor/toastr/js/toastr.min.js')}}"></script>

    <script>
        @if(Session::has('sukses'))
            toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
        @endif
        @if(Session::has('gagal'))
            toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
        @endif
    </script>

</body>

</html>