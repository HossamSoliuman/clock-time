<!-- Convert -->


<section class="convertSection py-5 mt-2">
    <div class="container">
        <div class="text-center">
            <h2>Convert {{ $gmt->$searchField }} to My time city or time zone</h2>
            <p>Easily convert and manage time between two Time Zones with our intuitive tool.</p>
        </div>
        <div class="w-75 m-auto mt-5">
            <form id="utcToCity" action="{{ url('get-convert-utc-city') }}" method="GET">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute"
                            style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone utc w-100" name="utc">
                            <option value="" disabled selected>Select UTC </option>
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute"
                            style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone city w-100" name="city">
                            <option value="" disabled selected>Select city </option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-convert rounded-2 w-100" type="submit">Convert</button>
                    </div>
                </div>
                <div class="row converterUTC mt-3 " style="display: none">
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between  h-100">
                                <h3 class="first mb-0" id="utc">UTC+2</h3>
                                <h3 class="second mb-0" id="time1">UTC+2</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card bg-white p-3">
                            <div class="d-flex justify-content-between  h-100">
                                <h3 class="first mb-0" id="city">UTC+2</h3>
                                <h3 class="second mb-0" id="time2">UTC+2</h3>
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
    $(document).ready(function() {
        $('.utc').select2({
            placeholder: "Select UTC/GMT",
            allowClear: true,
            ajax: {
                url: "{{ route('fetch.gmt') }}",
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
        }).on('utc:open', function() {
            // Trigger the select2 AJAX request manually when opened without input
            const $this = $(this);
            const searchTerm = $this.data('utc').dropdown.$search.val();

            if (!searchTerm) {
                $this.select2('data', {
                    id: '',
                    text: 'Loading...'
                });
                $.ajax({
                    url: "{{ route('fetch.gmt') }}",
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


        $('.city').select2({
            placeholder: "Select City",
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




