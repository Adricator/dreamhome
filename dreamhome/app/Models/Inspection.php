<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'inspections';

    protected $primaryKey = 'inspection_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'staff_id',
        'date',
        'comment',
    ];
}