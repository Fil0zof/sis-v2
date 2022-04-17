<?php

namespace App\Models\Registration;

use App\Models\OrganizationUnit\Group;
use App\Models\OrganizationUnit\Troop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'info',
        'has_donation',
        'coordinator_member_id',
        'group_id',
        'troop_id',
    ];

    protected $hidden = [
        'coordinator_member_id',
        'group_id',
        'troop_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function troop(): BelongsTo
    {
        return $this->belongsTo(Troop::class);
    }

}
