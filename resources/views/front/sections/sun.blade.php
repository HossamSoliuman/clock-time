<!-- Sun -->
<section class="sunSection">
    <div class="container-fluid position-relative">
        <div class="row justify-content-center text-center text-white p-md-5 py-5 wow animate__animated animate__zoomIn">
            <div class="img-col col-lg-6 col-12 me-lg-5">
                <div class='d-flex mb-2 justify-content-center align-items-center'>
                    <h2 class="me-4">{{ $data['city']->name }} Sunrise time </h2>
                    <p>{{ $_SESSION['sunrise'] }} </p>
                </div>
                <img loading="lazy" src="{{ asset('public') }}/ImgHomePage/sunrise2.svg" alt="sunrise2" />
            </div>
            <div class="img-col col-lg-6 col-12 ms-lg-5 mt-lg-0 mt-4">
                <div class='d-flex mb-2 justify-content-center align-items-center'>
                    <h2 class="me-4">{{ $data['city']->name }} Sunset time </h2>
                    <p>{{ $_SESSION['sunset'] }} </p>
                </div>
                <img loading="lazy" src="{{ asset('public') }}/ImgHomePage/sunset2.svg" alt="sunset2" />
            </div>
        </div>
    </div>
</section>
<!-- Sun end -->
