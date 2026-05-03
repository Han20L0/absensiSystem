<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    protected $fillable = [
        'presence_id',
        'nama',
        'nip',
        'no_hp',
        'asal_instansi',
        'jabatan',
        'email',
        'tanda_tangan'
    ];
}
