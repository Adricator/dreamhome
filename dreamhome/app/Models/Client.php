<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // FIX 1: Add missing notification management trait
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable; // Include Notifiable here

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'branch_id',
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

    /**
     * FIX 2: Add the casts system to handle cryptographic password hashing
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /* --- Relations Matrix --- */

    public function leases()
    {
        return $this->hasMany(Lease::class, 'client_id', 'client_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'client_id', 'client_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
