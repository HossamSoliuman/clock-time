@extends('front.inc.layout')


@section('container')


    @include('front.sections.header')


    @php
        $imageUrl = 'public/1.webp';
    @endphp
    <style>
        .img-city {
            background-image: url({{asset('/')}}{{ $imageUrl }});
        }
    </style>



@endsection
