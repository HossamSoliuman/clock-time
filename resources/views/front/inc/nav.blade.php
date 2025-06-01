<!-- Navbar -->
<style>
    .navbar-nav .nav-link {
        white-space: nowrap;
        font-size: 0.975rem;
    }
</style>
<nav class="container-fluid navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <a href="{{ url('/') }}" title="The Clock Time">
        <div class="px-md-4 ps-3 ">
            <img src="{{ asset('images/theclocktime-logo.png') }}" alt="the clock time logo" class="logoImage">
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
                <a class="nav-link navbar-link ms-lg-0 ms-3 text-white {{ Request::is('/') ? 'active' : '' }}"
                    id="worldClockLink" href="{{ url('/') }}" title="World Clock">World Clock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 text-white {{ Request::is('meeting-planner') ? 'active' : '' }}"
                    id="calendarLink" href="{{ route('meeting-planner') }}" title="Meeting Planner">Meeting
                    Planner</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link navbar-link dropdown-toggle ms-lg-0 ms-3 text-white"
                    href="{{ url('/time-converter') }}" id="timeConverterDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false" title="Time Converter">Time Converter</a>
                <ul class="dropdown-menu" aria-labelledby="timeConverterDropdown">
                    <li><a class="dropdown-item" href="{{ url('/convert-country') }}">Convert Countries</a></li>
                    <li><a class="dropdown-item" href="{{ url('/convert-city') }}">Convert City to City</a></li>
                    <li><a class="dropdown-item" href="{{ url('/convert-timezone') }}">Convert Time Zones</a></li>
                    <li><a class="dropdown-item" href="{{ url('/time-converter') }}">Convert Any to Any</a></li>
                    <li><a class="dropdown-item" href="{{ url('/minutes-to-hours') }}">min to Hours </a></li>
                    <li><a class="dropdown-item" href="{{ url('/hours-to-decimal') }}">Hours to decimals</a></li>
                    <li><a class="dropdown-item" href="{{ url('/epoch-unix') }}">Epoch Unix</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link navbar-link dropdown-toggle ms-lg-0 ms-3 text-white" href="#"
                    id="timeToolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    title="Time Tools">Time Counters</a>
                <ul class="dropdown-menu" aria-labelledby="timeToolsDropdown">
                    <li><a class="dropdown-item" href="{{ url('/stop-watch') }}">Stop Watch</a></li>
                    <li><a class="dropdown-item" href="{{ url('/timer') }}">Fixed Timers</a></li>
                    <li><a class="dropdown-item" href="{{ url('/count-down-timer') }}">Count Down</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link navbar-link dropdown-toggle ms-lg-0 ms-3 text-white" href="#"
                    id="calculatorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    title="Calculators">Time Calculator</a>
                <ul class="dropdown-menu" aria-labelledby="calculatorsDropdown">
                    <li><a class="dropdown-item" href="#">Time Duration</a></li>
                    <li><a class="dropdown-item" href="#">Hour Duration</a></li>
                    <li><a class="dropdown-item" href="#">8 Hour Day Calculator</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link navbar-link dropdown-toggle ms-lg-0 ms-3 text-white" href="#"
                    id="searchTimeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    title="Search Time">Search Time</a>
                <ul class="dropdown-menu" aria-labelledby="searchTimeDropdown">
                    <li><a class="dropdown-item" href="{{ url('/city-time') }}">By City</a></li>
                    <li><a class="dropdown-item" href="{{ url('/country-time') }}">By Country</a></li>
                    <li><a class="dropdown-item" href="{{ url('/timezone-time') }}">By Time Zone</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link navbar-link dropdown-toggle ms-lg-0 ms-3 text-white" href="#"
                    id="clocksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    title="Clocks">Gallery</a>
                <ul class="dropdown-menu" aria-labelledby="clocksDropdown">
                    <li><a class="dropdown-item" href="{{ url('/digital-clocks') }}">Digital Clocks</a></li>
                    <li><a class="dropdown-item" href="{{ url('/analog-clocks') }}">Analog Clocks</a></li>
                    <li><a class="dropdown-item" href="{{ url('/sand-timers') }}">Sand Timers</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 text-white" href="{{ url('/education') }}"
                    title="Education">Education</a>
            </li>

            <li class="nav-item">
                <a class="nav-link navbar-link ms-lg-0 ms-3 text-white" href="{{ url('/event-announcer') }}"
                    title="Event Announcer">Event Announcer</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Navbar end -->

<script>
    window.onscroll = function() {
        var navbar = document.getElementById("navbar");
        if (window.scrollY > 100) {
            navbar.style.backgroundColor = "rgb(11 11 31)";
        } else {
            navbar.style.backgroundColor = "transparent";
        }
    };
</script>
