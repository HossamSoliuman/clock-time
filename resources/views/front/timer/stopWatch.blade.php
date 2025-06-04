@extends('front.inc.layout')
@section('title', 'Stopwatch Timer Online')
@section('description',
    'Online stopwatch offers a user-friendly interface, customizable timers, and lap time tracking.
    Ideal for athletes, students, and anyone who needs precise timekeeping')
@section('keywords',
    'Stop Watch, stop stopwatch, stopwatch+, stopwhatc, stopwatch for study, timer and stopwatch,
    0nline stopwatch, clock and stopwatch, online stop watches, stopwatch watch online, digital stopwatch, stopwatch timer
    online')
@section('ogImage', asset('public/images/stop-watch.jpg'))
@section('ogImageAlt', 'Stop Watch')
@section('url', urldecode(url()->current()))
@section('msvalidate', '8633E71DA03375A6E013D26DF14FDD3C')

@php
    $imageUrl = 'public/images/stop-watch.jpg';
@endphp
@section('container')
    <div class="container-fluid text-white g-2 p-0 me-0" style="margin-bottom: 8px;position: relative"
        style="background-color: black">
        <style>
            body {
                overflow-x: hidden;
            }



            .btn-convert {
                cursor: pointer;
            }

            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.8);
            }

            .modal-content {
                background-color: #222;
                color: white;
                border: none;
            }

            .modal-header,
            .modal-footer {
                border: none;
            }

            .modal-header .btn-close {
                color: white;
            }

            .modal-body p {
                font-size: 18px;
            }

            .controls {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .controls button {
                color: white;
                font-size: 16px;
                cursor: pointer;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .img-city .overlay {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                text-align: center;
            }

            .timer {
                font-size: 4rem !important;
                text-align: center !important;
            }

            @media (max-width: 768px) {
                #timeDisplay {
                    font-size: 60px;
                }
            }
        </style>

        <div class="img-city img-city-gmt" style="background-color: black">
            <div class="overlay">
                <div
                    class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                    <div class="cityBanner w-100">
                        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
                            <h1 class='display-5 mt-3 head' style="font-size:44px; color: white">Stop Watch</h1>
                        </div>

                        <div class="mb-5">
                            <p class='timer mt-5'><span id="timeDisplay">0:00:00.00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="controls mt-3 d-flex justify-content-center gap-2">
            <button id="pauseBtn" title="Pause/Resume" class="btn btn-danger btn-convert">
                <i class="fas fa-play"></i>
            </button>
            <button id="resetBtn" title="Reset" class="btn btn-danger btn-convert">
                <i class="fas fa-redo"></i>
            </button>
        </div>

        <script>
            const timeDisplay = document.getElementById('timeDisplay');
            const pauseBtn = document.getElementById('pauseBtn');
            const resetBtn = document.getElementById('resetBtn');

            let stopwatchInterval = null;
            let elapsedMilliseconds = 0;
            let isRunning = false;

            function updateDisplay() {
                const hours = Math.floor(elapsedMilliseconds / 3600000);
                const minutes = Math.floor((elapsedMilliseconds % 3600000) / 60000);
                const seconds = Math.floor((elapsedMilliseconds % 60000) / 1000);
                const milliseconds = Math.floor((elapsedMilliseconds % 1000) / 10);

                const timeParts = timeDisplay.textContent.split(':');
                const oldMilliseconds = timeParts[2].split('.')[1];
                const oldSeconds = timeParts[2].split('.')[0];
                const oldMinutes = timeParts[1];
                const oldHours = timeParts[0];

                if (oldHours !== String(hours).padStart(2, '0')) {
                    timeParts[0] = String(hours).padStart(2, '0');
                }

                if (oldMinutes !== String(minutes).padStart(2, '0')) {
                    timeParts[1] = String(minutes).padStart(2, '0');
                }

                if (oldSeconds !== String(seconds).padStart(2, '0')) {
                    timeParts[2] = `${String(seconds).padStart(2, '0')}.${oldMilliseconds}`;
                }

                if (oldMilliseconds !== String(milliseconds).padStart(2, '0')) {
                    timeParts[2] = `${String(seconds).padStart(2, '0')}.${String(milliseconds).padStart(2, '0')}`;
                }

                timeDisplay.textContent = timeParts.join(':');
            }

            function startStopwatch() {
                clearInterval(stopwatchInterval);
                const startTime = Date.now() - elapsedMilliseconds;

                stopwatchInterval = setInterval(() => {
                    elapsedMilliseconds = Date.now() - startTime;
                    updateDisplay();
                }, 10);
            }

            pauseBtn.addEventListener('click', () => {
                if (isRunning) {
                    clearInterval(stopwatchInterval);
                    pauseBtn.innerHTML = '<i class="fas fa-play"></i>';
                    pauseBtn.title = 'Play';
                } else {
                    startStopwatch();
                    pauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
                    pauseBtn.title = 'Pause';
                }
                isRunning = !isRunning;
            });

            resetBtn.addEventListener('click', () => {
                clearInterval(stopwatchInterval);
                elapsedMilliseconds = 0;
                timeDisplay.textContent = '00:00:00.00';
                pauseBtn.innerHTML = '<i class="fas fa-play"></i>';
                pauseBtn.title = 'Play';
                isRunning = false;
            });
        </script>
    </div>

    <div class="container my-5">
        <div class="row space-between">
            <div class="col">
                <a href="{{ url('/count-down-timer') }}">
                    <button class="btn btn-outline-secondary w-100 mb-2 px-4">
                        Count down timer
                    </button>
                </a>
            </div>
            <div class="col-1"></div>
            <div class="col">
                <a href="{{ url('/timer') }}">
                    <button class="btn btn-outline-secondary w-100 mb-2 px-4">
                        Fixed timer
                    </button>
                </a>
            </div>
        </div>
    </div>

@endsection
