@extends('sitemap.header-sitemap')

@section('content')
    @php
        $data = App\Models\Gmt::select('id','utc_slug')->get();
    @endphp


    @if($data != null && $data->count() > 0)

        @foreach($data as $item)

            <url>
                <loc>{{url($item->utc_slug)}}</loc>
                <lastmod>{{date("Y-m-d")}}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>


        @endforeach

    @endif

@endsection





