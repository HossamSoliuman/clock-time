<!-- Navbar -->
<nav class="container-fluid navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <a href="{{ url('/') }}" title="The Clock Time">
        <div class="px-md-4 ps-3 ">
            <img src="{{asset('images/theclocktime-logo.png')}}" alt="the clock time logo" class="logoImage">
        </div>
    </a>
    <button class="navbar-toggler me-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="toggle">
            <div class="bars" id="bar1"></div>
            <div class="bars" id="bar2"></div>
            <div class="bars" id="bar3"></div>
        </label>
    </button>
    <div class="collapse navbar-collapse mt-2 ms-4" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 {{ Request::is('/') ? 'active' : '' }}" id="worldClockLink"
                   href="{{url('/')}}" title="World Clock">World Clock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 {{  isset($active) ? 'active' : '' }}" id="worldClockLink"
                   href="{{ url('/time-converter') }}" title="Time Converter">Time Converter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 {{ Request::is('city-time') ? 'active' : '' }}"
                   id="timeZoneMapLink" href="{{url('/city-time')}}" title="City Time">City Time</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 {{ Request::is('meeting-planner') ? 'active' : '' }}"
                   id="calendarLink" href="{{route('meeting-planner')}}" title="Meeting Planner">Meeting Planner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 {{ Request::is('convert-timezone') ? 'active' : '' }}"
                   id="articlesLink" href="{{ url('/convert-timezone') }}" title="Time Zone">Time Zone
                    Converter</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Navbar end -->


<script>
    window.onscroll = function () {
        var navbar = document.getElementById("navbar");
        if (window.scrollY > 100) {
            navbar.style.backgroundColor = "rgb(11 11 31)";
        } else {
            navbar.style.backgroundColor = "transparent";
        }
    };
</script>
