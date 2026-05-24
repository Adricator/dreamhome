<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

   class Property extends Model
{
    protected $primaryKey = 'property_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function leases()
    {
        return $this->hasMany(Lease::class, 'property_id', 'property_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'property_id', 'property_id');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'property_id', 'property_id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'property_id', 'property_id');
    }

    protected $fillable = [
        'property_id',
        'owner_id',
        'branch_id',
        'staff_id',
        'street',
        'area',
        'city',
        'postcode',
        'type',
        'rooms',
        'monthly_rent',
        'status'
    ];
}

