@extends('sitemap.header-sitemap')

@section('content')
    @php
        $countries = App\Models\Country::select('id', 'slug')->get();
    @endphp
    @if ($countries != null && $countries->count() > 0)
        @foreach ($countries as $country)
            <url>
                <loc>{{ url($country->slug) }}</loc>
                <lastmod>{{ date('Y-m-d') }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

@endsection
