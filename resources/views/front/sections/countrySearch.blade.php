<section class="searchSection py-5">
    <div class="container">
        <div class="text-center">
            <h2 class="h-search">Search Country Time</h2>
        </div>
        <div class="col-lg-6 m-auto">
            <form id="timeZoneForm4" action="{{ url('/') }}" method="GET" onsubmit="return countrySearch(event);">
                <div class="row mt-3">
                    <div class="col-lg-9 mb-3 position-relative">
                        <i class="fa-solid fa-magnifying-glass position-absolute top-50 " style="color:rgba(0, 0, 0, 0.4);transform: translateY(-50%);z-index: 10;left:20px;"></i>
                        <input name='mode-select5' placeholder="Country..." class="w-100 rounded-2 ps-3" required />
                    </div>
                    <div class="col-lg-3 mb-3">
                        <button class="btn btn-convert rounded-2 w-100 h-100" type="submit">Get Time</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

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
