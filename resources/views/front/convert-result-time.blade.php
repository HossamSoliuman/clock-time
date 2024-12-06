@extends('front.inc.layout')
@section('title', 'Convert Time')
@section('description', 'description')
@section('keywords', 'keywords')
@section('url', urldecode(url()->current()))
@section('container')

    @include('front.sections.homeHeader')

    @if($data['first'])
        @if(isset($data['first']['timezone']) && count($data['first']['timezone'])>0)
            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                    From     <a href="{{url($data['first']['compare']->slug)}}" title="{{$data['first']['compare']->name}}">   {{$data['first']['compare']->name}} </a> is :

                </h1>

                {!! generateAbbreviationsLinks($data['first']['compare']->abbreviations) !!}
            </div>
                @foreach ($data['first']['timezone'] as $time)
                    <div class="row justify-content-center text-center bg-light p-5 pb-0">

                        <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                         <a href="{{url($time['data']->slug)}}" title="{{$time['data']->name}}">{{$time['data']->name}} </a> is :

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
                    From         <a href="{{url($data['first']['gmt']['data']->slug)}}" title="{{$data['first']['gmt']['data']->name}}">{{$data['first']['gmt']['data']->name}} </a>  is :

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
        @if(isset($data['second']['timezone']) && count($data['second']['timezone'])>0)
            <div class="row justify-content-center text-center bg-light p-5 pb-0">

                <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                    Compare With   <a href="{{url($data['second']['compare']->slug)}}" title="{{$data['second']['compare']->name}}">   {{$data['second']['compare']->name}} </a>  :


               </h1>


            {!! generateAbbreviationsLinks($data['second']['compare']->abbreviations) !!}

          </div>
              @foreach ($data['second']['timezone'] as $time)
                  <div class="row justify-content-center text-center bg-light p-5 pb-0">
                  <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">
                      <a href="{{url($time['data']->slug)}}" title="{{$time['data']->name}}">


                           {{$time['data']->name}} </a>
                     is :


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
                   Compare With
                   <a href="{{url($data['second']['gmt']['data']->slug)}}" title="{{$data['second']['gmt']['data']->name}}">{{$data['second']['gmt']['data']->name}} </a>
               is :

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
