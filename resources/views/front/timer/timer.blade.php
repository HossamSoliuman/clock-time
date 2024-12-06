@extends('front.inc.layout')
@section('title', 'Timer Online Free & Full Screen')
@section('description',
    'Free online timer. Set custom times or use pre-set options like 10 minutes. Simple and easy to
    use.')
@section('keywords',
    'Timer, Timer online, 1 minute timer, timer 10 minutes, 5 minute timer, Timer 10 minutes, Timer 2
    minutes, Timer 20 minutes, Timer 15 minutes, Timer 30 minutes, Timer 40 minutes, study timer, work timer, pomodoro
    timer, kitchen timer, exercise timer, meditation timer, five minute timer, ten minute timer, three minute timer, 1min
    timer, fifteen minute timer, 60 minute timer, one minute timer, digital timer, time timer, custom timer, preset timer,
    time management tool, productivity tool')
@section('ogImage', asset('public/images/timer.jpg'))
@section('ogImageAlt', 'Timer')
@section('url', urldecode(url()->current()))
@section('msvalidate', '8633E71DA03375A6E013D26DF14FDD3C')

@php
    $imageUrl = 'public/images/city-time.jpg';
@endphp
@section('container')


    <div class="container-fluid text-white g-2 p-0 me-0" style="margin-bottom: 8px">
        <style>
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

            .time {
                font-family: 'Lexend', sans-serif !important;
            }
        </style>

        <div class="img-city img-city-gmt">
            <div class="overlay">
                <div
                    class="d-flex h-100 align-items-center justify-content-center wow animate__animated animate__fadeInLeft">
                    <div class="cityBanner w-100">
                        <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto'>
                            <h1 class='display-5 mt-3 head' style="font-size:44px; color: white">Timer</h1>
                        </div>
                        <div class="select time mt-3 d-flex justify-content-center gap-2 flex-wrap">
                            <button class="btn btn-danger btn-convert" data-duration="300">5</button>
                            <button class="btn btn-danger btn-convert" data-duration="600">10</button>
                            <button class="btn btn-danger btn-convert" data-duration="900">15</button>
                            <button class="btn btn-danger btn-convert" data-duration="1200">20</button>
                            <button class="btn btn-danger btn-convert" data-duration="1800">30</button>
                            <button class="btn btn-danger btn-convert" data-duration="2700">45</button>
                            <button class="btn btn-danger btn-convert" data-bs-toggle="modal"
                                data-bs-target="#setTimeModal">Set Yours</button>
                        </div>
                        <div class="mb-5">
                            <p class='time mt-5'><span id="timeDisplay">0:00:00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timer Finished Modal -->
        <div class="modal fade" id="timerModal" tabindex="-1" aria-labelledby="timerModalLabel" aria-hidden="true">
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

        <!-- Set Time Modal -->
        <div class="modal fade" id="setTimeModal" tabindex="-1" aria-labelledby="setTimeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setTimeModalLabel">Set Custom Time</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="customTimeForm">
                            <div class="mb-3">
                                <label for="customTimeInput" class="form-label">Enter time in minutes:</label>
                                <input type="number" id="customTimeInput" class="form-control" placeholder="Enter minutes"
                                    min="1" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-convert" id="startCustomTime">Start
                            Timer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="controls mt-3 d-flex justify-content-center gap-2">
            <button id="pauseBtn" title="Pause/Resume" class="btn btn-danger btn-convert">
                <i class="fas fa-pause"></i>
            </button>
            <button id="resetBtn" title="Reset" class="btn btn-danger btn-convert">
                <i class="fas fa-redo"></i>
            </button>
            <button id="soundToggleBtn" class="btn btn-danger btn-convert" title="Toggle Sound">
                <i class="fas fa-bell"></i>
            </button>
            <button id="fullscreenBtn" title="Fullscreen" class="btn btn-danger btn-convert"
            aria-label="Enter Fullscreen">
            <i class="fas fa-expand"></i>
        </button>
        </div>


        <script>
            const timeDisplay = document.getElementById('timeDisplay');
            const pauseBtn = document.getElementById('pauseBtn');
            const resetBtn = document.getElementById('resetBtn');
            const soundToggleBtn = document.getElementById('soundToggleBtn');
            const fullscreenBtn = document.getElementById('fullscreenBtn');


            let timer = null;
            let totalSeconds = 0;
            let isPaused = false;
            let soundEnabled = true;

            function updateDisplay() {
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;
                timeDisplay.textContent =
                    `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }

            function playSound() {
                if (soundEnabled) {
                    const audio = new Audio('/public/sounds/alarm.wav');
                    audio.onerror = () => console.error('Audio file not found');
                    audio.play().catch(err => console.error('Playback error:', err));
                }
            }

            function startTimer(duration) {
                clearInterval(timer);
                totalSeconds = duration;
                updateDisplay();
                timer = setInterval(() => {
                    if (!isPaused) {
                        if (totalSeconds > 0) {
                            totalSeconds--;
                            updateDisplay();
                        } else {
                            clearInterval(timer);
                            const timerModal = new bootstrap.Modal(document.getElementById('timerModal'));
                            timerModal.show();
                            playSound();
                        }
                    }
                }, 1000);
            }

            pauseBtn.addEventListener('click', () => {
                if (timer) {
                    isPaused = !isPaused;
                    pauseBtn.innerHTML = isPaused ?
                        '<i class="fas fa-play"></i>' :
                        '<i class="fas fa-pause"></i>';
                    pauseBtn.title = isPaused ? 'Resume' : 'Pause';
                }
            });

            resetBtn.addEventListener('click', () => {
                clearInterval(timer);
                totalSeconds = 0;
                updateDisplay();
                pauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
                pauseBtn.title = 'Pause';
                isPaused = false;
            });

            soundToggleBtn.addEventListener('click', () => {
                soundEnabled = !soundEnabled;
                soundToggleBtn.classList.toggle('sound-enabled');
                soundToggleBtn.classList.toggle('sound-disabled');
                soundToggleBtn.innerHTML = soundEnabled ?
                    '<i class="fas fa-bell"></i>' :
                    '<i class="fas fa-bell-slash"></i>';
                soundToggleBtn.title = soundEnabled ? 'Disable Sound' : 'Enable Sound';
            });

            document.querySelectorAll('.btn-convert').forEach(btn => {
                btn.addEventListener('click', () => {
                    const duration = btn.getAttribute('data-duration');
                    if (duration) {
                        startTimer(parseInt(duration, 10));
                    }
                });
            });

            document.getElementById('startCustomTime').addEventListener('click', () => {
                const customTimeInput = document.getElementById('customTimeInput');
                const userMinutes = parseInt(customTimeInput.value, 10);
                if (!isNaN(userMinutes) && userMinutes > 0) {
                    const setTimeModal = bootstrap.Modal.getInstance(document.getElementById('setTimeModal'));
                    setTimeModal.hide();
                    startTimer(userMinutes * 60);
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
            updateDisplay();
        </script>


    </div>


@endsection
