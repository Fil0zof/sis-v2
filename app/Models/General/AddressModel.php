<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

abstract class AddressModel extends Model
{
    use HasFactory;

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, "id", "address_id");
    }
}
