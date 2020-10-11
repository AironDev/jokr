<div class="wrapper">

    @include('admin.partials.sidebars.admin')

    <div class="main-panel">
        @include('admin.partials.navbars.auth')
        @yield('content')
        @include('admin.partials.footer')
    </div>
</div>