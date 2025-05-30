<!-- Convert -->

<section class="convertSection py-5">
    <div class="container">
        <div class="text-center">
            @if (Request::is('convert-country'))
                <h2 class="searchBetweenA">Convert Time Between Countries </h2>
                <h2 class="fs-5">Easily convert and manage time between two Countries with our intuitive tool.</h2>
            @else
                <h3 class="searchBetweenA">Convert Time Between Countries </h3>
                <p>Easily convert and manage time between two Countries with our intuitive tool.</p>
            @endif
        </div>
        <div class="col-lg-9 m-auto mt-5">


            <form id="city" action="{{ url('get-convert-country') }}" method="GET">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50 "
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name="mode-select" placeholder="Search Country..." class="w-100 rounded-2 ps-3 bg-white"
                            required />
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50 "
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name="mode-select3" placeholder="Search Country..." class="w-100 rounded-2 ps-3 bg-white"
                            required />
                    </div>
                    <div class="col-lg-2 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Convert</button>
                    </div>
                </div>
                <div class="row converterUTC mt-3" style="display: none">
                    <div class="col-lg-5 mb-3 col-sm-6">
                        <div class="card bg-white px-3 py-1">
                            <div class="d-flex justify-content-between align-items-center h-100 gap-2">
                                <h4 id="country1" style="font-family: Lexend,serif;font-size: 24px" >
                                    Egypt</h4>
                                <h3 class="second mb-0"
                                    style="font-family: Lexend,serif;font-size: 32px; white-space: nowrap;">03:45 PM
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3 col-sm-6">
                        <div class="card bg-white px-3 py-1">
                            <div class="d-flex justify-content-between align-items-center h-100 gap-2">
                                <h4 id="country2" style="font-family: Lexend,serif;font-size: 24px" >
                                </h4>
                                <h3 class="second mb-0"
                                    style="font-family: Lexend,serif;font-size: 32px; white-space: nowrap;">03:45 PM
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                </div>
        </div>
        </form>
    </div>
    </div>
</section>



<!-- Convert end -->

<script>
    var tagify;
    $(document).ready(function() {
        var input = document.querySelector('input[name=mode-select]');
        tagify = new Tagify(input, {
            enforceWhitelist: false,
            mode: "select",
        });
        tagify.on('input', function(e) {
            $.ajax({
                url: '{{ route('fetch.country') }}',
                type: 'get',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    tagify.settings.whitelist = response;
                    tagify.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });

    var tagify3;
    $(document).ready(function() {
        var input = document.querySelector('input[name=mode-select3]');
        tagify3 = new Tagify(input, {
            enforceWhitelist: false,
            mode: "select",
        });
        tagify3.on('input', function(e) {
            $.ajax({
                url: '{{ route('fetch.country') }}',
                type: 'get',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    tagify3.settings.whitelist = response;
                    tagify3.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
</script>
