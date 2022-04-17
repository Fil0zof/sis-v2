<?php

namespace App\Models\OrganizationUnit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patrol extends OrganizationUnitModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_id',
        'troop_id',
    ];

    protected $hidden = [
        'leader_id',
        'troop_id',
    ];

    public function troop(): BelongsTo
    {
        return $this->belongsTo(Troop::class);
    }

}
