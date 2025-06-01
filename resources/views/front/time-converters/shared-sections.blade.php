@extends('front.inc.layout')
@section('title', 'Time Converting')
@section('description',
    'Time
    Converters')
@section('keywords',
    'Time
    Converters')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/convert-Country.jpg')
@section('ogImageAlt',
    'Time
    Converters')
@section('style')

@endsection

@section('container')

    <!-- Header -->
    <div class="container-fluid text-white g-2 p-0 me-0" style="background-color: black">
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
