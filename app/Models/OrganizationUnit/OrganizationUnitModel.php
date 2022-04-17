<?php

namespace App\Models\OrganizationUnit;

use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

abstract class OrganizationUnitModel extends Model
{
    use HasFactory;

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'leader_id', 'id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
