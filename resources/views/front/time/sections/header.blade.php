<!-- Header -->
<div class="container-fluid text-white g-2 p-0 me-0" style="margin-bottom: 8px">
    <style>
        .img-city {
            background-image: url({{ asset('/') }}{{ $imageUrl ?? 'public/ImgHomePage/banner.svg' }});
        }
    </style>


    <div class="img-city img-city-gmt">
        <div class="overlay">
            <div
                class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">


                <div class="cityBanner w-100">
                    @if (Request::is('meeting-planner'))
                        <h1 class="fs-3" style="color:rgba(144, 149, 161, 1) ">Meeting Planner</h1>
                    @endif
                    <div class="mb-5">
                        <p class='time {{ Request::is('meeting-planner') ? '' : 'mt-5' }}'>
                            <span id="timeDisplay">{{ $date['timewithSeconds'] }}</span>
                            <span id="timeDisplayspan">{{ strtolower($date['identify']) }}</span>
                        </p>
                    </div>
                    @if (!Request::is('meeting-planner'))
                        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
                            <h1 class='display-5 mt-3 head' style="font-size:44px; color: white">
                                {{ $timezoneName }} Time Now </h1>
                        </div>
                    @endif
                    <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
                        <p class='display-5 mt-3' style="font-size:34px; color: white"> {{ strtoupper($date['formatted_date']) }}
                        </p>
                    </div>
                    
                    @if (isset($type) && $type == 'city')
                        <h2 class="btn-convert rounded-2 fs-6 d-inline-block px-3 py-2" style="font-weight: 400">
                            Time now in

                            {{ $timezoneName }}
                            - <a href="{{ url($country->slug) }}" style="color: white">{{ $country->name }}</a>
                            - <a href="{{ url($timezoneSlug) }}" style="color: white">{{ $timezone }}</a>
                            Time zone.
                        </h2>
                    @elseif (isset($type) && $type == 'country')
                        <h2 class="btn-convert rounded-2 fs-6 d-inline-block px-3 py-2" style="font-weight: 400">
                            Time now in
                            {{ $timezoneName }}
                            Based on Capital
                            - <a href="{{ url($capital->slug) }}" style="color: white">{{ $capital->name }}</a>
                            - Time Zone
                            - <a href="{{ url($timezoneSlug) }}" style="color: white">{{ $capital->timezone }}</a>
                            .
                        </h2>
                    @else
                        <h2 class="btn-convert rounded-2 fs-6 d-inline-block px-3 py-2" style="font-weight: 400">
                            Time now in
                            ({{$timezoneName }}) Time zone.
                        </h2>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Header -->
<script>
    // Retrieve the initial time from the HTML content
    const initialTime = document.getElementById('timeDisplay').textContent;
    let [hours, minutes, seconds] = initialTime.split(':').map(Number);

    function updateDisplay() {
        const formattedTime =
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        document.getElementById('timeDisplay').textContent = formattedTime;
    }

    function incrementTime() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
                if (hours >= 24) hours = 0;
            }
        }
        updateDisplay();
    }

    // Initial display and start the counter
    updateDisplay();
    setInterval(incrementTime, 1000);
</script>