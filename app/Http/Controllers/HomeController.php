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
        $total_by_category = auth()->user()->transactions()->selectRaw("category, SUM(price) as total")
        ->groupBy('category')
        ->pluck('total', 'category')
        ->toArray();


        // Caso não exista nenhuma receita ou despesa, valores 0 serão setados
        $total_by_category = [
            'Receita' => $total_by_category['Receita'] ?? 0,
            'Despesa' => $total_by_category['Despesa'] ?? 0,
        ];

        // Saldo atual
        $total_balance = $total_by_category['Receita'] - $total_by_category['Despesa']; 
        
        return view('dashboard', ['last_transactions' => $lastest_transactions, 'total_by_category' => $total_by_category, 'total_balance' => $total_balance]);
    }
}   