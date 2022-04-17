<?php

namespace App\Models\OrganizationUnit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Group extends OrganizationUnitModel
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'iban',
        'leader_id',
    ];

    protected $hidden = [
        'leader_id',
    ];

    public function troops(): HasMany
    {
        return $this->hasMany(Troop::class);
    }

    public function patrols(): HasManyThrough
    {
        return $this->hasManyThrough(Patrol::class, Troop::class);
    }
}
