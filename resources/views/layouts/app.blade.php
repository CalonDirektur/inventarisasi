<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="aplikasi menejemen inventaris barang">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>{{config('app.name')}} | @yield('title')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('theme/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('theme/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('theme/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('theme/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- sweetalert -->
  <link rel="stylesheet" href="{{asset('theme/alert/css/sweetalert2.css')}}">
  <!-- jQuery -->
  <script src="{{asset('theme/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('theme/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- sweetalert -->
  <script src="{{asset('theme/alert/js/sweetalert2.js')}}"></script>

   <!-- Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <link rel="stylesheet" href="{{asset('theme/dist/css/switch.css')}}">
  <link rel="stylesheet" href="{{ asset("localizations/flags.css") }}">
  <style>
        .lang-icon {
            background-image: url('{{ asset("localizations/flags.png") }}');
        }
  </style>
  <style>
    .signature-pad {
        border: 1px solid #ccc; /* Border for the signature pad */
        border-radius: 5px;
        width: 100%;
        height: 260px; /* Set height for the canvas */
        background-color: #fff; /* Background color for visibility */
    }
    .wrapper_pad {
        position: relative;
        width: 100%;
        height: 260px; /* Match the height of the canvas */
    }
    canvas {
        width: 100%;
        height: 100%;
        display: block; /* Ensure the canvas is a block element */
    }
</style>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
  

<!-- <script>
    $(document).ready(function() {
        // Function to initialize signature pads
        function initializeSignaturePads() {
            var canvasPeminjam = document.getElementById('signature-pad-peminjam');
            var signaturePadPeminjam = new SignaturePad(canvasPeminjam);
            var canvasPenanggungJawab = document.getElementById('signature-pad-penanggung-jawab');
            var signaturePadPenanggungJawab = new SignaturePad(canvasPenanggungJawab);

            // Set canvas size for better precision
            resizeCanvas(canvasPeminjam);
            resizeCanvas(canvasPenanggungJawab);

            // Clear signature pad for Peminjam
            $("#clear-peminjam").click(function() {
                signaturePadPeminjam.clear();
            });

            // Clear signature pad for Penanggung Jawab
            $("#clear-penanggung-jawab").click(function() {
                signaturePadPenanggungJawab.clear();
            });

            // On form submit, get the signature data
            $("form").submit(function() {
                // Check if signatures are required
                var peminjamSignatureExists = $("#tanda_tangan_peminjam").val() !== '';
                var penanggungJawabSignatureExists = $("#tanda_tangan_penanggung_jawab").val() !== '';

                if (!peminjamSignatureExists && signaturePadPeminjam.isEmpty()) {
                    alert("Tanda Tangan Peminjam Kosong! Silahkan tanda tangan terlebih dahulu.");
                    return false; // Prevent form submission
                }
                if (!penanggungJawabSignatureExists && signaturePadPenanggungJawab.isEmpty()) {
                    alert("Tanda Tangan Penanggung Jawab Kosong! Silahkan tanda tangan terlebih dahulu.");
                    return false; // Prevent form submission
                }

                // Store the signature data in hidden fields
                var peminjamData = signaturePadPeminjam.toDataURL('image/png');
                var penanggungJawabData = signaturePadPenanggungJawab.toDataURL('image/png');

                $("#tanda_tangan_peminjam").val(peminjamData);
                $("#tanda_tangan_penanggung_jawab").val(penanggungJawabData);
            });
            

            
        }

        // Function to resize canvas
        function resizeCanvas(canvas) {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        // Initialize signature pads
        initializeSignaturePads();

        // Resize canvas on window resize
        $(window).resize(function() {
            resizeCanvas(document.getElementById('signature-pad-peminjam'));
            resizeCanvas(document.getElementById('signature-pad-penanggung-jawab'));
        });

        // JavaScript to populate the merk, model, and nomor seri based on selected item
        document.getElementById('item_id').addEventListener('change', function() {
            const itemId = this.value;
            if (itemId) {
                fetch(`/items/${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('merk').value = data.brand_id; // Assuming brand_id is the brand name
                        document.getElementById('model').value = data.model_barang;
                        document.getElementById('nomor_seri').value = data.serial_number;
                    });
            } else {
                document.getElementById('merk').value = '';
                document.getElementById('model').value = '';
                document.getElementById('nomor_seri').value = '';
            }
        });
    });
</script> -->


@yield('scripts')   
  
  



</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
 <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img  src="{{asset('loading.gif')}}" alt="loading" height="60" width="60">
  </div>

    @include('layouts.navbar')
    @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold">@yield('title')</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

         <!-- Main content -->
        <section class="content text-capitalize">
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="{{asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('theme/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('theme/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('theme/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('theme/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('theme/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('theme/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('theme/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('theme/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('theme/dist/js/adminlte.js')}}"></script>

<script>
  function changeLanguage(lang) {
    let url = new URL(window.location.href);

    url.searchParams.set("lang", lang);
    window.location.href = url.toString();
  }
  $(document).ready(async () => {
    let languages = await (await fetch("{{ url(asset('localizations/languages.json')) }}")).json();
    for (let code in languages) {
      let native = languages[code].nameNative;
      let english = languages[code].nameEnglish;

      $("#lang-dropdown").append(`
        <li onclick="changeLanguage('${ code }')" class="d-flex align-items-center justify-content-start gap-2 px-2">
          <div class="lang-icon lang-icon-${ code }"></div>
          <span class="ml-2 text-uppercase" style="font-size: .8rem" data-text="${ english }">${ code }</span>
        </li>
      `);
    }
  });
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{asset('theme/dist/js/pages/dashboard.js')}}"></script> -->
<script src="//cdn.jsdelivr.net/npm/eruda"></script>
<script>eruda.init();</script>
</body>
</html>
