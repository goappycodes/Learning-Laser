<!DOCTYPE html>
<html>
@include('includes.head')
@yield('assets')
<body class="with-side-menu">

    @include('includes.header')

    <div class="mobile-menu-left-overlay"></div>
    @include('includes.sidebar')

    @yield('content')

    @include('includes.footer')
</body>
</html>