<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFormData extends Model
{
    use HasFactory;

    public static array $dataTypes = ['text', 'date', 'dropdown', 'radio_button', 'checkbox'];

    protected $fillable = [
        'title',
        'data_type',
        'event_id'
    ];

    protected $hidden = [
        'event_id',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

}
