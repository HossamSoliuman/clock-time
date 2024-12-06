<!-- Convert -->


<div class="container-fluid" style='background-color: #212542'>
    <div class="row text-center py-5">
        <h1 class="text-white fw-bold">Convert GMT/UTC</h1>
        <p style='color: #DEE1E6'>Easily convert and manage time across different zones with our intuitive tool.</p>
        <form id="timeZoneForm" action="{{ url('convert-gmt') }}" method="GET" onsubmit="return changeAction();">
            <select class="select-zone select2 rounded-2 p-2 pe-5 me-2" name="gmt" style="width: 20%;">
                <option value="" disabled selected>Select GMT </option>

            </select>
            <select class="select-zone select2 rounded-2 p-2 pe-5 me-2 mt-md-0 mt-2" name="utc" style="width: 20%;">
                <option value="" disabled selected>Select GMT </option>


            </select>
            <br class="d-md-none d-block">
            <button class="btn-convert btn-hover rounded-2 py-1 px-3 mt-md-0 mt-2" type="submit">Convert</button>
        </form>
    </div>
</div>



<!-- Convert end -->

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select GMT ",
            allowClear: true,
            ajax: {
                url: "{{ route('fetch.gmt') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term || '', // Send empty search initially to get default data
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0, // Load default options initially without typing
            templateResult: formatResult
        }).on('select2:open', function() {
            // Trigger the select2 AJAX request manually when opened without input
            const $this = $(this);
            const searchTerm = $this.data('select2').dropdown.$search.val();

            if (!searchTerm) {
                $this.select2('data', { id: '', text: 'Loading...' });
                $.ajax({
                    url: "{{ route('fetch.gmt') }}",
                    data: { search: '' }, // Fetch the default options when opened
                    dataType: 'json',
                    success: function(data) {
                        const results = data.map(item => ({ id: item.id, text: item.text }));
                        const options = results.map(item => new Option(item.text, item.id, false, false));
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
    function changeAction() {
        // event.preventDefault(); // Prevent the default form submission

        // Get the selected values from the dropdowns
        const gmtSelect = document.querySelector('select[name="gmt"]');
        const timezoneSelect = document.querySelector('select[name="utc"]');

        const gmtValue = gmtSelect.value;
        const timezoneValue = timezoneSelect.value;

        // Check if both values are selected
        if (gmtValue && timezoneValue) {
            // Create the new URL format
            const newUrl = `/convert-gmt/${gmtValue}/to/${timezoneValue}`;

            // Redirect to the new URL
            window.location.href = newUrl;
        } else {
            alert('Please select both GMT and Timezone.'); // Alert if not selected
        }

        return false; // Prevent further actions
    }
</script>
