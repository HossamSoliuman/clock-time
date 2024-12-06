@extends('sitemap.header-sitemap')

@section('content')
    @php
        $cities = App\Models\City::select('id', 'slug')->get();
    @endphp

    @foreach ($cities as $city)
        <url>
            <loc>{{ url($city->slug) }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
@endsection
