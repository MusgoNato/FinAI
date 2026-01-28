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
        ->pluck('total', 'category');
        
        return view('dashboard', ['last_transactions' => $lastest_transactions, 'total_by_category' => $total_by_category]);
    }
}