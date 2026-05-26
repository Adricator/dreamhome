<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    public function getRouteKeyName(): string
{
    return 'inspection_id';
}
    use HasUuids; // Automatically handles UUID generation
    protected $table = 'inspections';

    protected $primaryKey = 'inspection_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'staff_id',
        'inspection_date',
        'comments',
    ];
}