<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_checklist');
    }

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
