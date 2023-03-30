<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Property;
use Goutte;
use Str;

class BookingController extends Controller
{
    const NOT_VALIDATED = 'not validated';

    public function init(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([ 
                    'error'=>$validator->errors()
                ], 401);
        }

        

        # Props
        $type = null;
        $uuid = null;
        $property = null;
        $name = $request->name;
        $starts_at = $request->start_at;
        $ends_at = $request->end_at;
        $statusCode = null;
        $response = [];

        # UUID
        if($this->containsUuid($name)){
            $property = Property::where('name', $name)->first();

            if($property){
                $type = 'old';
            }
        }

        # New Property
        if(!$property)
        {
            $uuid = $this->generateUuid();
            $property = new Property;
            $property->name  = $name . ' ' . $uuid;
            $property->uuid = $uuid;
            $property->save();

            $type  = 'new';
        }

        # AirBnb
        if($request->link)
        {
            $url = $request->link;
            $airbnb = Str::contains($url, 'airbnb.com');

            if($airbnb){
                $crawler = Goutte::request('GET', $url);
                $titleTag = $crawler->filter('title')->text();

                $titleLine = explode(' - ', $titleTag);
                $title = $titleLine[0];

                if($title){
                    $property->listing_title = $title;
                    $property->status = self::NOT_VALIDATED;
                    $property->save();

                    $statusCode = 201;
                    $response['message'] = "property saved";
                }

            }else{
                $statusCode = 202;
                $response['message'] = "property saved; unsupported URL";
            }
        }
        

        # Create Booking
        $booking = $property->bookings()->create([
            'start_at' => $starts_at,
            'ends_at' => $ends_at
        ]);

        # Response
        
        $response['uuid'] = $property->uuid;

        return response()->json($response, $statusCode);

    }

    public function containsUuid($string)
    {
        return str_contains($string, '#');
    }

    public function generateUuid() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $first_part = substr(str_shuffle($chars), 0, 3);
        $second_part = substr(str_shuffle($chars), 0, 3);
        return "#" . $first_part . "-" . $second_part;
    }
}
