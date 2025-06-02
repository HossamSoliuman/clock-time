<?php

use App\Http\Controllers\ConvertAllToAllController;
use App\Http\Controllers\ConvertCityToCityController;
use App\Http\Controllers\ConvertCountryController;
use App\Http\Controllers\ConvertUtcCityController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MeetingPlannerController;
use App\Http\Controllers\TimePageController;
use App\Http\Controllers\Website\ConvertAllController;
use App\Http\Controllers\Website\ConvertGmtTimeZoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SlugController;
use App\Http\Controllers\TimeCalculatorController;
use App\Http\Controllers\TimeConverterController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\Website\ConvertGmtController;
use App\Http\Controllers\Website\LocationController;
use App\Models\TimezoneDetail;
use App\Models\IanaTimezone;
use App\Models\Gmt;
use App\Models\Country;
use App\Models\City;
use App\Models\Slug;
use Carbon\Carbon;



Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/country', [HomeController::class, 'country'])->name('country');
//Route::get('/city', [HomeController::class, 'city'])->name('city');

// Define the route for the slug-based time zone
// Route::get('/{slug}', [SlugController::class, 'getTimeForGmt']);

Route::resource('timezones', TimezoneController::class);
Route::resource('countries', CountryController::class);
Route::resource('cities', CityController::class);
Route::resource('slugs', SlugController::class);

// Route::get('test/t', function () {

//     $countries = Country::all();
//     $list = [];
//     foreach ($cities as $city) {
//         $isExist = Country::where('slug', $city->slug)->exists();
//         if ($isExist) {
//             $list[] = $city->slug;
//         }
//     }
//     return $list;
// });

// Route::get('sync/s', function () {
//     $timezones = City::all();

//     foreach ($timezones as $timezone) {
//         $slugExists = Slug::where('slug', $timezone->slug)
//             ->exists();

//         if (!$slugExists) {
//             Slug::create([
//                 'slug' => $timezone->slug,
//                 'model' => 'App\Models\City',
//             ]);
//         }
//     }

//     return response()->json(['message' => 'Slugs synced successfully']);
// });

Route::get('timer', [TimerController::class, 'timer']);
Route::get('count-down-timer', [TimerController::class, 'countDownTimer']);
Route::get('stop-watch', [TimerController::class, 'stopWatch']);
Route::get('upload', function () {
    return view('upload'); // Display the upload form
});

Route::get('export-city', [ExportController::class, 'exportCities']);
Route::get('export-country', [ExportController::class, 'exportCountry']);
Route::get('export-gmt', [ExportController::class, 'exportGmt']);
Route::get('export-capital', [ExportController::class, 'exportCapital']);
Route::get('export-admin', [ExportController::class, 'exportAdmin']);
Route::get('export-city', [ExportController::class, 'exportCities']);

Route::get('sitemap.xml', function () {
    return response()->view('sitemap.index')->header('Content-Type', 'text/xml'); // Display the upload form
});

Route::get('sitemap-country.xml', function () {
    return response()->view('sitemap.country-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-city.xml', function () {
    return response()->view('sitemap.city-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-capital-city.xml', function () {
    return response()->view('sitemap.capital-city-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-admin-city.xml', function () {
    return response()->view('sitemap.admin-city-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-timezone.xml', function () {
    return response()->view('sitemap.tz-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-abbreviation.xml', function () {
    return response()->view('sitemap.abb-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-timezone-name.xml', function () {
    return response()->view('sitemap.abb-name-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-gmt.xml', function () {
    return response()->view('sitemap.gmt-site')->header('Content-Type', 'text/xml'); // Display the upload form
});
Route::get('sitemap-utc.xml', function () {
    return response()->view('sitemap.utc-site')->header('Content-Type', 'text/xml'); // Display the upload form
});



Route::post('upload', [CityController::class, 'upload'])->name('upload.file');

//-----------------------------
Route::get('upload-country', function () {
    return view('upload-country'); // Display the upload form
});

Route::post('upload-country', [CityController::class, 'country'])->name('upload-country.file');

//-----------------------------
Route::get('upload-gmt', function () {
    return view('upload-gmt'); // Display the upload form
});


Route::post('upload-gmt', [CityController::class, 'gmt'])->name('upload-gmt.file');

//-----------------------------
Route::get('upload-abb', function () {
    return view('upload-abb'); // Display the upload form
});
Route::post('upload-abb', [CityController::class, 'abb'])->name('upload-abb.file');
//-----------------------------

//-----------------------------
Route::get('upload-zone', function () {
    return view('upload-zone'); // Display the upload form
});
Route::post('upload-zone', [CityController::class, 'zone'])->name('upload-zone.file');
//-----------------------------

//-----------------------------
Route::get('upload-relation', function () {
    return view('upload-relation'); // Display the upload form
});
Route::post('upload-relation', [CityController::class, 'relation'])->name('upload-relation.file');
//-----------------------------

Route::redirect('convert-gmt/{gmt}/to/{utc}', 'api/convert-gmt/{gmt}/to/{utc}', 301);


Route::get('api/convert-gmt/{gmt}/to/{utc}', [ConvertGmtController::class, 'convertTime'])->name('convert.gmt.to.time');


Route::get('/fetch-time-zones', [ConvertGmtTimeZoneController::class, 'fetchTimeZones'])->name('fetch.timezones');
Route::get('/convert-time/{zone1}/to/{zone2}', [ConvertGmtTimeZoneController::class, 'convertTime'])->name('convert.time.zone.to.time');

Route::get('/fetch-all', [ConvertAllController::class, 'fetchAll'])->name('fetch.all');
Route::get('/convert-all/{search_1}/to/{search_2}', [ConvertAllController::class, 'convertTime'])->name('convert.all.to.time');



Route::post('/fetch-country-city/{country_slug}', [CityController::class, 'ByCountry'])->name('fetch.country.city');


Route::get('/city', [LocationController::class, 'getUserLocation'])->name('city');
Route::get('/my-time-city', [LocationController::class, 'getUserLocationGmt'])->name('my.time.city');


//----------------------------convert country to country
Route::get('/convert-country', [ConvertCountryController::class, 'country'])->name('convert-country');
Route::get('/convert-city', [ConvertCountryController::class, 'city'])->name('convert-city');
Route::get('/convert-timezone', [ConvertCountryController::class, 'tz'])->name('convert-timezone');

Route::get('/fetch-country', [ConvertCountryController::class, 'fetchAll'])->name('fetch.country');
Route::get('/get-convert-country', [ConvertCountryController::class, 'fetchCountry'])->name('get.convert.country');

//---------------------------convert utc To City
Route::get('/fetch-gmts', [ConvertGmtController::class, 'fetchGmt'])->name('fetch.gmt');
Route::post('/fetch-city', [CityController::class, 'fetchAll'])->name('fetch.city');
Route::get('/fetch-city-planner', [CityController::class, 'fetchAllPlanner'])->name('fetch.city.planner');
Route::get('/get-convert-utc-city', [ConvertUtcCityController::class, 'fetchUtcCity'])->name('get.convert.utc.city');

Route::get('/get-convert-city-city', [ConvertCityToCityController::class, 'convertCity'])->name('get.convert.city.city');


//----------------convert from abb to time zone
Route::get('/fetch-abb', [ConvertGmtTimeZoneController::class, 'fetchAbb'])->name('fetch.abb');
Route::get('/fetch-tz', [ConvertGmtTimeZoneController::class, 'fetchTZ'])->name('fetch.tz');
Route::get('/get-convert-abb-tz', [ConvertGmtTimeZoneController::class, 'convertAbbTz'])->name('get.convert.abb.tz');
Route::get('/get-convert-tz-tz', [ConvertGmtTimeZoneController::class, 'convertTzToTz'])->name('get.convert.tz.tz');
Route::get('/get-convert-city-tz', [ConvertCityToCityController::class, 'convertCityToTime'])->name('get.convert.city.tz');
Route::get('/get-city-planner', [ConvertCityToCityController::class, 'getCity'])->name('get.city.planner');


//----------------convert from all to all zone
Route::get('/time-converter', [ConvertAllToAllController::class, 'index'])->name('time-converter');
Route::get('/get-convert-all-all', [ConvertAllToAllController::class, 'convertAllToAll'])->name('get.convert.all.all');
Route::get('/fetch-super-all', [ConvertAllToAllController::class, 'fetchAll'])->name('fetch.super.all');





//------------------meeting planner
Route::get('/meeting-planner', [MeetingPlannerController::class, 'index'])->name('meeting-planner');
Route::get('/getUserLocationPlanner', [MeetingPlannerController::class, 'getUserLocationPlanner'])->name('getUserLocationPlanner');


//-------------------country Time
Route::get('city-time', [TimePageController::class, 'cityTime'])->name('city-time');
Route::get('country-time', [TimePageController::class, 'countryTime'])->name('country-time');
Route::get('timezone-time', [TimePageController::class, 'zoneTime'])->name('timezone-time');


//-------------------404 page
// Define the 'not-found' route
Route::get('not-found', [LocationController::class, 'notFound'])->name('not-found');

// Fallback route to redirect to the 'not-found' route
Route::fallback(function () {
    return redirect()->route('not-found');
});

Route::get('/minutes-to-hours', [TimeConverterController::class, 'hoursToMins']);
Route::get('/hours-to-decimal', [TimeConverterController::class, 'hoursToDecimal']);
Route::get('/epoch-unix', [TimeConverterController::class, 'epochUnix']);

Route::get('/time-duration', [TimeCalculatorController::class, 'timeDuration']);
Route::get('/8-hour-day-calculator', [TimeCalculatorController::class, 'HourDayCalculator']);

Route::get('sand-timers', [GalleryController::class, 'sandTimers']);
Route::get('analog-clocks', [GalleryController::class, 'analogClocks']);
Route::get('digital-clocks', [GalleryController::class, 'digitalClocks']);

Route::view('event-announcer', 'front.announcer');
Route::view('education', 'front.education');

Route::get('/{slugable}', [HomeController::class, 'showBySlug']);

Route::post('api/convert/city-timezone', [ConvertController::class, 'zoneToCity'])->name('convert.city-timezone');
