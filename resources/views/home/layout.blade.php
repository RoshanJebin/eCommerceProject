<!DOCTYPE html>
<html>
@include('home.css')

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">

    @include('home.svg')
    @include('home.search')
    @include('home.header')

    @yield('content')

    @include('home.footer')
    @include('home.script')

</body>

</html>
