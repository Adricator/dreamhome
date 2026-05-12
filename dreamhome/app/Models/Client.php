<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function leases()
    {
        return $this->hasMany(Lease::class, 'client_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'client_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'client_id');
    }

    protected $fillable = [
        'client_id', 
        'first_name', 
        'last_name', 
        'address', 
        'telephone_no', 
        'email', 
        'prefer_type', 
        'max_rent'
    ];
}

