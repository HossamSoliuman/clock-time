<!-- TimeZones -->
<section class="TimeZones">
    <div class="container-fluid position-relative">


        <!-- First row -->
        <div class="row justify-content-center text-center bg-light p-md-5 pb-0">


            @php
                $name = $abb->name;
            @endphp
            @if ($gmt)
                @php
                    $matchedField = $abb->slug === $slug ? 'name' : 'utc_name';
                    $name = $abb->$matchedField;
                @endphp
            @endif




            <h2 class=" wow animate__animated animate__fadeInUp">{{ $name }} time to GMT</h2>
            <h3 class="mb-4 wow animate__animated animate__fadeInUp"
                style="color: #BDC1CA;font-weight: 400;font-size: 16px">

                {{ $name }} time is {{ convertGmtStringToDateTime(getGmtOffset($timezone))['hours'] }}:00 hours
                ahead of Greenwich Mean Time</h3>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2 ">
                                {{ $name }} Time</p>

                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['timeWithout'] }}</span> <span
                                    class="dataWithTime2">{{ $date['identify'] }}</span></p>
                            <input type="hidden" value="{{ $date['currentTimeWithSecond'] }}" class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                    <div class="d-flex justify-content-between px-lg-4 align-items-center">
                        <p class="gmt1 m-0">GMT</p>
                        <p class="gmt2 m-0">
                            {{ \Illuminate\Support\Str::of($timezone)->substr(strpos($timezone, '+') === false && strpos($timezone, '-') === false ? 0 : (strpos($timezone, '+') === false ? strpos($timezone, '-') : strpos($timezone, '+'))) }}
                            Hours</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-2s">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2">GMT</p>
                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span
                                    class="dataWithTime">{{ convertGmtStringToDateTime('GMT +0')['time2'] }}</span>
                                <span class="dataWithTime2">{{ convertGmtStringToDateTime('GMT +0')['identy'] }}</span>
                            </p>
                            <input type="hidden"
                                value="{{ convertGmtStringToDateTime('GMT +0')['currentTimewithoutID'] }}"
                                class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Second row -->
        <div class="row justify-content-center text-center bg-light p-md-5 pb-0">
            <h2 class=" wow animate__animated animate__fadeInUp">{{ $name }} time to UTC</h2>

            <h3 class="mb-4 wow animate__animated animate__fadeInUp"
                style="color: #BDC1CA;font-weight: 400;font-size: 16px">

                {{ $name }} time is {{ convertGmtStringToDateTime(getGmtOffset($timezone))['hours'] }}:00
                hours
                ahead of Coordinated Universal Time</h3>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2">
                                {{ $name }} Time</p>

                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['timeWithout'] }}</span> <span
                                    class="dataWithTime2">{{ $date['identify'] }}</span></p>
                            <input type="hidden" value="{{ $date['currentTimeWithSecond'] }}" class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                    <div class="d-flex justify-content-between px-lg-4  align-items-center">
                        <p class="gmt1 m-0">UTC</p>

                        <p class="gmt2 m-0">
                            {{ \Illuminate\Support\Str::of($timezone)->substr(strpos($timezone, '+') === false && strpos($timezone, '-') === false ? 0 : (strpos($timezone, '+') === false ? strpos($timezone, '-') : strpos($timezone, '+'))) }}
                            Hours</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-2s">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2 ">UTC</p>
                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span
                                    class="dataWithTime">{{ convertGmtStringToDateTime('GMT +0')['time2'] }}</span>
                                <span class="dataWithTime2">{{ convertGmtStringToDateTime('GMT +0')['identy'] }}</span>
                            </p>
                            <input type="hidden"
                                value="{{ convertGmtStringToDateTime('GMT +0')['currentTimewithoutID'] }}"
                                class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if (count($countries) > 0)
            @include('front.sections.similarTopCities')
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timeDisplays = document.querySelectorAll('.dataWithTime');
            const timeSeconds = document.querySelectorAll('.dataWithSecond');
            timeDisplays.forEach((display, index) => {
                const timeElement = timeSeconds[index];
                let [hours, minutes, seconds] = timeElement.value.split(':').map(Number);

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
                    timeElement.value =
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
</section>
<!-- TimeZones end -->
