<!-- Header -->
<div class="container-fluid text-white g-2 p-0 me-0" style="margin-bottom: 8px">
    @php
        $imageUrl = 'public/ImgHomePage/banner.jpg';

    @endphp
    <style>
        .img-city {
            background-image: url({{asset('/')}}{{ $imageUrl }});
        }
    </style>
    <div class="img-city img-city-gmt">
        <div class="overlay">
            <div
                class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                <div class="cityBanner w-100">
                    <div class="mb-5">
                        <h1 class="mt-5 mb-0 pb-0">
                            {{ $date['time'] }}
                        </h1>
                        <h2 class="mt-0 pt-0">
                            {{ $gmt->$searchField }} Time Now
                        </h2>
                    </div>
                    <p class='display-5 mt-3'> {{ strtoupper($date['formatted_date']) }}
                    </p>
                    <button class="btn btn-convert rounded-2" role="button">
                        Time in  {{ $gmt->$searchField }}  is within the Time zone.
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Header -->
