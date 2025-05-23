<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'meja';

    protected $fillable = [
        'no_meja',
        'status',
    ];

    protected $hidden = [];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_meja', 'id');
    }
}
