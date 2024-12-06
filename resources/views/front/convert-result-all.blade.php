@extends('front.inc.layout')
@section('title', 'Convert')
@section('description', 'description')
@section('keywords', 'keywords')
@section('url', urldecode(url()->current()))
@section('container')

    @include('front.sections.homeHeader')

    @if($data['first'])
        @if(isset($data['first']['timezone']))
            @if(count($data['first']['timezone'])>2)
                @foreach ($data['first']['timezone'] as $time)
                    <div class="row justify-content-center text-center bg-light p-5 pb-0">

                        <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                            From :

                            <a href="{{url($time['data']->slug)}}" title="{{$time['data']->utc_name}}">{{$time['data']->utc_name}} </a> </h1>

                        <div class="col-lg-6 col-12">
                            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                                <div class="d-flex justify-content-between">
                                    <div class="text-start">
                                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                                    </div>
                                    <div class="text-end mt-2 display-5">

                                        <p style="color: #9095A1;">{{$time['time']}}</p>
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

                                        <p style="color: #9095A1;">{{$time['date']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else

                <div class="row justify-content-center text-center bg-light p-5 pb-0">

                    <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">


                        From :

                        <a href="{{url($data['first']['timezone'][0]['data']->slug)}}" title="{{$data['first']['timezone'][0]['data']->name}}">{{$data['first']['timezone'][0]['data']->name}} </a> </h1>

                    <div class="col-lg-6 col-12">
                        <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                            <div class="d-flex justify-content-between">
                                <div class="text-start">
                                    <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                                </div>
                                <div class="text-end mt-2 display-5">

                                    <p style="color: #9095A1;">{{$data['first']['timezone'][0]['time']}}</p>
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

                                    <p style="color: #9095A1;">{{$data['first']['timezone'][0]['date']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

        @elseif(isset($data['first']['city']))
            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                    From :

                    <a href="{{url($data['first']['city']['data']->slug)}}" title="{{$data['first']['city']['data']->country->name}} / {{$data['first']['city']['data']->name}}">{{$data['first']['city']['data']->country->name}} / {{$data['first']['city']['data']->name}} </a> </h1>

                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                            </div>
                            <div class="text-end mt-2 display-5">

                                <p style="color: #9095A1;">{{$data['first']['city']['time']}}</p>
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

                                <p style="color: #9095A1;">{{$data['first']['city']['date']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






    @else
        <div class="row justify-content-center text-center bg-light p-5 pb-0">

            <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                From :

                <a href="{{url($data['first']['gmt']['data']->slug)}}" title="{{$data['first']['gmt']['data']->utc_name}}">{{$data['first']['gmt']['data']->utc_name}} </a> </h1>

            <div class="col-lg-6 col-12">
                <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between">
                        <div class="text-start">
                            <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                        </div>
                        <div class="text-end mt-2 display-5">

                            <p style="color: #9095A1;">{{$data['first']['gmt']['time']}}</p>
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

                            <p style="color: #9095A1;">{{$data['first']['gmt']['date']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif


    @endif

    @if($data['second'])
        @if(isset($data['second']['timezone']))

            @if( count($data['second']['timezone'])>2)
            @foreach ($data['second']['timezone'] as $time)
                <div class="row justify-content-center text-center bg-light p-5 pb-0">

                    <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                        Compare with :

                        <a href="{{url($time['data']->slug)}}" title="{{$time['data']->utc_name}}">


                            {{$time['data']->utc_name}} </a> </h1>

                    <div class="col-lg-6 col-12">
                        <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                            <div class="d-flex justify-content-between">
                                <div class="text-start">
                                    <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                                </div>
                                <div class="text-end mt-2 display-5">

                                    <p style="color: #9095A1;">{{$time['time']}}</p>
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

                                    <p style="color: #9095A1;">{{$time['date']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else

            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">


                    Compare with :

                    <a href="{{url($data['second']['timezone'][0]['data']->slug)}}" title="{{$data['second']['timezone'][0]['data']->name}}">{{$data['second']['timezone'][0]['data']->name}} </a> </h1>

                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                            </div>
                            <div class="text-end mt-2 display-5">

                                <p style="color: #9095A1;">{{$data['second']['timezone'][0]['time']}}</p>
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

                                <p style="color: #9095A1;">{{$data['second']['timezone'][0]['date']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif





        @elseif(isset($data['second']['city']))
            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                    Compare with :

                    <a href="{{url($data['second']['city']['data']->slug)}}" title="{{$data['second']['city']['data']->country->name}} / {{$data['second']['city']['data']->name}}"> {{$data['second']['city']['data']->country->name}} / {{$data['second']['city']['data']->name}} </a> </h1>

                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                            </div>
                            <div class="text-end mt-2 display-5">

                                <p style="color: #9095A1;">{{$data['second']['city']['time']}}</p>
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

                                <p style="color: #9095A1;">{{$data['second']['city']['date']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        @else
            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                    Compare with :

                    <a href="{{url($data['second']['gmt']['data']->slug)}}" title="{{$data['second']['gmt']['data']->utc_name}}">{{$data['second']['gmt']['data']->utc_name}} </a> </h1>

                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;"> Time :  </p>

                            </div>
                            <div class="text-end mt-2 display-5">

                                <p style="color: #9095A1;">{{$data['second']['gmt']['time']}}</p>
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

                                <p style="color: #9095A1;">{{$data['second']['gmt']['date']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

@endsection
