@extends('front.inc.layout')
@section('title', 'Countdown Timer')
@section('description',
    'Free Online Countdown Timer - Easy to use, customizable, and full-screen. Perfect for events,
    deadlines, and more. Start your countdown now')
@section('keywords',
    'Timer, Timer Clock, Countdown, countdown timer, online timer, free timer, digital timer, event
    timer, deadline timer, countdown clock, timer tool, full-screen timer, customizable timer, easy-to-use timer, web timer,
    time management tool, productivity tool, project timer, study timer, game timer, cooking timer, exercise timer')
@section('ogImage', asset('public/images/count-down-timer.jpg'))
@section('ogImageAlt', 'Countdown Timer')
@section('url', urldecode(url()->current()))
@section('msvalidate', '8633E71DA03375A6E013D26DF14FDD3C')
@php
    $imageUrl = 'public/images/count-down-timer.jpg';
@endphp

@section('container')
    <div class="container-fluid text-white g-2 p-0 me-0" style="position: relative">
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap" rel="stylesheet">
        <style>
            .arrow-up,
            .arrow-down {
                font-size: 1rem !important;
            }

            .time-unit {
                /* font-size: 10rem !important; */
                margin: 0 10px;
                font-weight: bold;
                text-align: center;
                font-family: 'Lexend', sans-serif !important;
            }

            .time {
                display: flex;
                justify-content: center;
                gap: 20px;
                align-items: center;
            }

            .controls {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                display: flex;
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }

            .controls button {
                color: white;
                font-size: 24px;
                cursor: pointer;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .img-city-gmt .overlay {
                background-color: rgba(0, 0, 0, 0.4);
            }

            .head {
                font-size: 4rem;
                color: white;
            }

            .container-fluid {
                margin-bottom: 8px;
            }

            @media (max-width: 768px) {
                .time-unit {
                    font-size: 40px;
                }
            }
        </style>

        <div class="img-city img-city-gmt" style="background-color: black">
            <div class="overlay">
                <div
                    class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                    <div class="cityBanner w-100">
                        <div class="d-block d-md-flex justify-content-center align-items-center w-75 m-auto">
                            <h1 class="display-5 mt-3 head">Countdown Timer</h1>
                        </div>
                        <p class="time mt-5">
                            <span id="timeDisplay">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                        <button class="btn btn-danger arrow-up btn-convert" data-unit="days"
                                            aria-label="Increase Days">▲</button>
                                        <p class="time-unit h2" id="days">0</p>
                                        <button class="btn btn-danger arrow-down btn-convert" data-unit="days"
                                            aria-label="Decrease Days">▼</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger arrow-up btn-convert" data-unit="hours"
                                            aria-label="Increase Hours">▲</button>
                                        <p class="time-unit h2" id="hours">00</p>
                                        <button class="btn btn-danger arrow-down btn-convert" data-unit="hours"
                                            aria-label="Decrease Hours">▼</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger arrow-up btn-convert" data-unit="minutes"
                                            aria-label="Increase Minutes">▲</button>
                                        <p class="time-unit h2" id="minutes">00</p>
                                        <button class="btn btn-danger arrow-down btn-convert" data-unit="minutes"
                                            aria-label="Decrease Minutes">▼</button>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="time-unit h2" id="seconds">00</p>
                                    </div>
                                </div>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="pauseBtn" title="Pause/Resume" class="btn btn-danger btn-convert"
                aria-label="Pause or Resume Timer">
                <i class="fas fa-play"></i>
            </button>
            <button id="resetBtn" title="Reset" class="btn btn-danger btn-convert" aria-label="Reset Timer">
                <i class="fas fa-redo"></i>
            </button>
            <button id="soundToggleBtn" class="btn btn-danger btn-convert" title="Toggle Sound"
                aria-label="Enable or Disable Sound">
                <i class="fas fa-bell"></i>
            </button>
            <button id="fullscreenBtn" title="Fullscreen" class="btn btn-danger btn-convert" aria-label="Enter Fullscreen">
                <i class="fas fa-expand"></i>
            </button>
        </div>

        <div class="modal fade text-black" id="timerModal" tabindex="-1" aria-labelledby="timerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="timerModalLabel">Timer Alert</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Time is up!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-convert" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const daysDisplay = document.getElementById('days');
            const hoursDisplay = document.getElementById('hours');
            const minutesDisplay = document.getElementById('minutes');
            const secondsDisplay = document.getElementById('seconds');
            const pauseBtn = document.getElementById('pauseBtn');
            const resetBtn = document.getElementById('resetBtn');
            const soundToggleBtn = document.getElementById('soundToggleBtn');
            const fullscreenBtn = document.getElementById('fullscreenBtn');

            let isPaused = true;
            let soundEnabled = true;
            let countdown = null;
            let totalSeconds = 0;

            function updateCountdownDisplay() {
                const days = Math.floor(totalSeconds / 86400);
                const hours = Math.floor((totalSeconds % 86400) / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                daysDisplay.textContent = days;
                hoursDisplay.textContent = String(hours).padStart(2, '0');
                minutesDisplay.textContent = String(minutes).padStart(2, '0');
                secondsDisplay.textContent = String(seconds).padStart(2, '0');
            }

            function playSound() {
                if (soundEnabled) {
                    const audio = new Audio('/public/sounds/alarm.wav');
                    audio.onerror = () => console.error('Audio file not found');
                    audio.play().catch(err => console.error('Playback error:', err));
                }
            }

            function startCountdown() {
                clearInterval(countdown);
                updateCountdownDisplay();

                countdown = setInterval(() => {
                    if (!isPaused) {
                        if (totalSeconds === 1) {
                            totalSeconds--;
                            updateCountdownDisplay();
                            clearInterval(countdown);
                            const timerModal = new bootstrap.Modal(document.getElementById('timerModal'));
                            timerModal.show();
                            playSound();
                            return;
                        }

                        if (totalSeconds > 0) {
                            totalSeconds--;
                            updateCountdownDisplay();
                        }
                    }
                }, 1000);
            }

            document.querySelectorAll('.arrow-up').forEach(button => {
                button.addEventListener('click', () => {
                    const unit = button.getAttribute('data-unit');
                    if (unit === 'days') totalSeconds += 86400;
                    if (unit === 'hours') totalSeconds += 3600;
                    if (unit === 'minutes') totalSeconds += 60;
                    updateCountdownDisplay();
                });
            });

            document.querySelectorAll('.arrow-down').forEach(button => {
                button.addEventListener('click', () => {
                    const unit = button.getAttribute('data-unit');
                    if (unit === 'days' && totalSeconds >= 86400) totalSeconds -= 86400;
                    if (unit === 'hours' && totalSeconds >= 3600) totalSeconds -= 3600;
                    if (unit === 'minutes' && totalSeconds >= 60) totalSeconds -= 60;
                    updateCountdownDisplay();
                });
            });

            resetBtn.addEventListener('click', () => {
                totalSeconds = 0;
                updateCountdownDisplay();
                clearInterval(countdown);
                isPaused = true;
                pauseBtn.querySelector('i').className = 'fas fa-play';
            });

            soundToggleBtn.addEventListener('click', () => {
                soundEnabled = !soundEnabled;
                const icon = soundToggleBtn.querySelector('i');
                icon.className = soundEnabled ? 'fas fa-bell' : 'fas fa-bell-slash';
            });

            pauseBtn.addEventListener('click', () => {
                if (isPaused) {
                    isPaused = false;
                    pauseBtn.querySelector('i').className = 'fas fa-pause';
                    if (!countdown) startCountdown();
                } else {
                    isPaused = true;
                    pauseBtn.querySelector('i').className = 'fas fa-play';
                }
            });

            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().catch(err => {
                        console.error(`Error attempting to enable fullscreen mode: ${err.message}`);
                    });
                    fullscreenBtn.querySelector('i').className = 'fas fa-compress';
                    fullscreenBtn.setAttribute('title', 'Exit Fullscreen');
                } else {
                    document.exitFullscreen().catch(err => {
                        console.error(`Error attempting to exit fullscreen mode: ${err.message}`);
                    });
                    fullscreenBtn.querySelector('i').className = 'fas fa-expand';
                    fullscreenBtn.setAttribute('title', 'Enter Fullscreen');
                }
            });

            document.addEventListener('fullscreenchange', () => {
                if (!document.fullscreenElement) {
                    fullscreenBtn.querySelector('i').className = 'fas fa-expand';
                    fullscreenBtn.setAttribute('title', 'Enter Fullscreen');
                }
            });
        </script>
    </div>

    <div class="container my-5">
        <div class="row space-between">
            <div class="col">
                <a href="{{ url('/stop-watch') }}">
                    <button class="btn btn-outline-secondary w-100 mb-2 px-4">
                        Stop watch
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
