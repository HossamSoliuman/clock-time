@extends('front.time-converters.shared-sections')
@section('section')
    @php
        $images = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
            '5.jpg',
            '6.jpg',
            '7.jpg',
            '8.jpg',
            '9.jpg',
            '10.jpg',
            '11.jpg',
            '12.jpg',
            '13.jpg',
            '14.jpg',
            '15.jpg',
            '16.jpg',
        ];
    @endphp

    <div class="container py-5">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 mb-4">
                    <img src="{{ 'public/images/gallery/analog-clocks/' . $image }}" class="img-fluid rounded"
                        alt="{{ 'analog-clocks ' . $image }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection
