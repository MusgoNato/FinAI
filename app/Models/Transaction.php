<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'description',
        'price',
        'notes',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
