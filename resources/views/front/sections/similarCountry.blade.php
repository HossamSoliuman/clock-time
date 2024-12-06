
<!-- Third row -->
<div class="row justify-content-center text-center bg-light p-5">
    <h1 class="mb-4 fw-bold wow animate__animated animate__fadeInUp">{{$name}} similar Country Clocks</h1>

{{--    {{dd($data['country']->timezones[0]->countries)}}--}}

@php

$countries = $data['country']->gmt[0]->getOtherCountries($data['country']->id);
foreach ($countries as $country){
    $capital[]= $country->capitalCities();
}

@endphp

    @if(count($capital)>0)

    @foreach($capital as $city)
        @if($city)
        <div class="col-lg-4 col-12">
            <a  href="{{url($city->slug)}}" title="{{$city->name}}">
                <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                    <div class="d-flex justify-content-between  ">


                        @livewire('time-updater', ['lat' => $city->lat, 'lng' => $city->lng,'cityName'=>$city->name,'country'=>'yes','city'=>$city])


                        {{--                        <div class="text-start">--}}
                        {{--                            <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;">{{$city->name}}</p>--}}
                        {{--                            <p style="color: #9095A1;">Daytime</p>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="text-end mt-2 display-5">--}}
                        {{--                            <p style="color: #E90000;">03:45 PM</p>--}}
                        {{--                        </div>--}}




                    </div>
                </div>
            </a>

        </div>
            @endif
    @endforeach

        @endif



</div>
