<?php

namespace App\Models\General;

use App\Models\OrganizationUnit\Group;
use App\Models\OrganizationUnit\Patrol;
use App\Models\OrganizationUnit\Troop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends AddressModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_data',
        'email',
        'phone',
        'health_problems',
        'dietary_restrictions',
        'is_disadvantaged',
        'has_card',
        'form_received',
        'is_legal_representative',
        'address_id',
        'correspondence_address_id',
        'patrol_id',
        'troop_id',
        'group_id',
        'legal_representative_id',
        'user_id',
    ];

    protected $hidden = [
        'address_id',
        'correspondence_address_id',
        'patrol_id',
        'troop_id',
        'group_id',
        'legal_representative_id',
        'user_id',
    ];

    public function correspondenceAddress(): HasOne
    {
        return $this->hasOne(Address::class, "id", "correspondence_address_id");
    }

    public function patrol(): BelongsTo
    {
        return $this->belongsTo(Patrol::class);
    }

    public function troop(): BelongsTo
    {
        return $this->belongsTo(Troop::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function legalRepresentative(): HasOne
    {
        return $this->hasOne(LegalRepresentative::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

}
