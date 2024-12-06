@extends('front.inc.layout')
@section('title', 'Convert GMT')
@section('description', 'description')
@section('keywords', 'keywords')
@section('url', urldecode(url()->current()))
@section('container')

    @include('front.sections.homeHeader')

    <div class="row justify-content-center text-center bg-light p-5 pb-0">

        <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
        From
            <a href="{{url($data['result_1']['data']->slug)}}" title="{{$data['result_1']['data']->name}}">


                {{$data['result_1']['data']->name}} is  </a> :

            <a href="{{url($data['result_1']['data']->slug)}}" title="{{$data['result_1']['data']->utc_name}}">


                {{$data['result_1']['data']->utc_name}} </a> </h1>

        <div class="col-lg-6 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                    </div>
                    <div class="text-end mt-2 display-5">

                        <p style="color: #9095A1;">{{$data['result_1']['time']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Date :  </p>

                    </div>
                    <div class="text-end mt-2 display-5">

                        <p style="color: #9095A1;">{{$data['result_1']['date']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center text-center bg-light p-5 pb-15">

        <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
      Compare With   <a href="{{url($data['result_2']['data']->slug)}}" title="{{$data['result_2']['data']->name}}">


                {{$data['result_2']['data']->name}} is  </a> :

            <a href="{{url($data['result_2']['data']->slug)}}" title="{{$data['result_2']['data']->utc_name}}">


                {{$data['result_2']['data']->utc_name}} </a> </h1>

        <div class="col-lg-6 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                    </div>
                    <div class="text-end mt-2 display-5">

                        <p style="color: #9095A1;">{{$data['result_2']['time']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Date :  </p>

                    </div>
                    <div class="text-end mt-2 display-5">

                        <p style="color: #9095A1;">{{$data['result_2']['date']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
