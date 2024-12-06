@extends('front.inc.layout')
@section('title', 'Convert Time Zone')
@section('description', 'Quickly and easily convert time between different time zones worldwide. Accurate, reliable, and user-friendly tool to help you manage time differences with ease')
@section('keywords', 'Convert Time Zone,Convert Time between Zone,Convert Time Zones,Converter for Time Zone,Time Zones calculator ,convert time timezone ,convert time difference,time zone calculator, time zone converter, time conversion tool, world time calculator, time difference calculator, timezone calculator, time zone conversion, UTC to local time, convert time zones, local time calculator, cross time zone calculator, global time converter, calculate time difference')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/convert-timezone.jpg')
@section('ogImageAlt', 'Convert Time Zone')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@php
    $imageUrl = 'public/images/convert-timezone.jpg';
@endphp
@section('container')

    @include('front.headers.convertCountryHeader')

    @include('front.converts.convertAbbToTime')

{{--    @include('front.sections.clockCountry')--}}

    @include('front.sections.meeting')

    <script>
        $(document).ready(function () {
            $('#abbTotz').on('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form action URL and form data
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        abb: tagify.value[0].slug,
                        tz: tagify2.value[0].slug,
                    },
                    success: function (response) {
                        // Process the response and update the hidden section
                        // Assuming the response contains the time data to display
                        // For example, let's say response has 'country1', 'city1', 'time1', 'country2', 'city2', 'time2'

                        $('#abb').text(response.abb);
                        $('#abb_time').text(response.abb_time);


                        $('#tz').text(response.tz);
                        $('#tz_name').text(response.tz_name);


                        // Show the hidden div
                        $('.converterUTC').show();
                        tagify.removeAllTags();
                        tagify2.removeAllTags();

                        // $('.analog').show();

                    },
                    error: function (xhr, status, error) {
                        // Handle any errors here
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>
@endsection
