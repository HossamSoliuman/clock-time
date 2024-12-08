@extends('front.inc.layout')
@section('title', 'Find City Time')
@section('description', 'Find the current time in any city worldwide with our easy-to-use city time tool. Instantly check local times, time zones, and explore time differences across cities for seamless planning ')
@section('keywords', 'world time, city time, current time in city, time in any city, city time converter, global time lookup, city clock, time by city, city timezone, time finder, local time in city, check time in city, city time zone, international city time, city time search, time in major cities, find time anywhere, world clock by city')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/city-time.jpg')
@section('ogImageAlt', 'City time')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/city-time.jpg'
 @endphp
@section('container')

    @include('front.headers.convertCountryHeader')


    @include('front.sections.search')

    @include('front.sections.meeting')


    <script>
        $(document).ready(function() {
            $('#cityTocity').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: formData,
                    success: function(response) {

                        $('#city_1').text(response.city1);
                        $('.converterUTC .col-lg-5:first .second').text(response.time1);

                        $('#city_2').text(response.city2);

                        $('.converterUTC .col-lg-5:last .second').text(response.time2);
                        // Show the hidden div
                        $('.converterUTC').show();

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
