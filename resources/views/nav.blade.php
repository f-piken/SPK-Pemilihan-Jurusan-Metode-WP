<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">PILJUR</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->name}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form class="dropdown-item d-flex align-items-center" action="{{ route('logout') }}" method="POST">
                @csrf
                <i class="bi bi-box-arrow-right"></i>
                <button type="submit" style="background-color: transparent; border: none; padding: 0;">Sign Out</button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('mahasiswa.index') }}">
              <i class="bi bi-circle"></i><span>Calon Mahasiswa</span>
            </a>
          </li>
          <li>
            <a href="{{ route('jurusan.index') }}">
              <i class="bi bi-circle"></i><span>Jurusan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('kriteria.index') }}">
              <i class="bi bi-circle"></i><span>Kriteria</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Formulir</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('penilaian.create') }}">
              <i class="bi bi-circle"></i><span>Input Nilai</span>
            </a>
          </li>
          <li>
            <a href="{{ route('log.create') }}">
              <i class="bi bi-circle"></i><span>Edit Nilai</span>
            </a>
          </li>
          <li>
            <a href="{{ route('keputusan.create') }}">
              <i class="bi bi-circle"></i><span>Buat Keputusan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('penilaian.index') }}">
              <i class="bi bi-circle"></i><span>Penilaian</span>
            </a>
          </li>
          <li>
            <a href="{{ route('log.index') }}">
              <i class="bi bi-circle"></i><span>Log Penilaian</span>
            </a>
          </li>
          <li>
            <a href="{{ route('keputusan.index') }}">
              <i class="bi bi-circle"></i><span>Keputusan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <form class="dropdown-item d-flex align-items-center nav-link collapsed" action="{{ route('logout') }}" method="POST">
          @csrf
          <i class="bi bi-box-arrow-right"></i>
          <button type="submit" style="background-color: transparent; border: none; padding: 0;">Sign Out</button>
        </form>
      </li><!-- End Login Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->