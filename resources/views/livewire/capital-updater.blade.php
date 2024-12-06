<div>
    <div
        class="border rounded-3 px-3 text-lg-end mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow h-100">
        <div class="row justify-content-between h-100">
            <div class="col-lg-6 col-7">
                <div class="text-start h-100">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>

                            <a href="{{ url($city->slug) }}" title="{{ $cityName }} time now">
                                <p class="mb-0 citiesSectionp" style="margin-top:11px;">
                                    <img loading="lazy" src="{{ asset('vendor/blade-flags/country-' . \Str::lower($city->iso2) . '.svg') }}"
                                        width="25" height="20" alt="{{ $city->country->name }} Flag" class="me-2 pb-1"/>
                                    {{ $cityName }}
                                </p>
                            </a>
                            <!-- HTML content for each city block -->
                            <input type="hidden" id="timeWith{{ $city->iso2 }}" class="citiesSectionTimeSecond" value="{{ $currentTimeWithSecond }}">
                            <p class="citiesSectionh2 mb-0" style="font-family:'Lexend', serif;" id="timeWithout{{$city->iso2}}"><span class="citiesSectionTime">{{ $currentTimeWithoutSecond }} </span><span>{{ $identify }}</span> </p>
                        </div>
                        <a href="{{ url($city->country->slug) }}" title="{{ $city->country->name }} time now">
                            <p style="color: #9095A1;  font-family: Lexend,serif; font-size: 18px" class="p-0 mb-3"> {{ $city->country->name }}</p>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-5">

            <div class="text-md-end py-3 h-100">
                @php
                    $imageUrl =
                        strlen($city->country->image) > 0
                            ? 'public/country/' . $city->country->image
                            : 'public/ImgHomePage/city.svg';
                @endphp
                <img loading="lazy" src="{{ asset($imageUrl) }}" class="capitalImages" alt="{{ $city->name }}">
            </div>
            </div>
        </div>
    </div>
</div>




