<!-- TimeZones -->
<section class="TimeZones">
    <div class="container-fluid position-relative">

        @if ($type && $type == 'abbreviation')
            <!-- city row -->
            <div class="row justify-content-center text-center bg-light p-md-5 pb-0">

                <h2 class=" wow animate__animated animate__fadeInUp mb-3" style="font-size:38px;">{{ $timezoneName }} time
                    to
                    {{ $diffBetweenZoneAndCity['cityName'] }}</h2>

                <div class="col-lg-5 mb-3 col-12">
                    <div
                        class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="text-start">
                                <p class="h2 ">
                                    {{ $timezoneName }} Time</p>

                            </div>
                            <div class="text-end mt-2 display-5">
                                <p class="therdText"><span class="dataWithTime">{{ $date['time'] }}</span> <span
                                        class="dataWithTime2">{{ $date['identify'] }}</span></p>
                                <input type="hidden" value="{{ $date['currentTimeWithSeconds'] }}"
                                    class="dataWithSecond">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 col-12">
                    <div
                        class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="gmt2 m-0 text-center">
                                {{ $diffBetweenZoneAndCity['diffHours'] }} </p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 mb-3 col-12">
                    <div
                        class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-2s">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="text-start">
                                <p class="h2"> {{ $diffBetweenZoneAndCity['cityName'] }} time</p>
                            </div>
                            <div class="text-end mt-2 display-5">
                                <p class="therdText"><span
                                        class="dataWithTime">{{ Carbon\Carbon::parse($diffBetweenZoneAndCity['cityTime'])->format('h:i') }}</span>
                                    <span
                                        class="dataWithTime2">{{ Carbon\Carbon::parse($diffBetweenZoneAndCity['cityTime'])->format('A') }}</span>
                                </p>
                                <input type="hidden"
                                    value="{{ Carbon\Carbon::parse($diffBetweenZoneAndCity['cityTime'])->format('H:i:s') }}"
                                    class="dataWithSecond">
                            </div>

                        </div>
                    </div>
                </div>
                <h3 class="mb-4 wow animate__animated animate__fadeInUp"
                    style="color: #BDC1CA;font-weight: 400;font-size: 16px">
                    {{ $timezoneName }} time is {{ $diffBetweenZoneAndCity['diffHours'] }} hours ahead of
                    {{ $diffBetweenZoneAndCity['cityName'] }} Time
                </h3>
            </div>
        @endif

        <!-- GMT row -->
        <div class="row justify-content-center text-center bg-light p-md-5 pb-0">

            <h2 class=" wow animate__animated animate__fadeInUp mb-3" style="font-size:38px;">{{ $timezoneName }} time
                to GMT</h2>

            <div class="col-lg-5 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2 ">
                                {{ $timezoneName }} Time</p>

                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['time'] }}</span> <span
                                    class="dataWithTime2">{{ $date['identify'] }}</span></p>
                            <input type="hidden" value="{{ $date['currentTimeWithSeconds'] }}" class="dataWithSecond">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-2 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="https://www.theclocktime.com/GMT{{ $sign . $hoursNumber }}">
                            <p class="gmt2 m-0 text-center">
                                {{ $sign . $hours }}
                            </p>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-2s">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2">GMT time</p>
                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['utc'] }}</span>
                                <span class="dataWithTime2">{{ $date['utcIdentify'] }}</span>
                            </p>
                            <input type="hidden" value="{{ $date['utcWithSeconds'] }}" class="dataWithSecond">
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="mb-4 wow animate__animated animate__fadeInUp"
                style="color: #BDC1CA;font-weight: 400;font-size: 16px">
                {{ $timezoneName }} time is {{ $sign . $hours }} hours ahead of Greenwich Mean Time
            </h3>
        </div>


        <!-- UTC row -->
        <div class="row justify-content-center text-center bg-light p-md-5 pb-0">
            <h2 class=" wow animate__animated animate__fadeInUp mb3" style="font-size:38px;">{{ $timezoneName }} time
                to UTC</h2>


            <div class="col-lg-5 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2">
                                {{ $timezoneName }} Time</p>

                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['time'] }}</span> <span
                                    class="dataWithTime2">{{ $date['identify'] }}</span></p>
                            <input type="hidden" value="{{ $date['currentTimeWithSeconds'] }}" class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="https://www.theclocktime.com/UTC{{ $sign . $hoursNumber }}">
                            <p class="gmt2 m-0 text-center">
                                {{ $sign . $hours }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-3 col-12">
                <div
                    class="h-100 border rounded-3 px-3 text-lg-end me-lg-4 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-2s">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="text-start">
                            <p class="h2 ">UTC</p>
                        </div>
                        <div class="text-end mt-2 display-5">
                            <p class="therdText"><span class="dataWithTime">{{ $date['utc'] }}</span>
                                <span class="dataWithTime2">{{ $date['utcIdentify'] }}</span>
                            </p>
                            <input type="hidden" value="{{ $date['utcWithSeconds'] }}" class="dataWithSecond">
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="mb-4 wow animate__animated animate__fadeInUp"
                style="color: #BDC1CA;font-weight: 400;font-size: 16px">
                {{ $timezoneName }} time is {{ $sign . $hours }} hours ahead of Coordinated Universal Time
            </h3>
        </div>


        @if (isset($countries) && count($countries) > 0)
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
                    seconds++;
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

                    const isPM = hours >= 12;
                    const displayHours = hours % 12 || 12;
                    const formattedTime = `${displayHours}:${String(minutes).padStart(2, '0')}`;
                    const amPmText = isPM ? 'PM' : 'AM';

                    display.textContent = formattedTime;
                    display.nextElementSibling.textContent = amPmText;
                }

                setInterval(updateTime, 1000);
            });
        });
    </script>

</section>
<!-- TimeZones end -->
