<!-- Convert -->


<section class="convertSection py-5">
    <div class="container">
        <div class="text-center">
            <h2>Convert Time Zones</h2>
            <p>Easily convert and manage time across different zones with our intuitive tool.</p>
        </div>
        <div class="w-75 m-auto mt-5">
            <form id="timeZoneForm2" action="{{ url('convert-time') }}" method="GET"
                onsubmit="return changeAction2(event);">
                <div class="row">
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute"
                            style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone select3 w-100" name="zone1">
                            <option value="" disabled selected>Select GMT/Time Zone </option>
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3 position-relative">
                        <i class="fa-solid fa-location-dot position-absolute"
                            style="z-index: 10;left:20px;top:12px"></i>
                        <select class="select-zone select3 w-100" name="zone2">
                            <option value="" disabled selected>Select Utc/Time Zone </option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-convert rounded-2 w-100" type="submit">Convert</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Convert end -->

<script>
    $(document).ready(function() {
        $('.select3').select2({
            placeholder: "Select GMT/UTC Or Time Zone",
            allowClear: true,
            ajax: {
                url: "{{ route('fetch.timezones') }}",
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
        }).on('select3:open', function() {
            // Trigger the select2 AJAX request manually when opened without input
            const $this = $(this);
            const searchTerm = $this.data('select3').dropdown.$search.val();

            if (!searchTerm) {
                $this.select2('data', {
                    id: '',
                    text: 'Loading...'
                });
                $.ajax({
                    url: "{{ route('fetch.timezones') }}",
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




<script>
    function changeAction2(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the selected values from the dropdowns
        const gmtSelect = document.querySelector('select[name="zone1"]');
        const timezoneSelect = document.querySelector('select[name="zone2"]');

        const gmtValue = gmtSelect.value;
        const timezoneValue = timezoneSelect.value;

        // Check if both values are selected
        if (gmtValue && timezoneValue) {
            // Create the new URL format
            const newUrl = `/convert-time/${gmtValue}/to/${timezoneValue}`;

            // Redirect to the new URL
            window.location.href = newUrl;
        } else {
            alert('Please select both GMT and Timezone.'); // Alert if not selected
        }

        return false; // Prevent further actions
    }
</script>
