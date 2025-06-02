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
            <div class="col-md-6">
                <div class="card p-4 mb-3">
                    <h5><i class="fa fa-calculator me-2 mb-3"></i>Calculate time between two times</h5>
                    <div class="my-3">
                        <label class="fw-bold">Start Date</label>
                        <input type="datetime-local" class="form-control" id="startDate">
                    </div>
                    <div class="my-3">
                        <label class="fw-bold">End Date</label>
                        <input type="datetime-local" class="form-control" id="endDate">
                    </div>
                    <button class="btn btn-convert w-100 my-3" onclick="calculateDifference()">Calculate</button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-4 mb-3">
                    <h5><i class="fa fa-calculator me-2 mb-3"></i>Result</h5>
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div>Years</div>
                            <input type="text" class="form-control text-center" id="years" readonly>
                        </div>
                        <div class="col">
                            <div>Month</div>
                            <input type="text" class="form-control text-center" id="months" readonly>
                        </div>
                        <div class="col">
                            <div>Days</div>
                            <input type="text" class="form-control text-center" id="days" readonly>
                        </div>
                        <div class="col">
                            <div>Hrs</div>
                            <input type="text" class="form-control text-center" id="hours" readonly>
                        </div>
                        <div class="col">
                            <div>Mins</div>
                            <input type="text" class="form-control text-center" id="minutes" readonly>
                        </div>
                        <div class="col">
                            <div>Sec</div>
                            <input type="text" class="form-control text-center" id="seconds" readonly>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="mb-2 col">
                            <i class="fa fa-clock me-2"></i>in Days:
                            <input type="text" class="form-control text-center" id="inDays" readonly>
                        </div>
                        <div class="mb-2 col">
                            <i class="fa fa-clock me-2"></i>in hours:
                            <input type="text" class="form-control text-center" id="inHours" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <i class="fa fa-clock me-2"></i>in MINs:
                            <input type="text" class="form-control text-center" id="inMins" readonly>
                        </div>
                        <div class="col">
                            <i class="fa fa-clock me-2"></i>in Secs:
                            <input type="text" class="form-control text-center" id="inSecs" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateDifference() {
            let start = new Date(document.getElementById('startDate').value);
            let end = new Date(document.getElementById('endDate').value);
            if (isNaN(start) || isNaN(end)) return;

            let diffMs = end - start;
            let diffSecs = Math.floor(diffMs / 1000);
            let diffMins = diffSecs / 60;
            let diffHours = diffMins / 60;
            let diffDays = diffHours / 24;

            let remaining = diffSecs;
            let years = Math.floor(remaining / (365 * 24 * 3600));
            remaining %= 365 * 24 * 3600;

            let months = Math.floor(remaining / (30 * 24 * 3600));
            remaining %= 30 * 24 * 3600;

            let days = Math.floor(remaining / (24 * 3600));
            remaining %= 24 * 3600;

            let hours = Math.floor(remaining / 3600);
            remaining %= 3600;

            let minutes = Math.floor(remaining / 60);
            let seconds = remaining % 60;

            document.getElementById('years').value = years;
            document.getElementById('months').value = months;
            document.getElementById('days').value = days;
            document.getElementById('hours').value = hours;
            document.getElementById('minutes').value = minutes;
            document.getElementById('seconds').value = seconds;

            document.getElementById('inDays').value = diffDays.toFixed(1);
            document.getElementById('inHours').value = diffHours.toFixed(1);
            document.getElementById('inMins').value = Math.floor(diffMins);
            document.getElementById('inSecs').value = diffSecs;
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-p1CmGn7rqKfw+5NxZgBzcljvGPh64wvK5phtih2coZSSxJ6+JhMT/nxe3Ocg4bk6qK7wYIKsPCD5L+XTdC8R9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
