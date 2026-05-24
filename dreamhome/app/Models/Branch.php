<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    use HasFactory;
    protected $primaryKey = 'branch_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'branch_id');
    }

    public function manager()
    {
        // Adjust 'manager_id' to your actual foreign key column name 
        // and 'staff_id' to the primary key in your staff table
        return $this->belongsTo(Staff::class, 'manager_id', 'staff_id');
    }

    protected $fillable = [
        'branch_id',
        'street', 
        'area', 
        'city', 
        'postcode', 
        'telephone_no', 
        'fax_no'
        ];
}

