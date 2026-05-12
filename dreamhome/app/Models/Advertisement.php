<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'ad_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ad_id',
        'property_id',
        'media_source',
        'date_advertised',
        'cost'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
