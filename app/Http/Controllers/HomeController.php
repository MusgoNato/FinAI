<?php

namespace App\Http\Controllers;

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
        
        return view('dashboard', ['last_transactions' => $lastest_transactions, 'total_by_type' => $total_by_type, 'total_balance' => $total_balance]);
    }
}   