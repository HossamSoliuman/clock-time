<!-- Third row -->
<section class="similarCitiesSection">
    <div class="row justify-content-center text-center bg-light p-md-5">

        @php
            $name = $abb->name;
        @endphp
        @if($gmt)

            @php
                // Check which field matched
            $matchedField = $abb->slug === $slug ? 'name' : 'utc_name';
$name = $abb->$matchedField;
            @endphp
        @endif


        <h2 class="mb-4 wow animate__animated animate__fadeInUp">
            {{ $name }} Time Zone Top Cities

        </h2>

        @foreach ($countries as $country)

            @if($country->capitalCities() != null)
                <div class="col-lg-4 mb-3 col-12">
                    <a href="{{ url($country->capitalCities()->slug) }}" title="{{$country->capitalCities()->name}}">
                        <div class="border rounded-3 p-3 wow animate__animated animate__fadeIn animate__slow h-100">
                            @livewire('time-updater', ['lat' => $country->capitalCities()->lat, 'lng' =>
                            $country->capitalCities()->lng, 'cityName' => $country->capitalCities()->name])
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timeDisplays = document.querySelectorAll('.current-time-display');
        const timeSeconds = document.querySelectorAll('.current-time-seconds');
        timeDisplays.forEach((display, index) => {
            const timeElement = timeSeconds[index];
            let [hours, minutes, seconds] = timeElement.dataset.time.split(':').map(Number);

            function updateTime() {
                let newHours = 0;
                seconds++;  // Increment seconds
                let formattedTime2 = ' AM'
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                }
                if (minutes >= 60) {
                    minutes = 0;
                    hours++;
                }
                if (hours >= 24) {
                    hours = 0;
                }
                timeElement.dataset.time = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                if (hours >= 12) {
                    formattedTime2 = ' PM'
                }
                if (hours > 12) {
                    newHours = hours - 12;
                } else {
                    newHours = hours
                }
                if (seconds === 0) {
                    const formattedTime = newHours + ':' + String(minutes).padStart(2, '0');
                    display.textContent = formattedTime;
                    display.nextElementSibling.textContent = formattedTime2
                }
            }

            setInterval(updateTime, 1000);
        });
    });
</script>
