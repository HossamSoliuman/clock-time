<!-- Header -->
<div class="container-fluid text-white g-2 p-0 me-0">
    <style>
        .img-city {
            background-image: url({{asset('/')}}{{ $imageUrl ?? 'public/images/banner.jpg' }});
        }
    </style>
    <div class="img-city">
        <div class="overlay">
            <div class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                @livewire('banner', [
                    'lat' => $data['lat'],
                    'lng' => $data['lng'],
                    'cityName' => $data['name'],
                    'data' => $data,
                ])
                 {{-- @include('livewire.banner') --}}
            </div>
        </div>
    </div>

</div>
<!-- end Header -->
