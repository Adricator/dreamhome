<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /** @use HasFactory<\Database\Factories\PrivateOwnerFactory> */
    use HasFactory;
    protected $primaryKey = 'owner_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

    protected $fillable = [
        'owner_id',
        'first_name',
        'last_name',
        'address',
        'telephone_no',
        'email',
    ];
}