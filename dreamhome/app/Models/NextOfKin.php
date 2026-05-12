<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    /** @use HasFactory<\Database\Factories\NextOfKinFactory> */
    use HasFactory;
    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
