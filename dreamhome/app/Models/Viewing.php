<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewing extends Model
{
    protected $table = 'viewings';
    public $timestamps = false;
    protected $primaryKey = 'viewing_id';
    protected $fillable = [
        'client_id',
        'property_id',
        'view_date',
        'staff_id',
        'comments',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}