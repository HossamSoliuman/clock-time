<div >


    <h1 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp" style="align-content: center">Time Zone is :

        <a href="{{url($data->timezone->slug)}}" title="{{$data->timezone->name}}">


            {{$data->timezone->name}} </a> </h1>

    <div class="row justify-content-center text-center bg-light p-5 pb-0">

        <h1 class="mb-4 fw-bold wow animate__animated animate__fadeInUp">Capital :
            {{ optional($data->country->capitalCities())->name ?? 'No capital city found' }} time AT (UTC/GMT)
        </h1>
        <div class="col-lg-3 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow">
                <div class="d-flex justify-content-between">
                    <div class="text-start">
                        <p class="h2" style="color: #171A1F; margin-top: 6%; margin-bottom: -2%;">{{$data->country->name}} Time</p>
                        <p style="color: #9095A1;">{{$data->country->name}}</p>
                    </div>
                    <div class="text-end mt-2 display-5">

                                                                                <p style="color: #7F7F7F;">{{$currentTime}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                <div class="d-flex justify-content-between px-lg-4 py-3">
                    <h1 style="color: #171A1F;"><a href="{{url($data->gmt->utc_slug)}}" title="{{$data->gmt->utc_name}}">{{$data->gmt->utc_name}}</a></h1>

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                <div class="d-flex justify-content-between px-lg-4 py-3">
                    <h1 style="color: #171A1F;"><a href="{{url($data->gmt->slug)}}" title="{{$data->gmt->name}}">{{$data->gmt->name}}</a></h1>

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="border rounded-3 px-3 text-lg-end me-lg-4 mb-lg-0 mb-3 d-flex flex-column wow animate__animated animate__fadeIn animate__slow animate__delay-1s">
                <div class="d-flex justify-content-between px-lg-4 py-3">

                    <h1 style="color: #E90000;">DST : {{$data->gmt->dst}}</h1>
                </div>
            </div>
        </div>
    </div>


</div>
