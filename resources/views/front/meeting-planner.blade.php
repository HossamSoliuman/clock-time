@extends('front.inc.layout')
@section('title', 'Meeting planner')
@section('description',
    'Plan meetings effortlessly across time zones with our free meeting planner. Easily coordinate
    schedules in different cities and countries, view time differences, and find the best meeting times for all
    participants.')
@section('keywords',
    'meeting schedule,free meeting scheduler,time zone event planner,timezone event planner,time and
    date meeting planner,meeting time zone planner,meeting planner, time zone planner, schedule across time zones, free
    meeting planner, international meeting scheduler, global time scheduler, multi-time zone planner, time zone converter,
    world meeting planner, cross-time zone meetings, time zone scheduler, online meeting planner, global meeting
    coordinator, city time planner, remote meeting scheduler, time zone calculator, worldwide meeting tool, best meeting
    time, time difference planner, global time coordination')
@section('url', urldecode(url()->current()))
@section('ogImage', 'https://theclocktime.com/images/Meeting-planner.jpg')
@section('ogImageAlt', 'Meeting planner')
@php
    $imageUrl = 'public/images/Meeting-planner.JPG';
@endphp
@section('container')

    @include('front.time.sections.header')

    @include('front.time.sections.meeting-planner')

    @include('front.converts.convertCityToCity')
    @include('front.time.sections.timezoneToGmtUtc')

    @include('front.sections.search')

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

    <script>
        $(document).ready(function() {
            $('#abbTotz').on('submit', function(event) {
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
                    success: function(response) {
                        // Process the response and update the hidden section
                        // Assuming the response contains the time data to display
                        // For example, let's say response has 'country1', 'city1', 'time1', 'country2', 'city2', 'time2'

                        $('#abb').text(response.abb);
                        $('#abb_time').text(response.abb_time);


                        $('#tz').text(response.tz);
                        $('#tz_name').text(response.tz_name);


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
