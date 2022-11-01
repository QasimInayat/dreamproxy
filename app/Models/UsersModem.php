<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModem extends Model
{
    use HasFactory;
    protected $table = 'users_modem';

    function modem() {
        return $this->hasOne(Modem::class, 'id', 'modem_id');
    }
}
