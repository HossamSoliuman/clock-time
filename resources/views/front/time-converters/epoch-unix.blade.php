<?php
?>

@extends('front.time-converters.shared-sections')
@section('section')
    <style>
        .unix-box input {
            max-width: 80px;
            text-align: center;
        }

        i {
            font-size: 20px;
            color: #ff1515;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-4">
                    <h5><i class="fa fa-calculator me-2"></i> Convert Unix Epoch to date time</h5>
                    <div class="my-4 d-flex align-items-center gap-3">
                        <i class="fa fa-clock"></i>
                        <input type="number" id="unixInput" class="form-control" placeholder="unix">
                    </div>
                    <div class="mb-3 d-flex align-items-center gap-3">
                        <i class="fa fa-clock"></i>
                        <input type="text" id="dateOutput" class="form-control" readonly placeholder="Date">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-4">
                    <h5><i class="fa fa-calculator me-2"></i> Convert Date time to Unix Epoch</h5>
                    <div class="mb-3">
                        <div class="row g-2">
                            <div class="col-2 d-flex align-items-center">
                                <i class="fa fa-clock me-2"></i>Date
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-2">
                                <label class="form-label">Year</label>
                                <input type="number" id="year" class="form-control" placeholder="Year" value="2025">
                            </div>
                            <div class="col">
                                <label class="form-label">Month</label>
                                <input type="number" id="month" class="form-control" placeholder="Month"
                                    value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Day</label>
                                <input type="number" id="day" class="form-control" placeholder="Day" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Hr</label>
                                <input type="number" id="hour" class="form-control" placeholder="Hr" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Min</label>
                                <input type="number" id="minute" class="form-control" placeholder="Min" value="00">
                            </div>
                            <div class="col">
                                <label class="form-label">Sec</label>
                                <input type="number" id="second" class="form-control" placeholder="Sec" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row g-2">
                            <div class="col-2 d-flex align-items-center">
                                <i class="fa fa-clock me-2"></i>UNIX
                            </div>
                            <div class="col-1"></div>
                            <div class="col-9">
                                <input type="text" id="unixOutput" class="form-control w-100" readonly
                                    placeholder="UNIX">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('unixInput').addEventListener('input', function() {
            let val = parseInt(this.value) || 0;
            let date = new Date(val * 1000);
            document.getElementById('dateOutput').value = date.toUTCString();
        });

        const inputs = ['year', 'month', 'day', 'hour', 'minute', 'second'];
        inputs.forEach(id => {
            document.getElementById(id).addEventListener('input', function() {
                let y = parseInt(document.getElementById('year').value) || 0;
                let m = (parseInt(document.getElementById('month').value) || 1) - 1;
                let d = parseInt(document.getElementById('day').value) || 1;
                let h = parseInt(document.getElementById('hour').value) || 0;
                let min = parseInt(document.getElementById('minute').value) || 0;
                let s = parseInt(document.getElementById('second').value) || 0;

                let date = new Date(Date.UTC(y, m, d, h, min, s));
                let unix = Math.floor(date.getTime() / 1000);
                document.getElementById('unixOutput').value = unix;
            });
        });
    </script>


    <script>
        setInterval(() => {
            const now = Math.floor(Date.now() / 1000)
            document.getElementById('currentUnix').textContent = now
            document.getElementById('currentDate').textContent = new Date(now * 1000).toUTCString()
        }, 1000)
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-p1CmGn7rqKfw+5NxZgBzcljvGPh64wvK5phtih2coZSSxJ6+JhMT/nxe3Ocg4bk6qK7wYIKsPCD5L+XTdC8R9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
