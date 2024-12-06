@extends('front.inc.layout')
@section('title', 'Convert Time between Countries')
@section('description', 'Effortlessly convert time between Countries around the world. A simple and accurate tool to help you manage time differences and schedule events across global locations.')
@section('keywords', 'Convert Time between Countries,Convert Time between 2 Countries,Convert Time Country,Converter for Time Zone,CountriesTime calculator ,convert time timezone ,convert time difference,Country time zone calculator, time converter, Countries time conversion tool, Countries time calculator,Countries time difference calculator, time conversion,country local time calculator, cross time zone calculator, global time converter, calculate time difference')
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

    @include('front.headers.convertCountryHeader')

    @include('front.converts.convertCountryToCountry')

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
                    data: {
                        search_1: tagify.value[0].slug,
                        search_2: tagify3.value[0].slug,
                    },
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
