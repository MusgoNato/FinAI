<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'description',
        'category',
        'price',
        'date',
        'notes',
    ];


    // Sem isto o Larvel pode tratar o valor como float, contendo imprecisão binária
    // Garantia de receber sempre uma string, respeitando 2 casas decimais
    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
