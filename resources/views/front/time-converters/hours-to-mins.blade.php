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
                    <h5><i class="fa fa-calculator me-2 mb-3"></i> Convert hours to min</h5>
                    <div class="mb-3 d-flex gap-4 justify-content-center">
                        <label><i class="fa fa-clock me-2 d-inline" style="font-size: 16px"></i>Hours</label>
                        <input type="number" class="form-control" id="hours" value="0">
                    </div>
                    <div class="mb-3 d-flex gap-3 justify-content-center">
                        <label><i class="fa fa-stopwatch me-2 d-inline" style="font-size: 16px"></i>Minutes</label>
                        <input type="number" class="form-control" id="decimalMinutes" value="0" step="0.01" readonly>
                    </div>
                    <button class="btn btn-convert w-100 mb-2" onclick="convertHoursToMin()">
                        <i class="fa fa-calculator text-white me-2"></i>Convert Time
                    </button>
                    <button class="btn btn-outline-secondary w-100 mb-2" onclick="clearInputs()">
                        <i class="fa fa-eraser me-2 text-dark"></i>Clear Inputs
                    </button>
                    <div class="text-center">
                        <span style="cursor:pointer" onclick="resetAll()">
                            <i class="fa fa-trash-restore-alt text-dark me-2"></i>Reset All
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-stopwatch me-2"></i>Total Minutes</div>
                            <div class="fs-4 fw-bold" id="totalMinutes">0</div>
                            <div>minutes</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-stopwatch-20 me-2"></i>Total seconds</div>
                            <div class="fs-4 fw-bold" id="totalSeconds">0</div>
                            <div>seconds</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 text-center">
                            <div><i class="fa fa-clock me-2"></i>Days</div>
                            <div class="fs-4 fw-bold" id="days">0.00</div>
                            <div>Days</div>
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
        function convertHoursToMin() {
            let h = parseFloat(document.getElementById('hours').value) || 0;

            let totalMinutes = h * 60;
            let totalSeconds = totalMinutes * 60;
            let days = h / 24;

            document.getElementById('decimalMinutes').value = totalMinutes.toFixed(2);
            document.getElementById('totalMinutes').innerText = totalMinutes.toFixed(0);
            document.getElementById('totalSeconds').innerText = totalSeconds.toFixed(0);
            document.getElementById('days').innerText = days.toFixed(2);

            let input = `${h}h`;
            let output = `${totalMinutes.toFixed(0)} min, ${totalSeconds.toFixed(0)} sec, ${days.toFixed(2)} days`;
            let row = `<tr><td>${input}</td><td>${output}</td></tr>`;

            let table = document.getElementById('recentConversions');
            table.insertAdjacentHTML('afterbegin', row);
            if (table.rows.length > 3) table.deleteRow(3);
        }

        function clearInputs() {
            document.getElementById('hours').value = 0;
            document.getElementById('decimalMinutes').value = 0;
        }

        function resetAll() {
            clearInputs();
            document.getElementById('totalMinutes').innerText = '0';
            document.getElementById('totalSeconds').innerText = '0';
            document.getElementById('days').innerText = '0.00';
            document.getElementById('recentConversions').innerHTML = '';
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-p1CmGn7rqKfw+5NxZgBzcljvGPh64wvK5phtih2coZSSxJ6+JhMT/nxe3Ocg4bk6qK7wYIKsPCD5L+XTdC8R9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
