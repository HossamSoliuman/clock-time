@extends('front.inc.layout')
@section('title', $abb->name)
@section('description', 'description')
@section('keywords', 'keywords')
@section('url', urldecode(url()->current()))
@section('style')
    <style>
        .MeetingSection {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection

@section('container')

    @include('front.headers.convertAbbHeader')

    @include('front.converts.convertUTCToCity')

    @include('front.sections.clockUTC')

    @include('front.sections.meeting')

    <script>
        $(document).ready(function () {
            $('#utcToCity').on('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form action URL and form data
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: formData,
                    success: function (response) {
                        // Process the response and update the hidden section
                        // Assuming the response contains the time data to display
                        // For example, let's say response has 'country1', 'city1', 'time1', 'country2', 'city2', 'time2'

                        $('#utc').text(response.utc);
                        $('#time1').text(response.time1);
                        $('#utc1').text(response.utc1);
                        $('#gmt1').text(response.gmt1);

                        $('#city').text(response.city);
                        $('#time2').text(response.time2);

                        $('#city2').text(response.city2);
                        $('#gmt2').text(response.gmt2);
                        // Show the hidden div
                        $('.converterUTC').show();
                        $('.analog').show();
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
