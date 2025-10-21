@extends('front.inc.layout')
@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)
@section('ogImage', asset('images/country-time.jpg'))
@section('ogImageAlt', $title)
@section('url', urldecode(url()->current()))

@section('container')

    @include('front.time.sections.header')

    @include('front.sections.googleAds')

    @include('front.time.sections.timezoneToGmtUtc')

    @include('front.time.sections.similarCity')

    @include('front.time.sections.convertCountryToCountry')

    @include('front.time.sections.countrySearch')

    @include('front.time.sections.countryCitySearch')

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
