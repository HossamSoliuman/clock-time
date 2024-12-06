<!-- Prayer time -->
<section class="PrayerSection" style="margin-top: 10px; margin-bottom:8px">
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 col-12 text-lg-start text-center ps-lg-5">
                <h2 class="mb-3">{{ $data['city']->name }} Prayer times </h2>
                <div class="border border-1 text-lg-start wow animate__animated animate__pulse animate__slow" id="table">
                    <table class="table table-striped table-hover m-0">
                        <tbody>
                            <tr class="even">
                                <th class='fw-bold'>Prayer </th>
                                <th class='fw-bold text-center'>Time</th>
                            </tr>
                            @include('livewire.payer-time')
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-12 text-end wow animate__animated animate__fadeIn animate__slow">
                <img loading="lazy" src="{{ asset('public') }}/ImgHomePage/mosque.svg" alt="mosque" />
            </div>
        </div>
    </div>
</section>
<!-- Prayer time end -->
