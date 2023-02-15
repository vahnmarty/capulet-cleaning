<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checklists()
    {
        return $this->belongsToMany(Checklist::class, 'service_checklist')->withPivot('completed_at');
    }
}
