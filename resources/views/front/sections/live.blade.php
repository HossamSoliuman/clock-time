<!-- Live -->
<div class="container">
    <div class="row text-center py-5">
        <h1 class="mb-3">Live World Clocks</h1>

{{--        <h1>Map and Current Time</h1>--}}
{{--        <div id="map"></div> <!-- The map will be displayed here -->--}}
{{--        <div id="current-time"></div> <!-- Display the current time here -->--}}

{{--        <!-- Include Leaflet JS -->--}}
{{--        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>--}}
{{--        <script>--}}
{{--            // Initialize the map--}}
{{--            var map = L.map('map').setView([51.505, -0.09], 13); // Set the initial view to London--}}

{{--            // Add a tile layer to the map--}}
{{--            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {--}}
{{--                maxZoom: 19,--}}
{{--                attribution: '© OpenStreetMap'--}}
{{--            }).addTo(map);--}}

{{--            // Add a marker--}}
{{--            var marker = L.marker([51.505, -0.09]).addTo(map);--}}
{{--            marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();--}}

{{--            // Display the current time in a specific timezone--}}
{{--            var timeInLA = moment().tz("America/Los_Angeles").format('YYYY-MM-DD HH:mm:ss');--}}
{{--            document.getElementById('current-time').innerText = "Current time in Los Angeles: " + timeInLA;--}}
{{--        </script>--}}
{{----}}
        <img loading="lazy" src="{{asset('public')}}/ImgHomePage/live.svg" alt="live" />
    </div>
</div>
<!-- Live end -->
