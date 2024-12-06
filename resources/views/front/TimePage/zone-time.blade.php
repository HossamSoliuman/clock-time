@extends('front.inc.layout')
@section('title', 'Find any time zone utc')
@section('description', 'Find the any Time Zone UTC time and easily convert it to your local time zone. Discover time zone differences and plan your global activities with precision.')
@section('keywords', 'time zone finder, find time zone, time zone lookup, get timezone , timezones finder , check time zone , time in my timezone , current time zone time ,time timezone,what timezone , my timezone , time zone offfset , search timezones, timezone info, time now in timezone ,time right now, timezone clock now  ,date and time in timezone  ,local timezone time ,time in timezone just now, exact timezone')
@section('ogImageAlt', 'Timezone finder')
@section('ogImage', 'https://theclocktime.com/images/timezone-finder.jpg')
@section('url', urldecode(url()->current()))
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/TimeZone.jpg'
@endphp
@section('container')

    @include('front.headers.convertCountryHeader')

    @include('front.sections.searchTime')

    @include('front.sections.meeting')

@endsection
