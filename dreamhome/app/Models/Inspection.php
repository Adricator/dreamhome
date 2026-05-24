<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    // Use inspection_id as primary key instead of id
    protected $primaryKey = 'inspection_id';

    protected $fillable = [
        'property_id',
        'inspection_date',
        'staff_id',
        'comments',
    ];

   protected $casts = [
    'inspection_date' => 'datetime',
];
}