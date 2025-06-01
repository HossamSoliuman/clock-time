@extends('front.time-converters.shared-sections')
@section('section')
    @php
        $images = File::files('images/gallery/sand-timers');
        $count = count($images);
        if ($count < 16) {
            $repeat = ceil(16 / $count);
            $images = collect($images)->flatMap(fn($i) => array_fill(0, $repeat, $i))->take(16);
        }
    @endphp

    <div class="container py-5">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 mb-4">
                    <img src="{{ asset('images/gallery/sand-timers/' . basename($image)) }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    </div>
@endsection
