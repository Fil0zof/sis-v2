<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class LegalRepresentative extends AddressModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address_id',
    ];

}
