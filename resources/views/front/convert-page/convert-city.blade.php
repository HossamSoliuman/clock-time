@extends('front.inc.layout')
@section('title', 'Convert Time between cities')
@section('description', 'Effortlessly convert time between cities around the world. A simple and accurate tool to help you manage time differences and schedule events across global locations.')
@section('keywords', 'Convert Time between cities,Convert Time between 2 cities ,Convert Time city,Converter for Time Zone,Time Zones calculator ,convert time timezone ,convert time difference,city time zone calculator, time converter, cities time conversion tool, city time calculator,cities  time difference calculator, time conversion,city  local time calculator, cross time zone calculator, global time converter, calculate time difference')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/convert-city.jpg')
@section('ogImageAlt', 'Convert Time between cities')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/convert-city.jpg';
@endphp
@section('container')

    @include('front.headers.convertCountryHeader')

    @include('front.converts.convertCityToCity')

{{--    @include('front.sections.clockCountry')--}}

    @include('front.sections.meeting')

    <script>
        $(document).ready(function() {
            $('#city').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form action URL and form data
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: formData,
                    success: function(response) {
                        // Process the response and update the hidden section
                        // Assuming the response contains the time data to display
                        // For example, let's say response has 'country1', 'city1', 'time1', 'country2', 'city2', 'time2'

                        $('#country1').text(response.country1);
                        $('#city1').text(response.city1);
                        $('#img1').attr('src', response.flag1);

                        $('.converterUTC .col-lg-5:first .second').text(response.time1);
                        $('#utc1').text(response.utc1);
                        $('#gmt1').text(response.gmt1);

                        $('#country2').text(response.country2);
                        $('#city2').text(response.city2);
                        $('#img2').attr('src', response.flag2);
                        $('.converterUTC .col-lg-5:last .second').text(response.time2);
                        $('#utc2').text(response.utc2);
                        $('#gmt2').text(response.gmt2);

                        // Show the hidden div
                        $('.converterUTC').show();
                        $('.analog').show();
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors here
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>

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

                        // Show the hidden div

                        // $('.analog').show();

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
