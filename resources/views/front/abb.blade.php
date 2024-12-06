@extends('front.inc.layout')
@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)
@section('url', urldecode(url()->current()))
@section('ogImage', $ogImage)
@section('ogImageAlt', $ogImageAlt)
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>

@endsection
@section('container')
    @include('front.headers.convertAbbHeader')


  @include('front.sections.abb_timezones')

    @include('front.converts.convertAbbToTime')

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
