<!-- Convert -->


<section class="convertSection py-5">
    <div class="container">
        <div class="text-center">
            <h2>Time converter </h2>
            <h2 class="fs-5">Easily convert and manage across different Zones , Countries , Cities with our intuitive
                tool.</h2>
        </div>
        <div class="w-75 m-auto mt-5">
            <form id="AllToAll" action="{{ url('get-convert-all-all') }}" method="GET">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50 "
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name="mode-select" placeholder="Search different Zones , Countries , Cities..."
                            class="w-100 rounded-2 ps-3 bg-white" required />
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute top-50 "
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name="mode-select3" placeholder="Search different Zones , Countries , Cities..."
                            class="w-100 rounded-2 ps-3 bg-white" required />
                    </div>
                    <div class="col-lg-2 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Convert</button>
                    </div>
                </div>
                <div class="row converterUTC mt-3 " style="display: none">
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between  h-100">
                                <h3 class="first mb-0 col-6" id="super_1"
                                    style="font-family: Lexend,serif;font-size: 22px">UTC+2</h3>
                                <h3 class="second mb-0" id="super_time_1"
                                    style="font-family: Lexend,serif;font-size: 28px">UTC+2</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between  h-100">
                                <h3 class="first mb-0 col-6" id="super_2"
                                    style="font-family: Lexend,serif;font-size: 22px" >UTC+2</h3>
                                <h3 class="second mb-0" id="super_time_2"
                                    style="font-family: Lexend,serif;font-size: 28px">UTC+2</h3>
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
                url: '{{ route('fetch.super.all') }}',
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
                url: '{{ route('fetch.super.all') }}',
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
