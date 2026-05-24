<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'address',
        'telephone_no',
        'email',
        'password',
        'prefer_type',
        'max_rent',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function leases()
    {
        return $this->hasMany(Lease::class, 'client_id', 'client_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'client_id', 'client_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'client_id', 'client_id');
    }
}