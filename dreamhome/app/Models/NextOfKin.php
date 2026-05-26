<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    use HasFactory;
    protected $table = 'next_of_kin'; 
    protected $primaryKey = 'staff_id'; 
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'full_name',
        'relationship',
        'telephone_no',
        'address'
    ];
}
