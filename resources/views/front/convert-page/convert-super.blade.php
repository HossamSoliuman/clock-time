@extends('front.inc.layout')
@section('title', 'Time Difference Calculator')
@section('description', 'Time Difference Calculator: Find time differences, time zone converter, world clock, time zone map, time zone abbreviations ,cities time ')
@section('keywords', 'time calculator, time zone converter, time conversion tool, world time calculator, time difference calculator, timezone calculator, time zone conversion, UTC to local time, convert time zones, time converter online, international time converter, time conversion, time difference converter, world clock converter, local time calculator, cross time zone calculator, global time converter, calculate time difference')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/Time-calculator.jpg')
@section('ogImageAlt', 'Time Calculator')
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection
@section('container')

    @include('front.headers.convertCountryHeader')

    @include('front.converts.convertAllToAll')

    @include('front.sections.clockCountry')

    @include('front.sections.meeting')

    <script>
        $(document).ready(function() {
            $('#AllToAll').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form action URL and form data
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        super_1: tagify.value[0].slug,
                        super_2: tagify3.value[0].slug,
                    },
                    success: function(response) {
                        // Process the response and update the hidden section
                        // Assuming the response contains the time data to display
                        // For example, let's say response has 'country1', 'city1', 'time1', 'country2', 'city2', 'time2'

                        $('#super_1').text(response.super_1);
                        $('#super_time_1').text(response.super_time_1);
                        $('#utc1').text(response.super_utc_1);
                        $('#gmt1').text(response.super_gmt_1);

                        $('#super_2').text(response.super_2);
                        $('#super_time_2').text(response.super_time_2);
                        $('#utc2').text(response.super_utc_2);
                        $('#gmt2').text(response.super_gmt_2);

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
