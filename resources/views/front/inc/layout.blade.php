<!doctype html>
<html lang="en">

@include('front.inc.header')



<livewire:styles/>
<body>

@include('front.inc.nav')


@yield('container')


@include('front.inc.footer')
<livewire:scripts/>
</body>
</html>
