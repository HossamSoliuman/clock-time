<!-- Convert -->

<section class="convertSection py-5">
    <div class="container">
        <div class="text-center">
            @if (Request::is('meeting-planner'))
                <h4 class="searchBetweenA">Convert Time Zones</h4>
            @else
                <h4 class="searchBetweenA">Convert <b>{{ $timezoneName }}</b> to any Time Zones</h4>
            @endif
            @if (Request::is('convert-timezone'))
                <h5 class="fs-5">Easily convert and manage across different Zones with our intuitive tool.</h5>
            @else
                <p>Easily convert and manage across different Zones with our intuitive tool.</p>
            @endif
        </div>
        <div class="col-lg-9 m-auto mt-5">
            <form id="abbTotz" action="{{ url('get-convert-tz-tz') }}" method="GET">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50"
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <div class="d-none">
                            <input name="mode-select" style="background-color: #192140" value="{{ $timezoneName }}"
                                placeholder="Search Time Zones..." class="w-100 rounded-2 ps-3 bg-white" required
                                disabled />
                        </div>

                        <input style="background-color: #192140"
                            class="w-100 rounded-2 ps-3 text-center fw-bold fs-3 city-input" value="{{ $timezoneName }}"
                            disabled>
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50"
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name="mode-select2" placeholder="Search Time Zones..."
                            class="w-100 rounded-2 ps-3 bg-white" required />
                    </div>
                    <div class="col-lg-2 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Convert</button>
                    </div>
                </div>
                <div class="row converterUTC mt-3" style="display: none">
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between h-100">
                                <h4 class="first mb-0 col-6" id="abb"
                                    style="font-family: Lexend,serif;font-size: 22px;"></h4>
                                <h4 class="second mb-0" id="abb_time"
                                    style="font-family: Lexend,serif;font-size: 24px;"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between h-100">
                                <h4 class="first mb-0 col-6" id="tz"
                                    style="font-family: Lexend,serif;font-size: 22px;"></h4>
                                <h4 class="second mb-0" id="tz_name"
                                    style="font-family: Lexend,serif;font-size: 24px;"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Convert end -->


<!-- Convert end -->

<script>
    var tagify;
    $(document).ready(function() {
        var input = document.querySelector('input[name=mode-select]');
        tagify = new Tagify(input, {
            enforceWhitelist: false,
            mode: "text"
        });
    });


    var tagify2;
    $(document).ready(function() {
        var input = document.querySelector('input[name=mode-select2]');
        tagify2 = new Tagify(input, {
            enforceWhitelist: false,
            mode: "select",
        });
        tagify2.on('input', function(e) {
            $.ajax({
                url: '{{ route('fetch.abb') }}',
                type: 'get',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    tagify2.settings.whitelist = response;
                    tagify2.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
</script>
