<!-- Cities -->
<section class="citiesSection" style="margin-top: 10px">
    <div class="container">
        <div class="text-center">
            <h2 class=" wow animate__animated animate__fadeInUp">Time in World Major Cities </h2>
        </div>
        <div class="row justify-content-center text-center p-md-3">
            @foreach ($data['capital'] as $city)
                <div class="col-lg-4 col-md-6 col-12">
                    @php
                        $cityName = $city->name;
                        $currentTimeWithoutSecond = $city->currentTime;
                        $currentTimeWithSecond = $city->currentTimeWithSecond;
                        $identify = $city->identify;

                    @endphp
                    <div>
                        <div
                            class="border rounded-3 px-3 text-lg-end mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow h-100">
                            <div class="row justify-content-between h-100">
                                <div class="col-lg-6 col-7">
                                    <div class="text-start h-100 d-flex flex-column justify-content-center">
                                        <a href="{{ url($city->slug) }}" title="{{ $city->name }} time now">
                                            <p class="mb-1 citiesSectionp w-100 text-truncate"
                                                style="margin-top:11px; white-space: nowrap;">
                                                {{ $city->name }}
                                            </p>
                                        </a>
                                        <input type="hidden" id="timeWith{{ $city->slug }}"
                                            class="citiesSectionTimeSecond" value="{{ $currentTimeWithSecond }}">
                                        <p class="citiesSectionh2 mb-1 w-100"
                                            style="font-family:'Lexend', serif; white-space: nowrap;"
                                            id="timeWithout{{ $city->slug }}">
                                            <span
                                                class="citiesSectionTime">{{ $currentTimeWithoutSecond }}</span><span>{{ $identify }}</span>
                                        </p>
                                        <a href="{{ url($city->countrySlug) }}" title="{{ $city->country }} time now">
                                            <p class="w-100"
                                                style="color: #9095A1; font-family: Lexend,serif; font-size: 18px; white-space: nowrap;">
                                                {{ $city->country }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-5">
                                    <div class="text-md-end py-3 h-100">
                                        @php
                                            $imageUrl =
                                                strlen($city->country) > 0
                                                    ? 'public/country/' . $city->country
                                                    : 'public/ImgHomePage/city.svg';
                                        @endphp
                                        <img loading="lazy" src="{{ $city->image }}" class="capitalImages"
                                            alt="{{ $city->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Cities end -->
