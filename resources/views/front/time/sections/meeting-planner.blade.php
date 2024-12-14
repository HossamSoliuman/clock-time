<style>
    #AddCityButtonDate:focus {
        box-shadow: none;
        outline: none;
        border: none;
    }

    .tagify__tag>div>[contenteditable] {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .removeBtnDiv {
        width: 3% !important;
    }

    @media only screen and (min-width: 767px) {
        .justMobile {
            display: none;
        }

        #addCitySection {
            order: 999;
        }
    }

    @media only screen and (max-width: 767px) {
        .col-3.main-custom-div2 {
            padding-top: 10px;
            padding-bottom: 10px;
            box-shadow: 5px 10px 15px rgba(136, 136, 136, 0.5);
        }

        #addCityButton {
            height: 41px;
            width: 200px;
        }

        .card.p-3.ms-auto {
            flex-direction: row;
            gap: 8px;
        }

        .orderContainer {
            padding: 4 !important;
        }

        .fa-solid {
            font-size: 12px;
        }

        .d-flex.justify-content-between {
            height: 100%;
        }

        .content.w-100 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .orderedsContanier {
            justify-content: stretch;
        }

        .card {
            border: none !important;
            padding: 0 !important;
            justify-content: space-between !important;
        }

        #addCitySection {
            order: 1;
        }

        #addCitySection {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        .justDesktop {
            display: none;
        }

        .timeHours .btn {
            max-width: 100%;
            width: fit-content;
            height: 20px !important;
            font-size: 10px !important;
        }

        .timeHours .btn:active {
            background-color: red !important
        }

        .main-custom-div,
        .main-custom-div2,
        .main-custom-div3 {
            width: 100% !important;
        }

        .main-custom-div3 {
            margin-bottom: 10px;
        }

        .main-custom-div3 .card {
            width: 100% !important;
        }

        .main-custom-div .timeHours {
            padding: 0 12px !important;
        }

        .meeting-planner-section .timeHours {
            width: 100% !important;
            justify-content: space-between;
            margin-top: 0px;
            padding: 0;
            gap: 1px;
        }

        .removeBtnDiv,
        .removeItem {
            width: 100% !important;
        }

        .removeBtnDiv {
            margin-top: 10px;
        }

        .removeItem i::before {
            font-size: 12px !important;
        }

        .switcher label::before,
        .switcher label::after {
            font-size: 16px !important;
        }

        .switcher label::after {
            line-height: 30px !important;
        }

        .heading-custom-class {
            font-size: 20px !important;
        }

        .div50 {
            width: 50% !important;
        }

        .div100 {
            width: 100% !important;
        }

        .timeText {
            font-size: 20px !important;
        }

        .cityText {
            font-size: 20px !important;
        }

        .countryText {
            font-size: 14px !important;
        }

        #meetingOnContent p {
            font-size: 16px !important;
        }
    }


    #citiesSelected {
        display: flex;
        flex-direction: column;
        gap: 0;
        margin-bottom: 48px;
    }

    .flagMobile {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: -14px;
    }

    .flagMobile p {
        margin: 0;
        font-weight: 550;
    }
</style>
<section class="meeting-planner-section">
    <div class="container-fluid my-4">
        <div class="text-center mb-5">
            <h2 class="mt-0 pt-0 heading-custom-class">
                Professional meeting planner for different timezones
            </h2>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3"></div>
            <div class="col-lg-9 ps-4 ps-md-0">
                <div class="d-flex justify-content-end div100" style="width: 97%;gap:15px">
                    <div class="col-2 div50">
                        <input id="AddCityButtonDate" type="date" class="form-control h-100"
                            style="background-color: #f00;color:#fff;border-radius: 3px">
                    </div>
                    <div class="col-3 text-end div50">
                        <div class="switcher w-100">
                            <div class="btn-container w-100">
                                <label class="switch btn-color-mode-switch w-100">
                                    <input value="1" id="color_mode" name="color_mode" type="checkbox">
                                    <label class="btn-color-mode-switch-inner" data-off="12Hour" data-on="24Hour"
                                        for="color_mode"></label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="citiesSelected">
            <div class="row" id="citiesSelectedRow">
            </div>
            <div id="addCitySection">
                <div class="item">
                    <div class="row">
                        <div class="col-3 main-custom-div3">
                            <div class="card p-3 ms-auto" style="width: 90%">
                                <input name='meetingCitySearch' placeholder="Add another city..."
                                    class="w-100 rounded-2" required />
                                <button id="addCityButton" class="btn btn-convert rounded-1 d-md-none">
                                    <i class="fas fa-plus me-2"></i> Add City
                                </button>
                            </div>
                        </div>
                        <div class="col-9 ps-0 main-custom-div justDesktop">
                            <div class="d-flex timeHours">
                                <button class="btn btn-dark" data-time="1">
                                    1
                                </button>
                                <button class="btn btn-dark" data-time="2">
                                    2
                                </button>
                                <button class="btn btn-dark" data-time="3">
                                    3
                                </button>
                                <button class="btn btn-dark" data-time="4">
                                    4
                                </button>
                                <button class="btn btn-dark" data-time="5">
                                    5
                                </button>
                                <button class="btn btn-dark" data-time="6">
                                    6
                                </button>
                                <button class="btn btn-secondary" data-time="7">
                                    7
                                </button>
                                <button class="btn btn-secondary" data-time="8">
                                    8
                                </button>
                                <button class="btn btn-light" data-time="9">
                                    9
                                </button>
                                <button class="btn btn-light" data-time="10">
                                    10
                                </button>
                                <button class="btn btn-light" data-time="11">
                                    11
                                </button>
                                <button class="btn btn-light" data-time="12">
                                    12
                                </button>
                                <button class="btn btn-light" data-time="13">
                                    1
                                </button>
                                <button class="btn btn-light" data-time="14">
                                    2
                                </button>
                                <button class="btn btn-light" data-time="15">
                                    3
                                </button>
                                <button class="btn btn-light" data-time="16">
                                    4
                                </button>
                                <button class="btn btn-secondary" data-time="17">
                                    5
                                </button>
                                <button class="btn btn-secondary" data-time="18">
                                    6
                                </button>
                                <button class="btn btn-dark" data-time="19">
                                    7
                                </button>
                                <button class="btn btn-dark" data-time="20">
                                    8
                                </button>
                                <button class="btn btn-dark" data-time="21">
                                    9
                                </button>
                                <button class="btn btn-dark" data-time="22">
                                    10
                                </button>
                                <button class="btn btn-dark" data-time="23">
                                    11
                                </button>
                                <button class="btn btn-dark" data-time="24">
                                    12
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="addCitySection">
            <div class="item">
                <div class="row">
                    <div class="col-3 main-custom-div3">
                        <div class="card p-3 ms-auto" style="width: 90%">
                            <input name='meetingCitySearch' placeholder="Add another city..." class="w-100 rounded-2"
                                required />
                        </div>
                    </div>
                    <div class="col-9 ps-0 main-custom-div">
                        <div class="d-flex timeHours">
                            <button class="btn btn-dark" data-time="1">
                                1
                            </button>
                            <button class="btn btn-dark" data-time="2">
                                2
                            </button>
                            <button class="btn btn-dark" data-time="3">
                                3
                            </button>
                            <button class="btn btn-dark" data-time="4">
                                4
                            </button>
                            <button class="btn btn-dark" data-time="5">
                                5
                            </button>
                            <button class="btn btn-dark" data-time="6">
                                6
                            </button>
                            <button class="btn btn-secondary" data-time="7">
                                7
                            </button>
                            <button class="btn btn-secondary" data-time="8">
                                8
                            </button>
                            <button class="btn btn-light" data-time="9">
                                9
                            </button>
                            <button class="btn btn-light" data-time="10">
                                10
                            </button>
                            <button class="btn btn-light" data-time="11">
                                11
                            </button>
                            <button class="btn btn-light" data-time="12">
                                12
                            </button>
                            <button class="btn btn-light" data-time="13">
                                1
                            </button>
                            <button class="btn btn-light" data-time="14">
                                2
                            </button>
                            <button class="btn btn-light" data-time="15">
                                3
                            </button>
                            <button class="btn btn-light" data-time="16">
                                4
                            </button>
                            <button class="btn btn-secondary" data-time="17">
                                5
                            </button>
                            <button class="btn btn-secondary" data-time="18">
                                6
                            </button>
                            <button class="btn btn-dark" data-time="19">
                                7
                            </button>
                            <button class="btn btn-dark" data-time="20">
                                8
                            </button>
                            <button class="btn btn-dark" data-time="21">
                                9
                            </button>
                            <button class="btn btn-dark" data-time="22">
                                10
                            </button>
                            <button class="btn btn-dark" data-time="23">
                                11
                            </button>
                            <button class="btn btn-dark" data-time="24">
                                12
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="mt-3" id="meetingPlannerMessages">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 ps-md-0">
                    <div class="shadow">
                        <div class="col-6">
                            <h2>
                                <button class="btn btn-convert rounded-1 w-100" style="height: 41px;"> Meeting on
                                </button>
                            </h2>
                        </div>
                        <div class="col-12 p-3" id="meetingOnContent">
                        </div>
                        <div class="meetingIcons d-flex justify-content-end px-4 pb-3" style="gap: 20px">
                            <i class="fa-solid fa-print" onclick="printContent()"></i>
                            <i class="fa-solid fa-calendar-days" onclick="addToCalendar()"></i>
                            <i class="fa-solid fa-envelope" onclick="sendEmail()"></i>
                            <i class="fa-solid fa-copy" onclick="copyText()"></i>
                            <i class="fa-brands fa-square-whatsapp" onclick="sendToWhatsApp()"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-6 ps-md-0 mt-3">
                    <div class="shadow">

                        <div class="col-6">
                            <h2>
                                <button class="btn btn-convert rounded-1 w-100" style="height: 41px;"> Meeting Mail
                                    Ready
                                </button>
                            </h2>
                        </div>
                        <div class="p-3" id="meetingMailContent">
                            <div>
                                <p class="pt-4">
                                    Hi everyone,
                                </p>
                                <p>
                                    I wanted to confirm the meeting time scheduled for <span class="text-danger">
                                        <span id="daySelected"></span>, <span id="dateSelected"></span></span>.
                                    Please find the respective times for your locations as below:
                                </p>
                            </div>
                            <div id="meetingMailContentRows">
                            </div>
                            <div>
                                <p>
                                    These times have been provided by <a href="https://www.theclocktime.com/"
                                        class="text-danger" target="_blank">theclocktime.com</a>
                                    to ensure accuracy.
                                    Please mark your calendars accordingly.Let me know if you have any questions
                                    Looking forward to our discussion.
                                </p>
                                <p>
                                    Best regards,
                                </p>
                            </div>
                        </div>

                        <div class="meetingIcons d-flex justify-content-end px-4 pb-3" style="gap: 20px">
                            <i class="fa-solid fa-print" onclick="printContent2()"></i>
                            <i class="fa-solid fa-calendar-days" onclick="addToCalendar2()"></i>
                            <i class="fa-solid fa-envelope" onclick="sendEmail2()"></i>
                            <i class="fa-solid fa-copy" onclick="copyText2()"></i>
                            <i class="fa-brands fa-square-whatsapp" onclick="sendToWhatsApp2()"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<script>
    const daysOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
    const daysOfWeekFull = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"
    ];
    var meetingSearchInput;
    $(document).ready(function() {
        localStorage.removeItem('date');


        var today = new Date();
        console.log(today);

        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');

        var formattedDate = `${year}-${month}-${day}`;
        console.log(formattedDate);

        $('#AddCityButtonDate').val(formattedDate);

        $('#AddCityButtonDate').val(formattedDate);


        var input2 = document.querySelector('input[name=meetingCitySearch]');
        meetingSearchInput = new Tagify(input2, {
            enforceWhitelist: false,
            mode: "select",
        });

        // التعامل مع تغيير القيمة
        function handleCityAddition() {
            let slug = meetingSearchInput.value[0]?.slug;
            if (slug) {
                let isset = false;
                meetingSearchInput.removeAllTags();
                meetingSearchInput.dropdown.hide.call();
                $('#citiesSelected #citiesSelectedRow .col-12').each((index, ele) => {
                    $(ele).find('.removeItem').each((index, button) => {
                        if ($(button).data('city') === slug) {
                            alert('You Chose This City Before!');
                            isset = true;
                        }
                    });
                });
                $('#citiesSelected .justMobile').each((index, ele) => {
                    $(ele).find('.removeItem').each((index, button) => {
                        if ($(button).data('city') === slug) {
                            alert('You Chose This City Before!');
                            isset = true;
                        }
                    });
                });
                if (!isset) {
                    getCityData(slug);
                    addCityToLocalstorage(slug);
                }
            }
        }

        // تفعيل الزر للموبايل والتابلت
        $('#addCityButton').on('click', function() {
            handleCityAddition();
        });

        // التغيير التلقائي يعمل على الديسكتوب فقط
        meetingSearchInput.on('change', function() {
            if (window.innerWidth >= 768) {
                handleCityAddition();
            }
        });

        // طلب البيانات أثناء الكتابة
        meetingSearchInput.on('input', function(e) {
            $.ajax({
                url: '{{ route('fetch.city') }}',
                type: 'post',
                data: {
                    search: e.detail.value,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    meetingSearchInput.settings.whitelist = response;
                    meetingSearchInput.dropdown.show.call();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                },
            });
        });
    });
    var date = localStorage.getItem('date') ? new Date(localStorage.getItem('date')) : new Date();
    var formattedDate = date.toISOString().split('T')[0]; // Formats as YYYY-MM-DD
    $('#AddCityButtonDate').val(formattedDate);
    $('#AddCityButtonDate').on('change', function() {
        localStorage.setItem('date', $(this).val())
        renderTimeSelect()
    });
    $('#AddCityButtonDate').on('click', function() {
        this.showPicker();
    });
    $(document).on('click', '.toUp', function() {
        let button = $(this);
        button.prop('disabled', true);
        let ownDiv = button.closest('.col-12');
        let ownOrder = ownDiv.data('order');

        let previousDiv = $('#citiesSelected .col-12').filter(function() {
            return $(this).data('order') == ownOrder - 1;
        }).first();

        if (previousDiv.length) {
            let newOrder = previousDiv.data('order');
            ownDiv.css('order', newOrder);
            previousDiv.css('order', ownOrder);

            ownDiv.data('order', newOrder).attr('data-order', newOrder);
            previousDiv.data('order', ownOrder).attr('data-order', ownOrder);
        }
        button.prop('disabled', false);
    });

    $(document).on('click', '.toBottom', function() {
        let button = $(this);
        button.prop('disabled', true);
        let ownDiv = button.closest('.col-12');
        let ownOrder = ownDiv.data('order');

        let nextDiv = $('#citiesSelected .col-12').filter(function() {
            return $(this).data('order') == ownOrder + 1;
        }).first();

        if (nextDiv.length) {
            let newOrder = nextDiv.data('order');
            ownDiv.css('order', newOrder);
            nextDiv.css('order', ownOrder);

            ownDiv.data('order', newOrder).attr('data-order', newOrder);
            nextDiv.data('order', ownOrder).attr('data-order', ownOrder);
        }
        button.prop('disabled', false);
    });

    $('#citiesSelected').on('click', '.removeItem', function(e) {
        var citySlug = $(this).data('city');

        removeCityFromLocalstorage(citySlug);

        $(this).closest('.col-12').remove();

        $('#timesContainer[data-slug="' + citySlug + '"]').remove();

        $('#citiesSelected .col-12').each((index, ele) => {
            $(ele).data('order', index + 1).attr('data-order', index + 1);
        });

        $('#meetingOnContent div').each((index, div) => {
            if ($(div).data('slug') == citySlug) {
                $(div).remove();
            }
        });

        $('#meetingMailContentRows .row').each((index, div) => {
            if ($(div).data('slug') == citySlug) {
                $(div).remove();
            }
        });

        // إذا لم يكن هناك أي عناصر في #citiesSelected، إزالة 'timeZero' من localStorage
        if ($('#citiesSelected .col-12').length == 0) {
            localStorage.removeItem('timeZero');
        }
    });

    $('#color_mode').on('change', function() {
        if ($('#color_mode').prop('checked')) {
            $('#make12').removeClass('d-none');
            let elements = $('.timeHours button').filter(function() {
                return $(this).data('time') > 12;
            });
            elements.each((index, ele) => {
                $(ele).html($(ele).data('time'));
            });
        } else {
            $('#make24').removeClass('d-none');
            let elements = $('.timeHours button').filter(function() {
                return $(this).data('time') > 12;
            });
            elements.each((index, ele) => {
                $(ele).html($(ele).data('time') - 12);
            });
        }

        let is24HourFormat = $(this).prop('checked'); // إذا كان true، التنسيق 24 ساعة
        $('#citiesSelected .justMobile').each((index, ele) => {
            let hisTime = parseInt(localStorage.getItem('timeZero')) + parseInt($(ele).data('gmt'));

            // تأكد من معالجة الحالتين عند تجاوز منتصف الليل
            if (hisTime <= 0) {
                hisTime += 24;
            } else if (hisTime > 24) {
                hisTime -= 24;
            }

            // صياغة الوقت
            let formattedTime = `${hisTime}:00`;
            if (!is24HourFormat) {
                // تحويل الوقت إلى 12 ساعة مع AM/PM
                let hour = hisTime % 12 || 12; // إذا كان صفر، اجعله 12
                let ampm = hisTime >= 12 ? 'PM' : 'AM';
                formattedTime = `${hour}:00 ${ampm}`;
            }

            // تحديث عنصر mobile-time-only
            $(ele).find('.mobile-time-only p').html(`${formattedTime}`);
        });
    });

    function getCityData(city) {
        $.ajax({
            url: '{{ route('get.city.planner') }}',
            type: 'get',
            data: {
                city_slug: city,
            },
            success: function(response) {
                $('#addCitySerach').val('').trigger('change')
                addRow(response)
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function addRow(data) {
        function calculateNewOrder() {
            let lastOrder = 0;
            $('#citiesSelected .justMobile').each(function() {
                let order = $(this).data('order');
                if (order > lastOrder) {
                    lastOrder = order;
                }
            });
            return lastOrder + 1;
        }


        let perant = $('#citiesSelected #citiesSelectedRow');
        let order = calculateNewOrder();
        let fullHours = $('#color_mode').prop('checked');

        $('#citiesSelected .justMobile').each((index, ele) => {
            $(ele).data('order', index).attr('data-order', index);
        });

        let newRow = `
            <div class="justDesktop col-12 mb-3 mb-md-0" data-order="${order}" data-gmt="${Math.round(data.gmt)}" data-slug="${data.city_slug}" data-now="${data.hours}" style="order: ${order}">
                <div class="item mb-3">
                    <div class="row">
                        <div class="col-3 main-custom-div2">
                            <div class="d-flex">
                                <div class="orderContainer d-flex flex-column justify-content-center p-2 pb-0"
                                    style="width: 10%">
                                    <button class="btn p-0 toUp">
                                        <i class="fa-solid fa-chevron-up"></i>
                                    </button>
                                    <button class="btn p-0 toBottom">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                    <button class="btn removeItem d-md-none py-1 mt-3 pt-0" data-city="${data.city_slug}">
                                        <i class="fa-solid fa-x" style="color:#fff;"></i>
                                    </button>
                                </div>
                                <div class="card p-2" style="width: 90%; justify-content: center;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex w-100">
                                            <div class="img me-2 pt-1">
                                                <img loading="lazy" src="${data.flag}"
                                                    alt="${data.city_name}" width="20">
                                            </div>
                                            <div class="content w-100">
                                                <div class="d-flex justify-content-between">
                                                    <p class="cityText p-0 m-0">
                                                    ${data.city_name}
                                                    </p>
                                                    <p class="timeText p-0 m-0">
                                                        ${data.time}
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p class="countryText p-0 m-0">
                                                        ${data.country_name}
                                                    </p>
                                                    <p class="countryText p-0 m-0">
                                                        ${data.day}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 p-0 position-relative main-custom-div">
                            <p class="text-danger p-0 m-0 position-absolute bottom-100 alertDay d-none" style="font-size:11px;font-weight: 500;"></p>
                            <div class="d-flex h-100 flex-column flex-md-row">
                                <div class="p-0 mobile-time-only d-block d-md-none align-items-center justify-content-center align-self-center" style="margin-top: 10px;padding-right: 10px !important;">
                                    <p class="mb-0">12:00PM</p>
                                </div>
                                <div class="d-flex timeHours">
                                    <button class="btn btn-dark" data-time="1">
                                        1
                                    </button>
                                    <button class="btn btn-dark" data-time="2">
                                        2
                                    </button>
                                    <button class="btn btn-dark" data-time="3">
                                        3
                                    </button>
                                    <button class="btn btn-dark" data-time="4">
                                        4
                                    </button>
                                    <button class="btn btn-dark" data-time="5">
                                        5
                                    </button>
                                    <button class="btn btn-dark" data-time="6">
                                        6
                                    </button>
                                    <button class="btn btn-secondary" data-time="7">
                                        7
                                    </button>
                                    <button class="btn btn-secondary" data-time="8">
                                        8
                                    </button>
                                    <button class="btn btn-light" data-time="9">
                                        9
                                    </button>
                                    <button class="btn btn-light" data-time="10">
                                        10
                                    </button>
                                    <button class="btn btn-light" data-time="11">
                                        11
                                    </button>
                                    <button class="btn btn-light" data-time="12">
                                        12
                                    </button>
                                    <button class="btn btn-light" data-time="13">
                                        ${fullHours ? 13 : 1}
                                    </button>
                                    <button class="btn btn-light" data-time="14">
                                        ${fullHours ? 14 : 2}
                                    </button>
                                    <button class="btn btn-light" data-time="15">
                                        ${fullHours ? 15 : 3}
                                    </button>
                                    <button class="btn btn-light" data-time="16">
                                        ${fullHours ? 16 : 4}
                                    </button>
                                    <button class="btn btn-secondary" data-time="17">
                                        ${fullHours ? 17 : 5}
                                    </button>
                                    <button class="btn btn-secondary" data-time="18">
                                        ${fullHours ? 18 : 6}
                                    </button>
                                    <button class="btn btn-dark" data-time="19">
                                        ${fullHours ? 19 : 7}
                                    </button>
                                    <button class="btn btn-dark" data-time="20">
                                        ${fullHours ? 20 : 8}
                                    </button>
                                    <button class="btn btn-dark" data-time="21">
                                        ${fullHours ? 21 : 9}
                                    </button>
                                    <button class="btn btn-dark" data-time="22">
                                        ${fullHours ? 22 : 10}
                                    </button>
                                    <button class="btn btn-dark" data-time="23">
                                        ${fullHours ? 23 : 11}
                                    </button>
                                    <button class="btn btn-dark" data-time="24">
                                        ${fullHours ? 24 : 12}
                                    </button>
                                </div>
                                <div class="p-1 d-none d-md-flex align-items-center justify-content-center align-self-center removeBtnDiv">
                                    <button class="btn removeItem" data-city="${data.city_slug}">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `

        let newRowMobile = `
<div class="justMobile col-12 mb-3 mb-md-0" data-order="${order}" data-gmt="${Math.round(data.gmt)}" data-slug="${data.city_slug}" data-now="${data.hours}" style="order: ${order}">
    <div class="item mb-3">
        <div class="row">
            <div class="col-3 main-custom-div2">
                <div class="d-flex orderedsContanier">
                    <div class="orderContainer d-flex flex-column justify-content-center p-2 pb-0" style="width: 10%">
                        <button class="btn p-0 toUp">
                            <i class="fa-solid fa-chevron-up"></i>
                        </button>
                        <button class="btn p-0 toBottom">
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <button class="btn removeItem d-md-none py-1 mt-3 pt-0" data-city="${data.city_slug}">
                            <i class="fa-solid fa-trash" style="color:#fff;"></i>
                        </button>
                    </div>
                    <div class="card p-2" style="width: 90%; justify-content: center;">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex w-100">
                                <div class="img me-2 pt-1">
                                    <img loading="lazy" src="${data.flag}" alt="${data.city_name}" width="20">
                                </div>
                                <div class="content w-100">
                                    <div class="d-flex justify-content-between">
                                        <p class="cityText p-0 m-0">
                                            ${data.city_name}
                                        </p>
                                        <p class="timeText p-0 m-0">
                                            ${data.time}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="countryText p-0 m-0">
                                            ${data.country_name}
                                        </p>
                                        <p class="countryText p-0 m-0">
                                            ${data.day}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        `

        let timesMobile = `
            <div id="timesContainer" class="justMobile col-12 mb-4 mb-md-0 position-relative" data-order="${order}" data-gmt="${Math.round(data.gmt)}" data-slug="${data.city_slug}" data-now="${data.hours}" style="order: ${order}" >
            <div class="flagMobile">
            <img loading="lazy" src="${data.flag}" alt="${data.city_name}" width="20">
                    <p>${data.city_name}</p>
                    </div>
                    <p class="text-danger p-0 m-0 position-absolute alertDay d-none" style="bottom: 35%; font-size:11px;font-weight: 500;"></p>
                <div class="d-flex h-100 flex-column flex-md-row">
                    <div class="p-0 mobile-time-only d-block d-md-none align-items-center justify-content-center align-self-center" style="margin-top: 10px;padding-right: 10px !important;">
                        <p class="mb-0">12:00PM</p>
                    </div>
                    <div class="d-flex timeHours">
                        <button class="btn btn-dark" data-time="1">
                            1
                        </button>
                        <button class="btn btn-dark" data-time="2">
                            2
                        </button>
                        <button class="btn btn-dark" data-time="3">
                            3
                        </button>
                        <button class="btn btn-dark" data-time="4">
                            4
                        </button>
                        <button class="btn btn-dark" data-time="5">
                            5
                        </button>
                        <button class="btn btn-dark" data-time="6">
                            6
                        </button>
                        <button class="btn btn-secondary" data-time="7">
                            7
                        </button>
                        <button class="btn btn-secondary" data-time="8">
                            8
                        </button>
                        <button class="btn btn-light" data-time="9">
                            9
                        </button>
                        <button class="btn btn-light" data-time="10">
                            10
                        </button>
                        <button class="btn btn-light" data-time="11">
                            11
                        </button>
                        <button class="btn btn-light" data-time="12">
                            12
                        </button>
                        <button class="btn btn-light" data-time="13">
                            ${fullHours ? 13 : 1}
                        </button>
                        <button class="btn btn-light" data-time="14">
                            ${fullHours ? 14 : 2}
                        </button>
                        <button class="btn btn-light" data-time="15">
                            ${fullHours ? 15 : 3}
                        </button>
                        <button class="btn btn-light" data-time="16">
                            ${fullHours ? 16 : 4}
                        </button>
                        <button class="btn btn-secondary" data-time="17">
                            ${fullHours ? 17 : 5}
                        </button>
                        <button class="btn btn-secondary" data-time="18">
                            ${fullHours ? 18 : 6}
                        </button>
                        <button class="btn btn-dark" data-time="19">
                            ${fullHours ? 19 : 7}
                        </button>
                        <button class="btn btn-dark" data-time="20">
                            ${fullHours ? 20 : 8}
                        </button>
                        <button class="btn btn-dark" data-time="21">
                            ${fullHours ? 21 : 9}
                        </button>
                        <button class="btn btn-dark" data-time="22">
                            ${fullHours ? 22 : 10}
                        </button>
                        <button class="btn btn-dark" data-time="23">
                            ${fullHours ? 23 : 11}
                        </button>
                        <button class="btn btn-dark" data-time="24">
                            ${fullHours ? 24 : 12}
                        </button>
                    </div>
                    <div class="p-1 d-none d-md-flex align-items-center justify-content-center align-self-center removeBtnDiv">
                        <button class="btn removeItem" data-city="${data.city_slug}">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        `;

        $(perant).append(newRow);
        $(perant).append(newRowMobile);
        $('#citiesSelected').append(timesMobile);
        addNewRowInMeetingBox(data.city_name, data.country_name, data.city_slug)
        addNewRowInMeetingMail(data.city_name, data.country_name, data.city_slug)
        renderTimeSelect()
    }

    $(document).ready(function() {
        localStorage.setItem('timeZero', timeZero);

        let citiesArray = localStorage.getItem('cities');
        if (citiesArray && JSON.parse(localStorage.getItem('cities')).length > 0) {
            citiesArray = JSON.parse(localStorage.getItem('cities'));
            citiesArray.forEach((ele) => {
                getCityData(ele)
            })
        } else {
            $.ajax({
                url: '{{ route('getUserLocationPlanner') }}',
                type: 'get',
                success: function(response) {
                    if (response.success) {
                        let city = response.data
                        $.ajax({
                            url: '{{ route('get.city.planner') }}',
                            type: 'get',
                            data: {
                                city_slug: city,
                            },
                            success: function(response) {
                                $('#addCitySerach').val('').trigger('change')
                                addCityToLocalstorage(city)
                                addRow(response)
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    })
    $('#citiesSelected').on('click', '.timeHours button', function(e) {
        $('#citiesSelected #citiesSelectedRow .col-12 .timeHours button').each((index, ele) => {
            $(ele).removeClass('active');
        });
        $('#citiesSelected .justMobile .timeHours button').each((index, ele) => {
            $(ele).removeClass('active');
        });
        let ownGmt = $(this).closest('.col-12').data('gmt');
        let time = $(this).data('time');
        let timeZero = time - ownGmt;
        localStorage.setItem('timeZero', timeZero);
        renderTimeSelect()
    });

    function formatDate(date) {
        const day = date.getDate();
        const month = monthsOfYear[date.getMonth()];
        const year = date.getFullYear();

        // Get the suffix for the day
        let daySuffix;
        if (day % 10 === 1 && day !== 11) {
            daySuffix = "st";
        } else if (day % 10 === 2 && day !== 12) {
            daySuffix = "nd";
        } else if (day % 10 === 3 && day !== 13) {
            daySuffix = "rd";
        } else {
            daySuffix = "th";
        }

        return `${day}${daySuffix} ${month} ${year}`;
    }

    function renderTimeSelect() {
        let date = new Date($('#AddCityButtonDate').val());
        $('#daySelected').html(daysOfWeekFull[date.getDay()]);
        $('#dateSelected').html(formatDate(date));

        $('#citiesSelected .justMobile').each((index, ele) => {
            let date = new Date($('#AddCityButtonDate').val());
            let alert;
            const toggleAlertDay = (show) => {
                $(ele).find('.alertDay').each((_, ale) => {
                    alert = $(ale);
                    $(ale).toggleClass('d-none', !show);
                });
            };

            if (alert && alert.length) {
                alert.html(daysOfWeek[date.getDay()]);
            }
            toggleAlertDay(false);
            let hisGmt = parseInt($(ele).data('gmt'));
            let hisTime = parseInt(localStorage.getItem('timeZero')) + hisGmt;
            if (hisTime <= 0) {
                date.setDate(date.getDate() - 1);
                hisTime += 24;
                toggleAlertDay(true);
                alert.html(daysOfWeek[date.getDay()]);
            }
            if (hisTime > 24) {
                date.setDate(date.getDate() + 1);
                hisTime -= 24;
                toggleAlertDay(true);
                if (alert) {
                    alert.html(daysOfWeek[date.getDay()]);
                }
            }
            $('#meetingOnContent div').each((i, el) => {
                if ($(el).data('slug') === $(ele).data('slug')) {
                    $(el).find('.time').html(date.toDateString());
                    if (hisTime) {
                        $(el).find('.time2').html(`${hisTime}:00`);
                        if (hisTime <= 12)
                            $(el).find('.time3').html(`${hisTime}:00 AM`);
                        else
                            $(el).find('.time3').html(`${hisTime - 12}:00 PM`);
                    } else {
                        $(el).find('.time2').html(`00:00`);
                        $(el).find('.time3').html(`00:00`);
                    }
                }
            });
            $('#meetingMailContentRows .row').each((i, el) => {
                if ($(el).data('slug') === $(ele).data('slug')) {
                    $(el).find('.time').html(date.toDateString());
                    if (hisTime) {
                        $(el).find('.time2').html(`${hisTime}:00`);
                        if (hisTime <= 12)
                            $(el).find('.time3').html(`${hisTime}:00 AM`);
                        else
                            $(el).find('.time3').html(`${hisTime - 12}:00 PM`);
                    } else {
                        $(el).find('.time2').html(`00:00`);
                        $(el).find('.time3').html(`00:00`);
                    }
                }
            });
            $(ele).find('.timeHours button').each((index, button) => {
                let is24HourFormat = $('#color_mode').prop('checked'); // إذا كان true سيكون 24 ساعة
                let formattedTime = `${hisTime}:00`;

                // إذا كان التنسيق 12 ساعة، قم بتحويل الوقت إلى تنسيق 12 ساعة
                if (!is24HourFormat) {
                    // تحويل الوقت إلى 12 ساعة مع تحديد AM/PM
                    let hour = parseInt(hisTime);
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12;
                    hour = hour ? hour : 12; // 0 يصبح 12
                    formattedTime = `${hour}:00 ${ampm}`;
                }

                if ($(button).data('time') == hisTime) {
                    $(button).parent().parent().find('.mobile-time-only').find('p').html(
                        `${formattedTime}`);
                    $(button).addClass('active');
                } else {
                    $(button).removeClass('active');
                }
                $(button).attr('disabled', false);
            });
            $(ele).find('.timeHours button').each((index, button) => {
                if ($(button).data('time') == hisTime) {
                    $(button).addClass('active');
                } else {
                    $(button).removeClass('active');
                }
                $(button).attr('disabled', false);
            });
        });


        $('#citiesSelected #citiesSelectedRow .col-12').each((index, ele) => {
            let date = new Date($('#AddCityButtonDate').val());
            let alert;
            const toggleAlertDay = (show) => {
                $(ele).find('.alertDay').each((_, ale) => {
                    alert = $(ale);
                    $(ale).toggleClass('d-none', !show);
                });
            };

            if (alert && alert.length) {
                alert.html(daysOfWeek[date.getDay()]);
            }
            toggleAlertDay(false);
            let hisGmt = parseInt($(ele).data('gmt'));
            let hisTime = parseInt(localStorage.getItem('timeZero')) + hisGmt;
            if (hisTime <= 0) {
                date.setDate(date.getDate() - 1);
                hisTime += 24;
                toggleAlertDay(true);
                alert.html(daysOfWeek[date.getDay()]);
            }
            if (hisTime > 24) {
                date.setDate(date.getDate() + 1);
                hisTime -= 24;
                toggleAlertDay(true);
                if (alert) {
                    alert.html(daysOfWeek[date.getDay()]);
                }
            }
            $('#meetingOnContent div').each((i, el) => {
                if ($(el).data('slug') === $(ele).data('slug')) {
                    $(el).find('.time').html(date.toDateString());
                    if (hisTime) {
                        $(el).find('.time2').html(`${hisTime}:00`);
                        if (hisTime <= 12)
                            $(el).find('.time3').html(`${hisTime}:00 AM`);
                        else
                            $(el).find('.time3').html(`${hisTime - 12}:00 PM`);
                    } else {
                        $(el).find('.time2').html(`00:00`);
                        $(el).find('.time3').html(`00:00`);
                    }
                }
            });
            $('#meetingMailContentRows .row').each((i, el) => {
                if ($(el).data('slug') === $(ele).data('slug')) {
                    $(el).find('.time').html(date.toDateString());
                    if (hisTime) {
                        $(el).find('.time2').html(`${hisTime}:00`);
                        if (hisTime <= 12)
                            $(el).find('.time3').html(`${hisTime}:00 AM`);
                        else
                            $(el).find('.time3').html(`${hisTime - 12}:00 PM`);
                    } else {
                        $(el).find('.time2').html(`00:00`);
                        $(el).find('.time3').html(`00:00`);
                    }
                }
            });
            $(ele).find('.timeHours button').each((index, button) => {
                if ($(button).data('time') == hisTime) {
                    $(button).addClass('active');
                } else {
                    $(button).removeClass('active');
                }
                $(button).attr('disabled', false);
            });
        });
        let today = new Date();
        let newToday = today.setHours(0, 0, 0, 0);
        let newDate = date.setHours(0, 0, 0, 0);
        if (newDate < newToday) {
            dayNotAvailable()
        } else if (newDate === newToday) {
            $('#citiesSelected #citiesSelectedRow .col-12').each((index, ele) => {
                let time = $(ele).data('now');
                $(ele).find('.timeHours button').each((index, button) => {
                    if ($(button).data('time') <= time) {
                        $(button).attr('disabled', true);
                        $(button).removeClass('active');
                    }
                });
            });
            $('#citiesSelected .justMobile').each((index, ele) => {
                let time = $(ele).data('now');
                $(ele).find('.timeHours button').each((index, button) => {
                    if ($(button).data('time') <= time) {
                        $(button).attr('disabled', true);
                        $(button).removeClass('active');
                    }
                });
            });
        } else {
            $('#meetingPlannerMessages').removeClass('d-none');
        }
    }

    function addCityToLocalstorage(city) {
        let citiesArray = JSON.parse(localStorage.getItem('cities')) ?? [];
        citiesArray.push(city);
        localStorage.setItem('cities', JSON.stringify(citiesArray));
    }

    function removeCityFromLocalstorage(city) {
        let citiesArray = JSON.parse(localStorage.getItem('cities')) ?? [];
        const index = citiesArray.indexOf(city);
        if (index !== -1) {
            citiesArray.splice(index, 1);
        }
        localStorage.setItem('cities', JSON.stringify(citiesArray));
    }

    function dayNotAvailable() {
        $('#citiesSelected #citiesSelectedRow .col-12').each((index, ele) => {
            $(ele).find('.timeHours button').each((index, button) => {
                $(button).removeClass('active');
                $(button).attr('disabled', true);
            });
        });
        $('#citiesSelected .justMobile').each((index, ele) => {
            $(ele).find('.timeHours button').each((index, button) => {
                $(button).removeClass('active');
                $(button).attr('disabled', true);
            });
        });
        $('#meetingPlannerMessages').addClass('d-none');
    }

    function addNewRowInMeetingBox(city, country, slug) {
        newRow =
            `
                <div class="d-flex justify-content-between" data-slug='${slug}'>
                    <p>${city} - ${country}</p>
                    <p>
                        <span class="time"></span> at <span class="time2"></span> (<span class="time3"></span>)
                    </p>
                </div>
            `
        $('#meetingOnContent').append(newRow);
    }

    function addNewRowInMeetingMail(city, country, slug) {
        newRow =
            `<div class="row" data-slug='${slug}'>
                <div class="col-3">
                    <p style="font-weight: bold">${city} - ${country}</p>
                </div>
                <div class="col-9">
                    <p style="font-weight: bold">
                        <span class="time"></span> at <span class="time2"></span> (<span class="time3"></span>)
                    </p>
                </div>
            </div>
            `
        $('#meetingMailContentRows').append(newRow);
    }

    function sendToWhatsApp() {
        const content = document.getElementById("meetingOnContent").innerText;
        const encodedContent = encodeURIComponent(content);
        const whatsappUrl = `https://wa.me/?text=${encodedContent}`;
        window.open(whatsappUrl, "_blank");
    }

    function copyText() {
        const content = document.getElementById("meetingOnContent").innerText;
        const encodedContent = encodeURIComponent(content);
        navigator.clipboard.writeText(content)
    }

    function sendEmail() {
        const content = document.getElementById("meetingOnContent").innerText;
        const subject = "Meetting Planner"; // Subject of the email
        const encodedContent = encodeURIComponent(content);
        const email = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodedContent}`;
        window.open(email, "_blank"); // Open the default email client
    }

    function sendToWhatsApp2() {
        const content = document.getElementById("meetingMailContent").innerText;
        const encodedContent = encodeURIComponent(content);
        const whatsappUrl = `https://wa.me/?text=${encodedContent}`;
        window.open(whatsappUrl, "_blank");
    }

    function copyText2() {
        const content = document.getElementById("meetingMailContent").innerText;
        const encodedContent = encodeURIComponent(content);
        navigator.clipboard.writeText(content)
    }

    function sendEmail2() {
        const content = document.getElementById("meetingMailContent").innerText;
        const subject = "Meetting Planner"; // Subject of the email
        const encodedContent = encodeURIComponent(content);
        const email = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodedContent}`;
        window.open(email, "_blank"); // Open the default email client
    }

    function printContent() {
        const content = document.getElementById("meetingOnContent").innerHTML; // Get the HTML content
        const printWindow = window.open('', '', 'height=600,width=800'); // Create a new window
        printWindow.document.write('<html><head><title>Print</title></head><body>'); // Write HTML structure
        printWindow.document.write(content); // Write the content to be printed
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document for writing
        printWindow.print(); // Open the print dialog
    }

    function printContent2() {
        const content = document.getElementById("meetingMailContent").innerHTML; // Get the HTML content
        const printWindow = window.open('', '', 'height=600,width=800'); // Create a new window
        printWindow.document.write('<html><head><title>Print</title></head><body>'); // Write HTML structure
        printWindow.document.write(content); // Write the content to be printed
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document for writing
        printWindow.print(); // Open the print dialog
    }

    function addToCalendar() {
        const content = document.getElementById("meetingOnContent").innerText; // Get the text content
        const subject = "Meeting Event"; // Title of the event
        const startDateInput = $('#AddCityButtonDate').val(); // Get the start date from the input
        const description = content; // Description of the event

        // Create a Date object from the input
        const startDate = new Date(startDateInput);

        // Function to format date for ICS
        const formatDate = (date) => {
            return date.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z'; // Format to YYYYMMDDTHHMMSSZ
        };

        const start = formatDate(startDate); // Format the start date

        // Create the ICS file content
        const icsContent = `BEGIN:VCALENDAR
        VERSION:2.0
        BEGIN:VEVENT
        DTSTAMP:${start}
        DTSTART:${start}
        SUMMARY:${subject}
        DESCRIPTION:${description}
        END:VEVENT
        END:VCALENDAR`;

        // Create a Blob and download the ICS file
        const blob = new Blob([icsContent], {
            type: 'text/calendar'
        });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'event.ics'; // Filename for the calendar event
        a.click(); // Programmatically click the link to trigger the download
        URL.revokeObjectURL(url); // Clean up the URL object
    }

    function addToCalendar2() {
        const content = document.getElementById("meetingMailContent").innerText; // Get the text content
        const subject = "Meeting Event"; // Title of the event
        const startDateInput = $('#AddCityButtonDate').val(); // Get the start date from the input
        const description = content; // Description of the event

        // Create a Date object from the input
        const startDate = new Date(startDateInput);

        // Function to format date for ICS
        const formatDate = (date) => {
            return date.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z'; // Format to YYYYMMDDTHHMMSSZ
        };

        const start = formatDate(startDate); // Format the start date

        // Create the ICS file content
        const icsContent = `BEGIN:VCALENDAR
        VERSION:2.0
        BEGIN:VEVENT
        DTSTAMP:${start}
        DTSTART:${start}
        SUMMARY:${subject}
        DESCRIPTION:${description}
        END:VEVENT
        END:VCALENDAR`;

        // Create a Blob and download the ICS file
        const blob = new Blob([icsContent], {
            type: 'text/calendar'
        });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'event.ics'; // Filename for the calendar event
        a.click(); // Programmatically click the link to trigger the download
        URL.revokeObjectURL(url); // Clean up the URL object
    }
</script>
