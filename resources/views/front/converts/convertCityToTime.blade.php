<!-- Convert -->

<section class="convertSection py-5 mt-2">
    <div class="container">
        <div class="text-center">
            <h2>Convert Time Zones</h2>
            <p>Easily convert and manage time across different zones with our intuitive tool.</p>
        </div>
        <div class="w-75 m-auto mt-5">


            <form id="cityToTime" action="{{ url('get-convert-city-tz') }}" method="GET">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute" style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone city w-100" name="city_1">
                            <option value="" disabled selected>Select city</option>
                            <!-- Add your country options here -->
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute" style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone time w-100" name="time">
                            <option value="" disabled selected>Select city</option>
                            <!-- Add your country options here -->
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-convert rounded-2 w-100" type="submit">Convert</button>
                    </div>
                </div>

                <div class="row converterUTC mt-3" style="display: none">
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white px-3 py-1">
                            <div class="d-flex justify-content-between align-items-center  h-100">
                                <div class="row imageCountryConvert">
                                    <div class="col-12 mb-1">
                                        <h4 id="city_1"></h4>
                                    </div>

                                </div>
                                <h3 class="second mb-0" id="time_1"></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white px-3 py-1">
                            <div class="d-flex justify-content-between align-items-center  h-100">
                                <div class="row imageCountryConvert">
                                    <div class="col-12 mb-1">
                                        <h4 id="timez_2"></h4>
                                    </div>

                                </div>
                                <h3 class="second mb-0" id="time_2"></h3>
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
    $(document).ready(function() {
        $('.city').select2({
            placeholder: "Search City",
            allowClear: true,
            ajax: {
                url: "{{ route('fetch.city') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term ||
                            '', // Send empty search initially to get default data
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0, // Load default options initially without typing
            templateResult: formatResult
        }).on('city:open', function() {
            // Trigger the select2 AJAX request manually when opened without input
            const $this = $(this);
            const searchTerm = $this.data('city').dropdown.$search.val();

            if (!searchTerm) {
                $this.select2('data', {
                    id: '',
                    text: 'Loading...'
                });
                $.ajax({
                    url: "{{ route('fetch.city') }}",
                    data: {
                        search: ''
                    }, // Fetch the default options when opened
                    dataType: 'json',
                    success: function(data) {
                        const results = data.map(item => ({
                            id: item.id,
                            text: item.text
                        }));
                        const options = results.map(item => new Option(item.text, item.id,
                            false, false));
                        $this.append(options).trigger('change');
                    }
                });
            }
        });


        $('.time').select2({
            placeholder: "Search Time Zones",
            allowClear: true,
            ajax: {
                url: "{{ route('fetch.tz') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term ||
                            '', // Send empty search initially to get default data
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0, // Load default options initially without typing
            templateResult: formatResult
        }).on('time:open', function() {
            // Trigger the select2 AJAX request manually when opened without input
            const $this = $(this);
            const searchTerm = $this.data('time').dropdown.$search.val();

            if (!searchTerm) {
                $this.select2('data', {
                    id: '',
                    text: 'Loading...'
                });
                $.ajax({
                    url: "{{ route('fetch.tz') }}",
                    data: {
                        search: ''
                    }, // Fetch the default options when opened
                    dataType: 'json',
                    success: function(data) {
                        const results = data.map(item => ({
                            id: item.id,
                            text: item.text
                        }));
                        const options = results.map(item => new Option(item.text, item.id,
                            false, false));
                        $this.append(options).trigger('change');
                    }
                });
            }
        });
    });


    function formatResult(data) {
        return data.text;
    }
</script>


<script>
    function filterOptions(selectId, inputId) {
        const input = document.getElementById(inputId).value.toLowerCase();
        const select = document.getElementById(selectId);
        const options = select.options;

        // Loop through the options and hide/show based on input
        for (let i = 0; i < options.length; i++) {
            const optionText = options[i].text.toLowerCase();
            if (optionText.includes(input)) {
                options[i].style.display = 'block';
            } else {
                options[i].style.display = 'none';
            }
        }
    }
</script>




