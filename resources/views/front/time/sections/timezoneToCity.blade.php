<style>
    .convertSection {
        background-color: #192140;
    }

    .text-white {
        color: white;
    }

    .city-input {
        color: white;
        border: 2px solid red;
    }

    .time-input {
        background-color: #DC1C24;
        color: white;
        border: 2px solid red;
        text-align: center;
    }

    .input-icon {
        background-color: #192140;
        color: white;
        border: 2px solid red;
    }
</style>

<section class="convertSection py-5">
    <div class="col-lg-8 m-auto mt-5">
        <div class="container">
            <div class="text-center mb-5 text-white">
                <h2 class="fw-bold">EDT Time to Your City Time</h2>
                <p class="fs-4">Easily convert and manage time across different zones with our intuitive tool.</p>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6 text-center">
                    <div class="input-group">
                        <span class="input-group-text input-icon"><i class="fas fa-user"></i></span>
                        <input style="background-color: #192140" id="city" class="form-control text-center fw-bold fs-3 city-input"
                            value="{{ $diffBetweenZoneAndCity['cityName'] }}" disabled>
                    </div>
                </div>
                <div class="col-3">
                    <form action="{{ route('convert.city-timezone') }}" method="post"
                        class="d-flex justify-content-center align-items-center gap-3">
                        @csrf
                        <input type="hidden" name="country">
                        <input type="hidden" name="timezoneSlug" value="{{ $slug }}">
                        <input type="number" name="hour" class="form-control text-center fw-bold fs-3 time-input"
                            value="{{ Carbon\Carbon::parse($diffBetweenZoneAndCity['cityTime'])->format('g') }}"
                            min="1" max="12">
                        @php
                            $meridian = Carbon\Carbon::parse($diffBetweenZoneAndCity['cityTime'])->format('A');
                        @endphp
                        <select name="meridian" class="form-select fw-bold fs-3 time-input">
                            <option value="AM" {{ $meridian == 'AM' ? 'selected' : '' }}>AM</option>
                            <option value="PM" {{ $meridian == 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <div class="input-group">
                        <span class="input-group-text input-icon"><i class="fas fa-user"></i></span>
                        <input style="background-color: #192140" id="city" class="form-control text-center fw-bold fs-3 city-input"
                            value="{{ $timezoneName }}" disabled>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <input style="background-color: #323a52" id="timezoneTime" class="form-control text-center fw-bold fs-3 city-input"
                        value="{{ Carbon\Carbon::parse($date['currentTimeWithSeconds'])->format('g A') }}" disabled>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[name="hour"], select[name="meridian"]').on('change', function() {
            let hour = $('input[name="hour"]').val();
            let meridian = $('select[name="meridian"]').val();
            let timezoneSlug = $('input[name="timezoneSlug"]').val();

            if (hour && meridian) {
                $.ajax({
                    url: "{{ route('convert.city-timezone') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        hour: hour,
                        meridian: meridian,
                        timezoneSlug: timezoneSlug,
                    },
                    success: function(response) {
                        $('#timezoneTime').val(response);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            }
        });
    });
</script>

<script>
    fetch('https://ipapi.co/json/')
        .then(response => response.json())
        .then(data => {
            document.querySelector('input[name="country"]').value = data.country_name;
            document.querySelector('#city').textContent = data.country_capital;
        })
        .catch(error => console.error('Error fetching country:', error));
</script>
