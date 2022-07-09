<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory, UsesUuid;

    public $timestamps = false;

    protected $fillable = [
        'lead_id', 'name', 'lead_data'
    ];
}
