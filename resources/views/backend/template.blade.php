
@include('backend.header')

@include('backend.topbar')

@include('backend.sidebar')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @yield('content')

            </div>
        </div>
    </div>
</div>

@include('backend.footer')
