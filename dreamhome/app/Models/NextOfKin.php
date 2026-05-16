<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    /** @use HasFactory<\Database\Factories\NextOfKinFactory> */
    // If your table has a different primary key (e.g., staff_id) define it here:
    protected $primaryKey = 'staff_id'; 

    // Tell Laravel that the key is NOT an auto-incrementing integer
    public $incrementing = false;

    // If your primary key is a string (like 'ST0001'), specify it here:
    protected $keyType = 'string';
    
    // (Optional) If you don't have created_at and updated_at columns
    public $timestamps = false;
}
