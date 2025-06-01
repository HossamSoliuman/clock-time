@extends('front.time-converters.shared-sections')
@section('section')
    @php
        $images = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '1.jpg',
            '2.jpg',
            '3.jpg',
        ];
    @endphp

    <div class="container py-5">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 mb-4">
                    <img src="{{ asset('public/images/d.jpg') }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    </div>
@endsection
