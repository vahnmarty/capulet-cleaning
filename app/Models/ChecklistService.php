<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistService extends Model
{
    use HasFactory;

    protected $table = 'service_checklist';

    protected $fillable = ['completed_at'];
}
