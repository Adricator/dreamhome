<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Authenticatable
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
        return $this->hasOne(NextOfKin::class, 'staff_id', 'staff_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'staff_id');
    }

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'branch_id',
        'supervised_by',
        'address',
        'telephone_no',
        'email',
        'sex',
        'dob',
        'nin',
        'position',
        'salary',
        'date_hired',
        'car_allowance',
        'performance_bonus',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Staff $staff) {
            if (empty($staff->password)) {
                $staff->password = 'dreamhome123!';
            }
        });
    }
}
