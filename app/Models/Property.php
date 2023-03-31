<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];

    public function generateUuid() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $first_part = substr(str_shuffle($chars), 0, 3);
        $second_part = substr(str_shuffle($chars), 0, 3);
        return "#" . $first_part . "-" . $second_part;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
