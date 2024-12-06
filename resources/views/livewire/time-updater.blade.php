    <div class="d-flex justify-content-between">
        <div class="">
            <div class="text-start">
                <p class="h2">
                    @if ($country == 'yes')
                        <img loading="lazy" src="{{ asset('vendor/blade-flags/country-' . \Str::lower($city->iso2) . '.svg') }}" title="{{ $city->country->name }}"
                            width="57" height="90" alt="" style="margin-right: 10px" />
                        {{ $city->country->name }}
                    @else
                        {{ $cityName }}
                    @endif

                </p>
                <p class="m-0 secoundText"> {{ $dayOfWeek }}</p>
            </div>
        </div>
        <div class="">
            <div class="text-end">
{{--                <p class="gmt2 m-0">{{ $currentTime }}</p>--}}

                <p class="gmt2 m-0"> <span class="current-time-display"> {{ $currentTime }} </span> <span class="current-time2-display">{{$identify}}</span> </p>
                <!-- Hidden input to hold seconds value -->
                <input type="hidden" class="current-time-seconds" data-time="{{ $currentTimeWithSecond }}">

            </div>
        </div>
    </div>
