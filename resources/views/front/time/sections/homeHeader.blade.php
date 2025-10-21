<!-- Header -->
<div class="container-fluid text-white g-2 p-0 me-0" style="margin-bottom: 8px;background-color:black;">
    <div class="img-city img-city-gmt">
        <div class="overlay">
            <div class="d-flex h-100 align-items-center justify-content-center">
                <div class="cityBanner w-100">
                    <div class="mb-5 text-center">
                        <p class='time display-3 fw-bold'>
                            <span id="timeDisplay">{{ $currentDate['timewithSeconds'] }}</span>
                            <span id="timeDisplayspan">{{ strtolower($currentDate['identify']) }}</span>
                        </p>
                    </div>
                    <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto text-center'>
                        <h1 class='fw-bold' style="font-size: 42px; color: white;">
                            {{ $timezoneName }} Time Now : {{ strtoupper($currentDate['formatted_date_home']) }}
                        </h1>
                    </div>
                    <div class='d-block d-md-flex justify-content-center align-items-center w-75 m-auto text-center'>
                        <p class='p-1 px-2 mt-3 border border-light rounded-3 ' style="font-size: 25px; color: white;">
                            Time in {{ $timezoneName }} is within <a href="{{ url($ianaTimezone->slug) }}"
                                style="color: white">{{ $ianaTimezone->iana_timezone }}</a> zone
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    
</style>
<!-- Theclocktime_S2S_IncontentBanner1_ROS -->
<style>
	@media only screen and (min-width: 0px) and (min-height: 0px) {
		div[id^="bsa-zone_1760608118370-0_123456"] {
			min-width: 300px;
			min-height: 50px;
		}
	}
	@media only screen and (min-width: 880px) and (min-height: 0px) {
		div[id^="bsa-zone_1760608118370-0_123456"] {
			min-width: 300px;
			min-height: 250px;
		}
	}
</style>
<div id="bsa-zone_1760608118370-0_123456"></div>
<!-- end Header -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7869793057346493"
    crossorigin="anonymous"></script>
<!-- time test -->
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-7869793057346493"
    data-ad-slot="5691723064"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script>
    // Retrieve the initial time from the HTML content
    const initialTime = document.getElementById('timeDisplay').textContent;
    let [hours, minutes, seconds] = initialTime.split(':').map(Number);

    function updateDisplay() {
        const formattedTime =
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        document.getElementById('timeDisplay').textContent = formattedTime;
    }

    function incrementTime() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
                if (hours >= 24) hours = 0;
            }
        }
        updateDisplay();
    }
    updateDisplay();
    setInterval(incrementTime, 1000);
</script>
