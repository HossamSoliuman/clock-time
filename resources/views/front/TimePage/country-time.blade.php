@extends('front.inc.layout')
@section('title', 'Find Country Time')
@section('description', 'Check the current time in any country with our accurate country time tool. Easily view local times, time zones, and time differences to stay informed and plan across borders effortlessly')
@section('keywords', 'world time, country time, current time in country, time in any country, country time converter, global time lookup, country clock, time by country, country timezone, time finder, local time in country, check time in country, country time zone, international country time, country time search, time in major countries, find time anywhere, world clock by country')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/country-time.jpg')
@section('ogImageAlt', 'country time')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/country-time.jpg'
@endphp
@section('container')

    @include('front.headers.convertCountryHeader')


    @include('front.sections.countrySearch')

    @include('front.sections.meeting')



@endsection
