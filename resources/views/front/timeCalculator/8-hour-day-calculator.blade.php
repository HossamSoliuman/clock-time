@extends('front.time-converters.shared-sections')

@section('section')
    <style>
        i {
            font-size: 20px;
            color: #ff1515;
        }

        .red-text {
            color: #ff1515;
            font-size: 28px;
            font-weight: bold;
        }

        .card h5 {
            font-weight: bold;
        }

        .form-control[readonly] {
            background-color: #f9f9f9;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-4 mb-3">
                    <h5><i class="fa fa-calculator me-2 mb-3"></i>8 hours work day calculator</h5>
                    <div class="my-3 d-flex justify-content-between">
                        <div>Start Time</div>
                        <div class="red-text">08:00AM</div>
                    </div>
                    <div class="my-3 d-flex justify-content-between">
                        <div>End Time</div>
                        <div class="red-text" style="color: gray;">05:30PM</div>
                    </div>
                    <div class="my-3 d-flex justify-content-between">
                        <div>Break Time</div>
                        <div class="red-text">00:30</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-4 mb-3">
                    <h5><i class="fa fa-calculator me-2 mb-3"></i>Convert working hours to work days</h5>
                    <div class="row mb-3">
                        <div class="col my-2 d-flex justify-content-between align-items-center">
                            <div>Total working hours</div>
                            <input type="text" name="totalHours" class="form-control w-50 text-center red-text"
                                value="0">
                        </div>
                        <div class="col my-2 d-flex justify-content-between align-items-center">
                            <div>Cost per hour</div>
                            <input type="text" name="costPerHour" class="form-control w-50 text-center red-text"
                                value="0">
                        </div>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div>working Days</div>
                        <input type="text" name="workingDays" class="form-control" readonly>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div>Cost per Day</div>
                        <input type="text" name="costPerDay" class="form-control" readonly>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div>Total Cost</div>
                        <input type="text" name="totalCost" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function calculateWorkDays() {
            const totalHoursInput = document.querySelector('input[name="totalHours"]');
            const costPerHourInput = document.querySelector('input[name="costPerHour"]');

            const totalHours = parseFloat(totalHoursInput.value) || 0;
            const costPerHour = parseFloat(costPerHourInput.value) || 0;
            const hoursPerDay = 8;

            const workDays = totalHours / hoursPerDay;
            const costPerDay = hoursPerDay * costPerHour;
            const totalCost = totalHours * costPerHour;

            document.querySelector('input[name="workingDays"]').value = isNaN(workDays) ? 0 : workDays.toFixed(2);
            document.querySelector('input[name="costPerDay"]').value = isNaN(costPerDay) ? 0 : costPerDay.toFixed(2);
            document.querySelector('input[name="totalCost"]').value = isNaN(totalCost) ? 0 : totalCost.toFixed(2);
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', calculateWorkDays);
        });

        document.querySelector('input[name="totalHours"]').value = 0;
        document.querySelector('input[name="costPerHour"]').value = 0;
        calculateWorkDays();
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-p1CmGn7rqKfw+5NxZgBzcljvGPh64wvK5phtih2coZSSxJ6+JhMT/nxe3Ocg4bk6qK7wYIKsPCD5L+XTdC8R9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
