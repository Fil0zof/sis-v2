<?php

namespace App\Models\Registration;

use App\Models\General\LegalRepresentative;
use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'fee',
        'donate',
        'payed',
        'note',
        'legal_representative_id',
        'legal_member_id',
    ];

    protected $hidden = [
        'legal_representative_id',
        'legal_member_id',
    ];

    public function legalRepresentative(): BelongsTo
    {
        return $this->belongsTo(LegalRepresentative::class, 'legal_representative_id', 'id');
    }

    public function legalMember(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'legal_member_id', 'id');
    }

}
