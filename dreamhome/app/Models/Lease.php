<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    /** @use HasFactory<\Database\Factories\LeaseFactory> */
    use HasFactory;
    protected $primaryKey = 'lease_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function property() {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'lease_id');
    }
}
