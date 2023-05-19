<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Klinik Medishina</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">
	<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
	<!-- Datatable -->
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/toastr/css/toastr.min.css')}}">
    <link href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <style>
        p {
        margin: 0;
    }
    </style>
    @yield('header')
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    
    <div id="main-wrapper">

     
        <div class="nav-header">
            <a href="#" class="brand-logo">
                {{-- <h3 class="brand-title">Klinik Medishina</h3> --}}
                {{-- <h2 class="logo-compact">Klinik Medishina</h2> --}}
                 <img class="logo-abbr" src="{{asset('images/logo.png')}}" alt="">
                 <img class="logo-compact" src="{{asset('images/logo-text.png')}}" alt=""> 
                <img class="brand-title" src="{{asset('images/logo-text.png')}}" alt="">  
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
       
		
		<!--**********************************
            Header start
        ***********************************-->
        @include('layout.partial.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layout.partial.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				@yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        @include('layout.partial.footer')
     

    </div>
 
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
	<script src="{{asset('js/deznav-init.js')}}"></script>

    <!-- Datatable -->
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>

	<script>
        @if(Session::has('sukses'))
            toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
        @endif
        @if(Session::has('gagal'))
            toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
        @endif
        
		(function($) {
			var table = $('#example5').DataTable({
				searching: true,
				paging:true,
				select: false,
				//info: false,         
				lengthChange:false 
				
			});
			$('#example tbody').on('click', 'tr', function () {
				var data = table.row( this ).data();
				
			});
		})(jQuery);
	</script>
    @yield('script')
</body>
</html>