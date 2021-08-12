<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/halaman" class="brand-link">
      <img src="{{ asset('backend/assets/dist/img/smansabanko.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SMAN 1 BANGKO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/assets/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      @if(Auth::user()->tipe == 1 || Auth::user()->tipe == 0)
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-header">BERANDA</li>
         <li class="nav-item">
          <a href="/home" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endif
        @if(Auth::user()->tipe == 1)
        <li class="nav-header">Profil Instansi</li>
          <li class="nav-item">
            <a href="{{ route('instansi.index') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Instansi
              </p>
            </a>
          </li>
          @endif
        @if(Auth::user()->tipe == 1)
        <li class="nav-header">ARSIP</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Arsip Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('suratmasuk.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('suratkeluar.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->tipe == 1 || Auth::user()->tipe == 0)
          <li class="nav-item">
            <a href="{{ route('arsipguru.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Arsip Staff/Guru
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->tipe == 1)
          <li class="nav-item">
            <a href="{{ route('ijazah.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Arsip Ijazah
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->tipe == 1)
          <li class="nav-header">Agenda</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Agenda
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('suratmasuk.agenda') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agenda Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('suratkeluar.agenda') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agenda Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->tipe == 1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajemen User</p>
                </a>
              </li>
          @endif
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>
