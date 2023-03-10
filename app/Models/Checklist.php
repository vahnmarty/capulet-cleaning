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
        return $this->belongsToMany(Service::class, 'service_checklist')->withPivot('completed_at');
    }

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function markComplete()
    {
        return $this->update(['completed_at' => now()]);
    }
}
