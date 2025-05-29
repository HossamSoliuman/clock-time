@extends('front.inc.layout')
@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)
@section('url', urldecode(url()->current()))
@section('ogImage', asset('images/theclocktime-logo.png'))
@section('ogImageAlt', 'the clock time logo')
@section('container')
@section('msvalidate', '8633E71DA03375A6E013D26DF14FDD3C')
@section('google-site-verification', '5cy7kTKZTqv_Rz1YTyNWF1LhueGxgXz5OD4MhLdv7vY')

@include('front.time.sections.homeHeader')

@include('front.sections.city')

@include('front.time.sections.tools')

@include('front.converts.convertAbbToTime')

@include('front.time.sections.homeSearchCountryCity')

@include('front.time.sections.homeConverters')

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

    document.addEventListener('DOMContentLoaded', function() {
        const timeDisplays = document.querySelectorAll('.citiesSectionTime');
        const timeSeconds = document.querySelectorAll('.citiesSectionTimeSecond');
        timeDisplays.forEach((display, index) => {
            const timeElement = timeSeconds[index];
            let [hours, minutes, seconds] = timeElement.value.split(':').map(Number);

            function updateTime() {
                let newHours = 0;
                seconds++; // Increment seconds
                let formattedTime2 = ' AM'
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                }
                if (minutes >= 60) {
                    minutes = 0;
                    hours++;
                }
                if (hours >= 24) {
                    hours = 0;
                }
                timeElement.value =
                    `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                if (hours >= 12) {
                    formattedTime2 = ' PM'
                }
                if (hours > 12) {
                    newHours = hours - 12;
                } else {
                    newHours = hours
                }
                if (seconds === 0) {
                    const formattedTime = newHours + ':' + String(minutes).padStart(2, '0');
                    display.textContent = formattedTime;
                    display.nextElementSibling.textContent = formattedTime2
                }
            }

            setInterval(updateTime, 1000);
        });
    });
</script>
@endsection
