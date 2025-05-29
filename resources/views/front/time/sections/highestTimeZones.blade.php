@if ($type && $type == 'abbreviation')

    <section class=" py-5">
        <div class="container text-center">
            <h2 class="h1" style="font-family: Lexend,serif;">{{ $timezoneName }} related time zones</h2>
            <div class="row  mt-3">
                @foreach ($highestTimeZones as $highestTimeZone)
                    <div class="col-lg-4 mb-3">
                        <a href="  {{ url($highestTimeZone['slug']) }}">
                            <div class="card bg-white p-3">
                                <div class="d-flex justify-content-between h-100 align-items-center">
                                    <h3 class="first mb-0 col-6 text-start" id="abb"
                                        style="font-family: Lexend,serif;font-size: 22px;">
                                        {{ $highestTimeZone['name'] }}
                                    </h3>
                                    <h3 class="second mb-0" id="abb_time"
                                        style="font-family: Lexend,serif;font-size: 28px;color:red;">
                                        {{ $highestTimeZone['time'] }} {{ $highestTimeZone['identify'] }}
                                    </h3>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
