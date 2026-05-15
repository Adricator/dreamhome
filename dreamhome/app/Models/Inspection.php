<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'inspections';
    protected $primaryKey = 'inspection_no';
    public $incrementing = false;
    protected $keyType = 'string';

    // Disable the automatic created_at and updated_at columns
    public $timestamps = false; 

    protected $fillable = [
        'inspection_no',
        'property_id',
        'staff_id',
        'date',
        'comment'
    ];

    public function property()
{
    // We specify 'property_id' because that is the column name in your migration
    return $this->belongsTo(Property::class, 'property_id', 'property_id');
}

// You might also need the staff relationship if you plan to show who did the inspection
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}

