<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    public $table = 'billing';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function province(){
        return $this->hasOne(Province::class, 'id', 'province_id');
    }
}
