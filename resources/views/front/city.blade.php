@extends('front.inc.layout')
@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)
@section('ogImage', asset('images/city-time.jpg'))
@section('ogImageAlt', $title)
@section('url', urldecode(url()->current()))
@php
    $imageUrl = 'public/images/city-time.jpg';
@endphp
@section('container')
    @include('front.time.sections.header')
    @include('front.sections.googleAds')
    @include('front.time.sections.timezoneToGmtUtc')
    @include('front.time.sections.similarCity')
    @include('front.time.sections.citySearch')
    @include('front.time.sections.convertCityToCity')
    @include('front.sections.meeting')
    <script>
        $(document).ready(function() {
            $('#cityTocity').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form action URL and form data
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        city_1: tagify.value[0].slug,
                        city_2: tagify3.value[0].slug,
                    },
                    success: function(response) {

                        $('#city_1').text(response.city1);
                        $('.converterUTC .col-lg-5:first .second').text(response.time1);

                        $('#city_2').text(response.city2);

                        $('.converterUTC .col-lg-5:last .second').text(response.time2);
                        // Show the hidden div
                        $('.converterUTC').show();
                        tagify.removeAllTags();
                        tagify3.removeAllTags();

                    },
                    error: function(xhr, status, error) {
                        // Handle any errors here
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>

@endsection
