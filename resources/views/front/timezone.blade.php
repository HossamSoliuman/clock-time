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
    @include('front.time.sections.header')
    @include('front.sections.googleAds')
    @if ($type && $type == 'abbreviation')
        @include('front.time.sections.timezoneToCity')
    @endif
    @include('front.time.sections.timezoneToGmtUtc')
    @include('front.time.sections.convertBetweenTimezones')
    @if ($type && $type == 'abbreviation')
        @include('front.time.sections.highestTimeZones')
        @include('front.time.sections.timeIn24')
    @endif
    @include('front.sections.meeting')

    <script>
        $(document).ready(function() {
            $('#abbTotz').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        abb: "{{ $slug }}",
                        tz: tagify2.value[0].slug,
                    },
                    success: function(response) {
                        $('#abb').text(response.abb);
                        $('#abb_time').text(response.abb_time);


                        $('#tz').text(response.tz);
                        $('#tz_name').text(response.tz_name);
                        $('.converterUTC').show();

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>

@endsection
