@extends('front.inc.layout')
@section('title', 'Time Zone')
@section('description', 'description')
@section('keywords', 'keywords')
@section('ogImage', 'https://theclocktime.com/images/time-zone.jpg')
@section('ogImageAlt', 'Time Zone')
@section('url', urldecode(url()->current()))
@section('container')

    @include('front.sections.homeHeader')

    @include('front.sections.gmt')

{{--    @include('front.sections.meeting')--}}

@endsection
