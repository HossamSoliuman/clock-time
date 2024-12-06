<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimePageController extends Controller
{
   public function cityTime(){

       return view('front.TimePage.city-time')
           ->with('name_1','Search For The Current Time')
           ->with('name_2','In Any City Worldwide.');
   }
   public function countryTime(){
       return view('front.TimePage.country-time')
           ->with('name_1','Search For The Current Time')
           ->with('name_2','In Any Country Worldwide.');
   }


   public function zoneTime(){
       return view('front.TimePage.zone-time')
           ->with('name_1','Search Any Timezone Worldwide');
   }
}
