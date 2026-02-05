<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'description',
        'category',
        'type',
        'price',
        'date',
        'notes',
    ];

    // QUando o Model User for ser serializado ou convertido em JSON
    // ele adicionará de forma virtual este campo ao JSON e executará o acessor. 
    protected $appends = ['updated_at_formatted', 'date_formatted'];


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

    // Acessores (Realizam a formatação do atributo automaticamente e disponibilizam seu valor)
    public function getUpdatedAtFormattedAttribute()
    {
        // Isto nao vai ser populado dentro de um input tipo date, entao nao existe problema em manter desta forma
        return $this->updated_at?->format('d-m-Y');
    }

    public function getDateFormattedAttribute()
    {
       return $this->asDateTime($this->date)?->format('Y-m-d');
    }
}
