@extends('front.time-converters.shared-sections')
@section('section')
    <style>
        i {
            font-size: 20px;
            color: #ff1515;
        }
    </style>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 mb-3">
                    <h5><i class="fa fa-calculator me-2"></i> Convert hours to decimal</h5>

                    <div class="my-3 d-flex gap-3 justify-content-center">
                        <label><i class="fa fa-hourglass me-4 d-inline" style="font-size: 16px"></i>Hours</label>
                        <input type="number" class="form-control" id="hours" value="0">
                    </div>

                    <div class="mb-3 d-flex gap-3 justify-content-center">
                        <label><i class="fa fa-clock me-2 d-inline" style="font-size: 16px"></i>Minutes</label>
                        <input type="number" class="form-control" id="minutes" value="0">
                    </div>
                    <div class="mb-3 d-flex gap-3 justify-content-center">
                        <label><i class="fa fa-stopwatch me-2 d-inline" style="font-size: 16px"></i>Seconds</label>
                        <input type="number" class="form-control" id="seconds" value="0">
                    </div>
                    <button class="btn btn-convert w-100 mb-2" onclick="convertTime()">
                        <i class="fa fa-calculator text-white me-2"></i>Convert Time
                    </button>
                    <button class="btn btn-outline-secondary w-100 mb-2" onclick="clearInputs()">
                        <i class="fa fa-eraser me-2 text-dark"></i>Clear Inputs
                    </button>
                    <div class="text-center">
                        <span class="" style="cursor:pointer" onclick="resetAll()">
                            <i class="fa fa-trash-restore-alt text-dark me-2"></i>Reset All
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-hourglass-half me-2"></i>Decimal Hours</div>
                            <div class="fs-4 fw-bold" id="decimalHours">0.00</div>
                            <div>Hours</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-clock me-2"></i>Decimal Minutes</div>
                            <div class="fs-4 fw-bold" id="decimalMinutes">0.00</div>
                            <div>Minutes</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-stopwatch me-2"></i>Decimal Seconds</div>
                            <div class="fs-4 fw-bold" id="decimalSeconds">0.00</div>
                            <div>Seconds</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-bolt me-2"></i>Total Milliseconds</div>
                            <div class="fs-4 fw-bold" id="totalMilliseconds">0</div>
                            <div>ms</div>
                        </div>
                    </div>
                </div>
                <div class="card p-3">
                    <h5><i class="fa fa-history me-2"></i>Recent Conversions</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Input</th>
                                <th>Output</th>
                            </tr>
                        </thead>
                        <tbody id="recentConversions"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function convertTime() {
            let h = parseFloat(document.getElementById('hours').value) || 0;
            let m = parseFloat(document.getElementById('minutes').value) || 0;
            let s = parseFloat(document.getElementById('seconds').value) || 0;

            let totalSeconds = h * 3600 + m * 60 + s;
            let decHours = totalSeconds / 3600;
            let decMinutes = totalSeconds / 60;
            let decSeconds = totalSeconds;
            let ms = totalSeconds * 1000;

            document.getElementById('decimalHours').innerText = decHours.toFixed(3);
            document.getElementById('decimalMinutes').innerText = decMinutes.toFixed(3);
            document.getElementById('decimalSeconds').innerText = decSeconds.toFixed(2);
            document.getElementById('totalMilliseconds').innerText = ms.toLocaleString();

            let input = `${h}h ${m}m ${s}s`;
            let output = `${decHours.toFixed(3)}h, ${decMinutes.toFixed(1)}m, ${decSeconds}s, ${ms.toLocaleString()}ms`;
            let row = `<tr><td>${input}</td><td>${output}</td></tr>`;

            let table = document.getElementById('recentConversions');
            table.insertAdjacentHTML('afterbegin', row);
            if (table.rows.length > 3) table.deleteRow(3);
        }

        function clearInputs() {
            document.getElementById('hours').value = 0;
            document.getElementById('minutes').value = 0;
            document.getElementById('seconds').value = 0;
        }

        function resetAll() {
            clearInputs();
            document.getElementById('decimalHours').innerText = '0.00';
            document.getElementById('decimalMinutes').innerText = '0.00';
            document.getElementById('decimalSeconds').innerText = '0.00';
            document.getElementById('totalMilliseconds').innerText = '0';
            document.getElementById('recentConversions').innerHTML = '';
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-p1CmGn7rqKfw+5NxZgBzcljvGPh64wvK5phtih2coZSSxJ6+JhMT/nxe3Ocg4bk6qK7wYIKsPCD5L+XTdC8R9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
