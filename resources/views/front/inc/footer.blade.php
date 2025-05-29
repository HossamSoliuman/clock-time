<style>
    .footer-link {
        display: inline-block; /* Ensures padding is effective */
        padding: 10px 0;
        font-size: 16px;
    }
    .footerContent ul li {
        margin-bottom: 10px; /* Adds vertical spacing */
    }
</style>
<!-- Footer -->
<footer id="footer" class="footer-style">
    <div class="container p-4">
        <section class="text-center">
            <img src="{{asset('images/theclocktime-logo.png')}}" alt="the clock time logo" class="logoImage mb-3">
        </section>
        <section class="mb-4">
            <form action="">
                <div class="text-center">
                    <p>Subscribe to our newsletter</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="position-relative">
                            <i class="fa-regular fa-envelope position-absolute"
                                style="z-index: 9999;left:20px;top:12px;color:rgba(189, 193, 202, 1);"></i>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control ps-5" placeholder="Input your email (Coming Soon)"
                                    aria-label="Input your email" aria-describedby="button-addon2" id="mailInput">
                                <button class="btn btn-convert" type="button" id="button-addon2">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <section class="footerContent mb-5">
            <div class="row w-75 m-auto justify-content-center text-lg-start text-center">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h4 class="text-uppercase text-white">Products</h4>
                    <ul class="list-unstyled mb-0">
                        <li><h3 style="line-height:0.2"><a title="City time" class="footer-link" href="{{url('/city-time')}}">City time</a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="Country time" class="footer-link" href="{{url('/country-time')}}">Country time </a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="Time Zone" class="footer-link" href="{{url('/timezone-time')}}">Time Zone</a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="Meeting Planner" class="footer-link" href="{{url('/meeting-planner')}}">Meeting Planner</a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="Kids time learning" class="footer-link" href="#">Kids time learning </a></h3></li>
                    </ul>
                </div>

                 <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h4 class="text-uppercase text-white">Products</h4>
                        <ul class="list-unstyled mb-0">
                            <li><h3 style="line-height:0.2"><a title="Stop watch" class="footer-link" href="{{ url('stop-watch') }}">Stop watch</a></h3></li>
                            <li><h3 style="line-height:0.2"><a title="Timer" class="footer-link" href="{{ url('timer') }}">Timer</a></h3></li>
                            <li><h3 style="line-height:0.2"><a title="Hourglass" class="footer-link" href="#">Hourglass </a></h3></li>
                            <li><h3 style="line-height:0.2"><a title="Sand timer" class="footer-link" href="#">Sand timer </a></h3></li>
                            <li><h3 style="line-height:0.2"><a title="countdown-timer" class="footer-link" href="{{ url('count-down-timer') }}">Countdown-timer </a></h3>
                            </li>
                        </ul>
                    </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 mt-md-3 mt-lg-0">
                    <h4 class="text-uppercase text-white">Converters</h4>
                    <ul class="list-unstyled mb-0">
                        <li><h3 style="line-height:0.2"><a title="convert time  by City" class="footer-link" href="{{url('/convert-city')}}">Convert time by City </a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="convert time  by Country" class="footer-link" href="{{url('/convert-country')}}">Convert time by Country </a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="convert   by  Time Zone" class="footer-link" href="{{url('/convert-timezone')}}">Convert by Time Zone  </a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="time converter" class="footer-link" href="{{url('/time-converter')}}">Time converter  </a></h3></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 mt-md-3 mt-lg-0">
                    <h4 class="text-uppercase text-white">Company</h4>
                    <ul class="list-unstyled mb-0">
                        <li><h3 style="line-height:0.2"><a title="About us" class="footer-link" href="#">About us</a></h3></li>
                        <li><h3 style="line-height:0.2"><a title="Contact us" class="footer-link" href="#">Contact us</a></h3></li>
                    </ul>
                </div>
            </div>
        </section>
        
        
        <div class="row d-flex text-center mt-5 align-items-end">
            <div class='col-lg-2 col-12 mb-lg-0 mb-3'>
                <select name="select-language" id="" class='select-language  pe-5 rounded-2' disabled>
                    <option value="English" selected disabled>English</option>
{{--                    <option value="Arabic">Arabic</option>--}}
                </select>
            </div>
            <div class='col-lg-6 col-md-12 col-12'>
                <ul class="d-flex flex-column flex-md-row justify-content-center align-items-center m-0">
                    <li class="me-md-4 mb-2 mb-md-0" style="color: #fff">© The Clock Time Brand, LLC.</li>
                </ul>
            </div>
           
            
            
            
            
            <div class="col-lg-4 col-12 link-group">
                <a  href="#" class="d-inline-block me-2 social-icon" title="Tiktok"><img loading="lazy" src="{{ asset('public') }}/tik.svg"
                        alt="Tiktok" /></a>
                <a  href="https://www.pinterest.com/theclocktime/" class="d-inline-block me-2 social-icon" title="Pinterest"><img loading="lazy" src="{{ asset('public') }}/pint.svg"
                        alt="Pinterest" /></a>
                <a  href="#" class="d-inline-block me-2 social-icon" title="Instagram"><img loading="lazy" src="{{ asset('public') }}/ig.svg"
                        alt="Instagram" /></a>
                <a  href="https://x.com/theclocktime" class="d-inline-block me-2 social-icon" title="Twitter"><img loading="lazy" src="{{ asset('public') }}/twt.svg"
                        alt="Twitter" /></a>
                <a  href="#" class="d-inline-block me-2 social-icon" title="Facebook"><img loading="lazy" src="{{ asset('public') }}/fb.svg"
                        alt="Facebook" /></a>
                <a  href="https://www.linkedin.com/company/the-clock-time" class="d-inline-block me-2 social-icon" title="LinkedIn"><img loading="lazy" src="{{ asset('public') }}/in.svg"
                        alt="LinkedIn" /></a>
                <a  href="https://www.youtube.com/@TheClockTimecom" class="d-inline-block social-icon" title="Youtube"><img loading="lazy" src="{{ asset('public') }}/yt.svg"
                        alt="Youtube" /></a>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->




    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WG483ZXMQH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-WG483ZXMQH');
    </script>
<script src="{{ asset('cdn/wow.min.js') }}"></script>
<script src="{{ asset('moment') }}/moment-timezone-with-data-10-year-range.min.js"></script>
<script src="{{ asset('cdn/bootstrap.bundle.min.js') }}"></script>
<script>
    new WOW().init();
</script>

