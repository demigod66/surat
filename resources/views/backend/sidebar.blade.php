<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-40 img-radius" src="{{ asset('backend/assets/images/avatar-4.jpg') }}"
                            alt="User-Profile-Image">
                        <div class="user-details">
                            <span>John Doe</span>
                            <span id="more-details">UX Designer<i class="ti-angle-down"></i></span>
                        </div>
                    </div>

                    <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href="#"><i class="ti-user"></i>View Profile</a>
                                <a href="#!"><i class="ti-settings"></i>Settings</a>
                                <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pcoded-search">
                    <span class="searchbar-toggle"> </span>
                    <div class="pcoded-search-box ">
                        <input type="text" placeholder="Search">
                        <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="active">
                        <a href="index.html">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Kategori</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('category.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Data Kategori</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Arsip Surat</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Surat Masuk</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Surat Keluar</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                        </ul>
                    </li>
                </ul>

        </nav>
