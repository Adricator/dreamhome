<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;
    protected $primaryKey = 'staff_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function nextOfKin()
    {
        return $this->hasOne(NextOfKin::class, 'staff_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'staff_id');
    }

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'address',
        'telephone_no',
        'sex',
        'dob',
        'nin',
        'position',
        'salary',
        'date_joined',
    ];
}
