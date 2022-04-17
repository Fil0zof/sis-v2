<?php

namespace App\Models\OrganizationUnit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Troop extends OrganizationUnitModel
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'leader_id',
        'group_id',
    ];

    protected $hidden = [
        'leader_id',
        'group_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function patrols(): HasMany
    {
        return $this->hasMany(Patrol::class);
    }
}
