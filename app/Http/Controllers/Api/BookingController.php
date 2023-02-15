<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Property;

class BookingController extends Controller
{
    public function init(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $type = null;
        $uuid = null;
        $property = null;
        $name = $request->name;
        $starts_at = $request->start_at;
        $ends_at = $request->end_at;

        if($this->containsUuid($name)){
            $property = Property::where('name', $name)->first();

            if($property){
                $type = 'old';
            }
        }

        if(!$property)
        {
            $uuid = $this->generateUuid();
            $property = new Property;
            $property->name  = $name . ' ' . $uuid;
            $property->uuid = $uuid;
            $property->save();

            $type  = 'new';
        }

        // Create Booking
        $booking = $property->bookings()->create([
            'start_at' => $starts_at,
            'ends_at' => $ends_at
        ]);

        $response = [
            'success' => true,
            'type' => $type,
            'property' => $property,
            'booking' => $booking
        ];
        
        if($uuid){
            $response['uuid'] = $uuid;
        }

        return response()->json($response);

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
