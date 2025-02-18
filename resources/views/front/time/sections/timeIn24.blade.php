<section class="convertSection py-5">
    <div class="container text-center">
        <div class="mb-4 text-white">
            <h2 class="searchBetweenA">{{ $timezoneName }} time zone now in 24 hours format</h2>
        </div>
        <div class="row justify-content-center text-white">
            <div class="d-flex justify-content-center align-items-center w-100">
                <span id="time24Display" data-initial-time="{{ $date['currentTimeWithSeconds'] }}"
                    style="font-size: 10vw;"></span>
            </div>
        </div>
    </div>
</section>

<script>
    function updateTime() {
        const timeDisplay = document.getElementById('time24Display');
        let initialTime = timeDisplay.getAttribute('data-initial-time');

        let [initialHours, initialMinutes, initialSeconds] = initialTime.split(':').map(Number);

        initialSeconds += 1;

        if (initialSeconds >= 60) {
            initialSeconds = 0;
            initialMinutes += 1;
        }
        if (initialMinutes >= 60) {
            initialMinutes = 0;
            initialHours += 1;
        }
        if (initialHours >= 24) {
            initialHours = 0;
        }

        const formattedTime =
            `${String(initialHours).padStart(2, '0')}:${String(initialMinutes).padStart(2, '0')}:${String(initialSeconds).padStart(2, '0')}`;

        timeDisplay.textContent = formattedTime;
        timeDisplay.setAttribute('data-initial-time', formattedTime);
    }

    setInterval(updateTime, 1000);
    updateTime();
</script>
