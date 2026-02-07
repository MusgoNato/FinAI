<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        // Extrai as ultimas transações realizadas pelo usuario
        $lastest_transactions = auth()->user()->transactions()->latest()->take(5)->get();
        
        // Extrai o total dos tipos de transações realizadas pelo usuario
        $total_by_type = auth()->user()->transactions()->selectRaw("type, SUM(price) as total")
        ->groupBy('type')
        ->pluck('total', 'type')
        ->toArray();



        // Caso não exista nenhuma receita ou despesa, valores 0 serão setados
        $total_by_type = [
            'Receita' => $total_by_type['Receita'] ?? 0,
            'Despesa' => $total_by_type['Despesa'] ?? 0,
        ];

        // Saldo atual
        $total_balance = $total_by_type['Receita'] - $total_by_type['Despesa'];

        // TODO: Criar um helper do tipo money com regex para formatar corretamente o numero e devolver ele com as casas decimais corretas

        return Inertia::render('Dashboard', ['last_transactions' => $lastest_transactions, 'total_by_type' => $total_by_type, 'total_balance' => $total_balance]); 
    }
}   