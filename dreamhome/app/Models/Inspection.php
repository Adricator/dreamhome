<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasUuids; // 1. Always group your trait declarations together at the very top

    protected $table = 'inspections';

    protected $primaryKey = 'inspection_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false; // Kept as false since your seeder handles this manually

    protected $fillable = [
        'inspection_id', // FIX: Added to prevent MassAssignmentExceptions
        'property_id',
        'staff_id',
        'inspection_date',
        'comments',
    ];

    /**
     * FIX: Tell the HasUuids trait exactly which column to inject UUIDs into.
     */
    public function uniqueIds(): array
    {
        return ['inspection_id'];
    }

    /**
     * Route Model Binding Key Definition
     */
    public function getRouteKeyName(): string
    {
        return 'inspection_id';
    }
}