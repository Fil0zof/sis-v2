<?php

namespace App\Models\Event;

use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'json_response',
        'event_id',
        'member_id',
    ];

    protected $hidden = [
        'event_id',
        'member_id',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
