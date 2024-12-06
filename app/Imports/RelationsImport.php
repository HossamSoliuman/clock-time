<?php

namespace App\Imports;


use App\Models\Abbreviation;
use App\Models\AbbreviationTimezone;
use App\Models\Country;
use App\Models\CountryTimezone;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RelationsImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
    {
        // Validate the row to avoid undefined index errors
        if (empty($row) || !isset($row['zone'])) {
            \Log::info("fail relation : ");
            \Log::info($row);
            return null;
        }

        $zone   = $row["zone"];
        $code   = $row["code"];
        $abb    = $row["abb"];
        $gmt    = $row["gmt"];
        $dst    = ($row["dst"]==0)?'no':'yes';


        $timeZone       = Timezone::where('name', $zone)->first();
        $country        = Country::where('code', $code)->first();
        $abbreviation   = Abbreviation::where('name', $abb)->first();

        $gmtName = $this->calculate_gmt_offset($gmt);
        $gmt            = Gmt::where('name', $gmtName)->where('dst', $dst)->first();

//        \Log::info($gmtName);

        if($gmt &&$timeZone&&$country && $abbreviation){
            $countryTimezone = CountryTimezone::firstOrCreate(
                [
                    'country_id' => $country->id,
                    'timezone_id' => $timeZone->id,
                    'gmt_id' => $gmt->id,
                ]
            );


            $abbreviationTimezone = AbbreviationTimezone::firstOrCreate(
                [
                    'abbreviation_id' => $abbreviation->id,
                    'timezone_id' => $timeZone->id,
                ]
            );

        }else{
            \Log::info("fail relation : $gmtName - Dst : ".$row['dst'].' - Zone : '.$row['zone'].' -ABBREVIATION :  '.$row["abb"]);
        }

//            \Log::info("fail relation $gmt : $gmt->name ");
//            \Log::info("fail relation $zone : $timeZone->name ");
//            \Log::info("fail relation $code : $country->name ");
//            \Log::info("fail relation $abb : $abbreviation->name ");

        return [];
    }





        public function calculate_gmt_offset($seconds) {
            // Convert seconds to hours
            $gmt_offset = floor($seconds / 3600);

            // Clamp the gmt_offset to the range of -12 to 12
            if ($gmt_offset > 14) {
                $gmt_offset = 14;
            } elseif ($gmt_offset < -14) {
                $gmt_offset = -14;
            }

            // Format as GMT + or GMT -
            if ($gmt_offset >= 0) {
                if ($gmt_offset < 10) {
                    return "GMT +" . $gmt_offset; // Ensure leading zero for single digits
                }
                return "GMT +" . $gmt_offset; // No leading zero for two-digit positives
            } else {
                return "GMT " . sprintf("%+03d", $gmt_offset); // Handles the negative sign
            }
        }



}
