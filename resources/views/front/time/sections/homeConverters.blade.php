<section class="py-5" style="background-color: #05051a;">
    <div class="container text-white">
        <div class="row">
            <div class="col-lg-4 d-flex flex-column justify-content-center align-items-start text-white">
                <h1 class="fw-bold display-4">Time</h1>
                <h1 class="fw-bold display-4">Converters</h1>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-clock text-white"></i>
                        </div>
                        <a href="{{ url('/hours-to-decimal') }}" class="text-white text-decoration-none fw-bold">Hours
                            to decimal</a>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-code text-white"></i>
                        </div>
                        <a href="{{ url('/epoch-unix') }}" class="text-white text-decoration-none fw-bold">Epoch time
                            converter</a>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-hourglass-start text-white"></i>
                        </div>
                        <a href="{{ url('/minutes-to-hours') }}" class="text-white text-decoration-none fw-bold">Hours
                            to min</a>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-hourglass-end text-white"></i>
                        </div>
                        <a href="{{ url('/minutes-to-hours') }}" class="text-white text-decoration-none fw-bold">Minutes
                            to Hours</a>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-stopwatch text-white"></i>
                        </div>
                        <a href="{{ url('/hours-to-decimal') }}" class="text-white text-decoration-none fw-bold">Hours
                            to Seconds</a>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="bg-danger rounded-2 d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-clock-rotate-left text-white"></i>
                        </div>
                        <a href="{{ url('/minutes-to-hours') }}"
                            class="text-white text-decoration-none fw-bold">Minute to Seconds</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
