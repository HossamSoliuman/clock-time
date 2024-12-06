<!-- Third row -->

<div class="container-fluid position-relative">


    <section class="similarCitiesSection">
        <div class="row justify-content-center text-center bg-light p-md-5">
            @if (isset($type) && $type == 'city')
                <h2 class="mb-4 wow animate__animated animate__fadeInUp" style="font-size:38px;">{{ $name }} similar Cities Clocks</h2>
            @else
                <h2 class="mb-4 wow animate__animated animate__fadeInUp" style="font-size:38px;">
                    {{ $name }} Major Cities Clocks
                </h2>
            @endif
            @foreach ($cities as $city)
                <div class="col-lg-4 mb-3 col-12">
                    <div class="border rounded-3 p-3 wow animate__animated animate__fadeIn animate__slow h-100">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <div class="text-start">
                                    <p class="h2">
                                        <a href="{{ url($city->slug) }}" title="{{ $city->name }} time now"
                                            style="color: black">{{ $city->name }}</a>

                                    </p>
                                    <p class="m-0 secoundText"> {{ $city->dayOfWeek }}</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="text-end">
                                    <p class="gmt2 m-0" style="font-family: 'Lexend'; font-size: 32px; color: red;">
                                        <span class="current-time-display"> {{ $city->currentTime }}</span>
                                        <span class="current-time2-display">{{ $city->identify }}</span>
                                    </p>
                                    <input type="hidden" class="current-time-seconds"
                                        data-time="{{ $city->currentTimeWithSecond }}">

                                </div>
                            </div>
                        </div>

                    </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeDisplays = document.querySelectorAll('.current-time-display');
        const timeSeconds = document.querySelectorAll('.current-time-seconds');
        timeDisplays.forEach((display, index) => {
            const timeElement = timeSeconds[index];
            let [hours, minutes, seconds] = timeElement.dataset.time.split(':').map(Number);

            function updateTime() {
                let newHours = 0;
                seconds++; // Increment seconds
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
                timeElement.dataset.time =
                    `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
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
