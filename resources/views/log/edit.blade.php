<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / General - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('NiceAdmin/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('NiceAdmin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('NiceAdmin/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  @include('nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Laporan</li>
          <li class="breadcrumb-item">Log Penilaian</li>
          <li class="breadcrumb-item active">Edit Nilai</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row" >
        <div class="col-lg-6" style="width: 1500px;">
          <a href="{{ route('log.index') }}" class="btn btn-primary mb-3">Data Log</a>
          <div class="card">
            <div class="card-body">
                <form action="{{ route('log.update', $log->id_log) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                      <label for="id_penilaian" class="form-label">Penilaian</label>
                        <select name="id_penilaian" id="id_penilaian" class="form-select" onchange="changeJurusan()">
                          <option>Pilih</option>
                          @foreach($penilaian as $pnl)
                              <option value="{{ $pnl->id_penilaian }}">{{ $pnl->Mahasiswa->nama }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="jurusan" class="form-label">Jurusan yang dipilih</label>
                      <select name="jurusan" id="jurusan" class="form-select" disabled>
                        @foreach($penilaian as $pnl)
                          <option value="{{ $pnl->id_penilaian }}">{{ $pnl->Jurusan->nama_jurusan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Baru</label>
                        <input value="{{ old('nilai', $log->nilai_baru) }}" class="form-control" type="number" name="nilai" id="nilai" min="0" max="100">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Tambah</button>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('NiceAdmin/assets/js/main.js')}}"></script>
  <script>
    function changeJurusan() {
        var penilaianSelect = document.getElementById("id_penilaian");
        var jurusanSelect = document.getElementById("jurusan");
        var selectedPenilaianId = penilaianSelect.value;

        for (var i = 0; i < jurusanSelect.options.length; i++) {
            if (jurusanSelect.options[i].value == selectedPenilaianId) {
                jurusanSelect.selectedIndex = i;
                break;
            }
        }
    }
  </script> 
</body>

</html>