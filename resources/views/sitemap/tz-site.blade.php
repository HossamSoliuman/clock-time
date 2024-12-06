@extends('sitemap.header-sitemap')

@section('content')
    @php
        $gmts = App\Models\Gmt::select('slug', 'utc_slug')->get();
        $time = date('Y-m-d');
    @endphp

    @foreach ($gmts as $gmt)
        <url>
            <loc>{{ url($gmt->slug) }}</loc>
            <lastmod>{{ $time }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ url($gmt->utc_slug) }}</loc>
            <lastmod>{{ $time }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @php
        $IanaTimezones = App\Models\IanaTimezone::select('slug')->get();
    @endphp

    @foreach ($IanaTimezones as $IanaTimezone)
        <url>
            <loc>{{ url($IanaTimezone->slug) }}</loc>
            <lastmod>{{ $time }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @php
        $TimezoneDetails = App\Models\TimezoneDetail::select('name_slug', 'long_slug')->get();
    @endphp

    @foreach ($TimezoneDetails as $TimezoneDetail)
        <url>
            <loc>{{ url($TimezoneDetail->name_slug) }}</loc>
            <lastmod>{{ $time }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ url($TimezoneDetail->long_slug) }}</loc>
            <lastmod>{{ $time }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
@endsection
