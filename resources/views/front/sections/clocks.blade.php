{{--<!-- Clocks -->--}}
{{--<div class="container-fluid" style='background-color: #08081A'>--}}
{{--    <div class="row text-center text-white py-5">--}}
{{--        <h1>World Major Cities Analog Clocks</h1>--}}
{{--        <div class="d-flex mt-2 justify-content-center">--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2">--}}
{{--                <img src="{{asset('public')}}/ImgHomePage/clock.svg" alt="" />--}}
{{--                <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12 text-center">--}}
{{--            <button class="btn-customize btn-hover rounded-2 py-1 px-3 mt-5">Get yours  customized</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- Clocks end -->--}}

{{--<div class="container-fluid" style='background-color: #08081A'>--}}
{{--    <div class="row text-center text-white py-5">--}}
{{--        <div class="d-flex mt-2 justify-content-center">--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--                <div class="clock">--}}
{{--                    <div class="hour" id="hour"></div>--}}
{{--                    <div class="minute" id="minute"></div>--}}
{{--                    <div class="second" id="second"></div>--}}
{{--                    <div class="center"></div>--}}
{{--                </div>--}}
{{--                    <h5>Dublin</h5>--}}
{{--            </div>--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--            <div class="clock">--}}
{{--                <div class="hour" id="hour"></div>--}}
{{--                <div class="minute" id="minute"></div>--}}
{{--                <div class="second" id="second"></div>--}}
{{--                <div class="center"></div>--}}
{{--            </div>--}}
{{--                <h5>Dublin</h5>--}}
{{--        </div>--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--            <div class="clock">--}}
{{--                <div class="hour" id="hour"></div>--}}
{{--                <div class="minute" id="minute"></div>--}}
{{--                <div class="second" id="second"></div>--}}
{{--                <div class="center"></div>--}}
{{--            </div>--}}
{{--                <h5>Dublin</h5>--}}
{{--        </div>--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--            <div class="clock">--}}
{{--                <div class="hour" id="hour"></div>--}}
{{--                <div class="minute" id="minute"></div>--}}
{{--                <div class="second" id="second"></div>--}}
{{--                <div class="center"></div>--}}
{{--            </div>--}}
{{--                <h5>Dublin</h5>--}}
{{--        </div>--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--            <div class="clock">--}}
{{--                <div class="hour" id="hour"></div>--}}
{{--                <div class="minute" id="minute"></div>--}}
{{--                <div class="second" id="second"></div>--}}
{{--                <div class="center"></div>--}}
{{--            </div>--}}
{{--                <h5>Dublin</h5>--}}
{{--        </div>--}}
{{--            <div class="me-2" style="padding-left: 25px">--}}
{{--            <div class="clock">--}}
{{--                <div class="hour" id="hour"></div>--}}
{{--                <div class="minute" id="minute"></div>--}}
{{--                <div class="second" id="second"></div>--}}
{{--                <div class="center"></div>--}}
{{--            </div>--}}
{{--                <h5>Dublin</h5>--}}
{{--        </div>--}}
{{--        </div>--}}


{{--    </div>--}}
{{--<!-- Clocks end -->--}}
{{--</div>--}}
{{--    <script>--}}
{{--        function runClock() {--}}
{{--            const hourHand = document.getElementById('hour');--}}
{{--            const minuteHand = document.getElementById('minute');--}}
{{--            const secondHand = document.getElementById('second');--}}

{{--            const now = new Date();--}}
{{--            const seconds = now.getSeconds();--}}
{{--            const minutes = now.getMinutes();--}}
{{--            const hours = now.getHours();--}}

{{--            const secondDeg = ((seconds / 60) * 360) + 90;--}}
{{--            const minuteDeg = ((minutes / 60) * 360) + ((seconds / 60) * 6) + 90;--}}
{{--            const hourDeg = ((hours % 12) / 12) * 360 + ((minutes / 60) * 30) + 90;--}}

{{--            secondHand.style.transform = `rotate(${secondDeg}deg)`;--}}
{{--            minuteHand.style.transform = `rotate(${minuteDeg}deg)`;--}}
{{--            hourHand.style.transform = `rotate(${hourDeg}deg)`;--}}
{{--        }--}}

{{--        setInterval(runClock, 1000);--}}
{{--        runClock(); // Call immediately to show the clock right away--}}
{{--    </script>--}}



<div class="container-fluid" style='background-color: #08081A'>
    <div class="row text-center text-white py-5">
        <div class="d-flex mt-2 justify-content-center">


        @foreach($data['cities'] as $city)


            @livewire('clocks', ['lat' => $city->lat, 'lng' => $city->lng,'cityName'=>$city->name,'city'=>$city])

        @endforeach

        </div>
    </div>
</div>

