@extends('front.inc.layout')
@section('title', 'Convert Time between Countries')
@section('description',
    'Effortlessly convert time between Countries around the world. A simple and accurate tool to
    help you manage time differences and schedule events across global locations.')
@section('keywords',
    'Convert Time between Countries,Convert Time between 2 Countries,Convert Time Country,Converter for
    Time Zone,CountriesTime calculator ,convert time timezone ,convert time difference,Country time zone calculator, time
    converter, Countries time conversion tool, Countries time calculator,Countries time difference calculator, time
    conversion,country local time calculator, cross time zone calculator, global time converter, calculate time difference')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/convert-Country.jpg')
@section('ogImageAlt', 'Convert Time between Countries')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/convert-country.jpg';
@endphp
@section('container')

    <!-- Header -->
    <div class="container-fluid text-white g-2 p-0 me-0">
        <div class="img-city img-city-convert-country">
            <div class="overlay">
                <div
                    class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                    <div class="cityBanner w-100">

                        @if (Request::is('epoch-unix'))
                            <h5>
                                {{ $head }}
                            </h5>
                            <h1 id="currentUnix" class="mt-3" style="font-size: 200px">
                                {{ time() }}
                            </h1>
                            <h5 id="currentDate" class="mt-1">
                                {{ gmdate('D, d M Y H:i:s \G\M\T', time()) }}
                            </h5>
                        @else
                            <h1>
                                {{ $head }}
                            </h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Header -->
    @yield('section')
    @include('front.time.sections.homeConverters')
    @include('front.time.sections.tools')
    @include('front.converts.convertAbbToTime')

    @include('front.sections.meeting')
@endsection
