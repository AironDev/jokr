@include('admin.partials.header')
@stack('css')
  <body> 
    
        @include('admin.partials.sidebar')
        <!-- navbar -->
        @include('admin.partials.navbar')
        
        @yield('banner')
        <!-- content -->
        @yield('content')
      
    @yield('js')
  </body>
</html>