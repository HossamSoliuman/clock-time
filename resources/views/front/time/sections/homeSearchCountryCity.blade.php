<div class="container py-5">
    <div class="d-flex justify-content-between flex-wrap gap-4">
        <section class="searchSection flex-fill" style="min-width: 300px; max-width: 40%;">
            <div class="text-center">
                <h2>Search City Time</h2>
            </div>
            <form id="timeZoneForm4" action="{{ url('/') }}" method="GET" onsubmit="return changeAction4(event);">
                <div class="row mt-3">
                    <div class="col-9 mb-3 position-relative">
                        <i class="fa-solid fa-magnifying-glass position-absolute top-50"
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name='citySearch' placeholder="Search for your city..." class="w-100 rounded-2 ps-3"
                            required />
                    </div>
                    <div class="col-3 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Find</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="searchSection flex-fill" style="min-width: 300px; max-width: 40%;">
            <div class="text-center">
                <h2>Search Country Time</h2>
            </div>
            <form id="timeZoneForm5" action="{{ url('/') }}" method="GET"
                onsubmit="return countrySearch(event);">
                <div class="row mt-3">
                    <div class="col-9 mb-3 position-relative">
                        <i class="fa-solid fa-magnifying-glass position-absolute top-50"
                            style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name='mode-select5' placeholder="Country..." class="w-100 rounded-2 ps-3" required />
                    </div>
                    <div class="col-3 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Find</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<script>
    var citySearch;
    $(document).ready(function() {
        var input2 = document.querySelector('input[name=citySearch]');
        citySearch = new Tagify(input2, {
            enforceWhitelist: false,
            mode: "select",
        });
        citySearch.on('input', function(e) {
            $.ajax({
                url: '{{ route('fetch.city') }}',
                type: 'post',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    citySearch.settings.whitelist = response;
                    citySearch.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });

    function changeAction4(event) {
        event.preventDefault();
        let slug = citySearch.value[0].slug
        if (slug) {
            const newUrl = `{{ url('/') }}/${slug}`;
            window.open(newUrl, '_target')
            citySearch.removeAllTags();
        } else {
            alert('Please select City.');
        }
        return false;
    }
</script>


<script>
    var countrySerach;
    $(document).ready(function() {
        var input2 = document.querySelector('input[name=mode-select5]');
        countrySerach = new Tagify(input2, {
            enforceWhitelist: false,
            mode: "select",
        });
        countrySerach.on('input', function(e) {
            $.ajax({
                url: '{{ url('fetch-country') }}',
                type: 'get',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    countrySerach.settings.whitelist = response;
                    countrySerach.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
    function countrySearch(event) {
        event.preventDefault();
        let slug = countrySerach.value[0].slug
        if (slug) {
            const newUrl = `{{ url('/') }}/${slug}`;
            window.open(newUrl, '_target')
            countrySerach.removeAllTags();
        } else {
            alert('Please select City.');
        }
        return false;
    }
</script>