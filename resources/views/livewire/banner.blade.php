<div class="cityBanner w-100">
    <p class='time mt-5 text-white'>
        <span id="timeDisplay">{{ $currentTimewithoutID }}</span>
        <span id="timeDisplayspan">{{ strtolower($identy) }}</span>
    </p>


    @if (!empty($data['capital']))



        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
            <img loading="lazy" src="{{ asset('vendor/blade-flags/country-' . $data['flag'] . '.svg') }}" width="47" height="47"
                 class="me-3 " style=" padding-top: 6px;" alt="{{ $data['country']->name }}"/>


            <h1 class='display-5 mt-3 h-banner' style="color: white" >

                <a style="color: white" href="{{url($data['country']->slug)}}" title="{{$data['country']->slug}}"> {{ $data['country']->name }} </a>

             time now </h1>
        </div>

        <p class='display-5 mt-3'  style="color: white;font-size: 32px" > As Per {{ $data['capital']->name }} Capital </p>
        <p class='display-5 mt-3' style="color: white;font-size: 32px">{{ strtoupper($dayName) }}
            {{ strtoupper($date) }}
        </p>


        <h2 class="btn-convert rounded-2 fs-6 d-inline-block px-3 py-2" style="font-weight: 400">
            Time in {{ $data['country']->name }}  {{ $timeZone }} Time zone.
        </h2>
    @else
        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
            <img loading="lazy" src="{{ asset('vendor/blade-flags/country-' . $data['flag'] . '.svg') }}" width="47" height="47"
                class="me-3 " style=" padding-top: 6px;" alt="{{ $data['city']->name }}"/>

            <h1 class='display-5 mt-3 h-banner' style="color: white" >

                {{ $data['city']->name }}  time now
            </h1>


        </div>

        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>

            <p class='display-5 mt-3' style="color: white;font-size: 32px">{{ strtoupper($dayName) }}
                {{ strtoupper($date) }}
            </p>
        </div>
        <h2 class="btn-convert rounded-2 fs-6 d-inline-block px-3 py-2" style="font-weight: 400">
            Time in {{ $data['city']->name . ' - ' . $data['country']?->name }}   {{ $timeZone }} Time zone.
        </h2>
    @endif
</div>

<script>
    // Retrieve the initial time from the HTML content
    const initialTime = document.getElementById('timeDisplay').textContent;
    let [hours, minutes, seconds] = initialTime.split(':').map(Number);

    function updateDisplay() {
        const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
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
