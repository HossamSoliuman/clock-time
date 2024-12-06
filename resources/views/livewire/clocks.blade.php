



                    <div class="me-2" style="padding-left: 25px">

                        <div class="clock" wire:ignore>
                            <div class="hour" id="hour-{{ $timezone }}"></div>
                            <div class="minute" id="minute-{{ $timezone }}"></div>
                            <div class="second" id="second-{{ $timezone }}"></div>
                            <div class="center"></div>
                        </div>
                        <a href="{{url($timezone)}}" title="{{ $timezone }}">
                        <h5>{{ $timezone }}</h5>
                        </a>
                    </div>



    <script>
        function runClock(time, city,timezone) {
            console.log(`Running clock for timezone: ${timezone} with time: ${time} city : ${city}}`);

            // // Parse the time with Moment.js and convert it to the appropriate timezone
            // const now = moment.tz.add(timezone);
            //
            // const hourHand = document.getElementById(`hour-${city}`);
            // const minuteHand = document.getElementById(`minute-${city}`);
            // const secondHand = document.getElementById(`second-${city}`);
            //
            // if (hourHand && minuteHand && secondHand) {
            //     const seconds = now.seconds();
            //     const minutes = now.minutes();
            //     const hours = now.hours();
            //
            //     const secondDeg = ((seconds / 60) * 360) + 90;
            //     const minuteDeg = ((minutes / 60) * 360) + ((seconds / 60) * 6) + 90;
            //     const hourDeg = ((hours % 12) / 12) * 360 + ((minutes / 60) * 30) + 90;
            //
            //     console.log(`Updating clock hands for ${timezone}: ${hourDeg}deg, ${minuteDeg}deg, ${secondDeg}deg`);
            //
            //     secondHand.style.transform = `rotate(${secondDeg}deg)`;
            //     minuteHand.style.transform = `rotate(${minuteDeg}deg)`;
            //     hourHand.style.transform = `rotate(${hourDeg}deg)`;
            // } else {
            //     console.warn(`Clock elements for timezone ${timezone} not found.`);
            // }
        }

        function initializeClocks() {
            console.log('Initializing clocks...');



            runClock("{{ $time }}", "{{ $timezone }}","{{ $cityName }}");

            // Convert time to ISO 8601 format and pass to runClock


        }

        // Run initially when the component is loaded
        initializeClocks();

        // Update clocks every second
        setInterval(function () {
            runClock("{{ $time }}", "{{ $timezone }}","{{ $cityName }}");
        }, 1000);

    </script>
