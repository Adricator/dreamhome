<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

