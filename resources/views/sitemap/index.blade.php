@extends('sitemap.header-sitemap')

@section('content')

    <url>
        <loc>{{url('/')}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{url('sitemap-timezone.xml')}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{url('sitemap-country.xml')}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{url('sitemap-city.xml')}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

@endsection




