<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    protected $table = 'registrations';

    // 1. Tell Laravel the primary key is NOT 'id'
    protected $primaryKey = 'client_id';

    // 2. Tell Laravel the primary key is NOT an incrementing integer
    public $incrementing = false;

    // 3. Tell Laravel the primary key is a string
    protected $keyType = 'string';

    // Ensure timestamps are disabled if you aren't using them
    // public $timestamps = false;

    protected $fillable = [
        'client_id', 
        'staff_id', 
        'branch_id', 
        'date_joined'
    ];
}
