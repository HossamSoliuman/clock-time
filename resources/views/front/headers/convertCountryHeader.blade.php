<!-- Header -->
<div class="container-fluid text-white g-2 p-0 me-0">
    <style>
        .img-city {
            background-image: url({{asset('/')}}{{ $imageUrl ?? 'public/ImgHomePage/banner.svg' }});
        }
    </style>

    <div class="img-city img-city-convert-country">
        <div class="overlay">
            <div
                class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                <div class="cityBanner w-100">
                    <h1>
                        {{$name_1}}
                        @isset($name_2)
                        <br>
                        {{$name_2}}
                        @endisset
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Header -->
