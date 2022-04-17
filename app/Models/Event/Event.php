<?php

namespace App\Models\Event;

use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsible_member_id',
        'created_by_member_id'
    ];

    protected $hidden = [
        'responsible_member_id',
        'created_by_member_id'
    ];

    public function responsibleMember(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'responsible_member_id', 'id');
    }

    public function createdByMember(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'created_by_member_id', 'id');
    }

    public function formData(): HasMany
    {
        return $this->hasMany(EventFormData::class, 'event_id', 'id');
    }
}
