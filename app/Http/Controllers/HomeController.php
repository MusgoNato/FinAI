<?php

namespace App\Http\Controllers;

use App\Http\Controllers\services\ApiGroqCloudService;
use Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function __invoke(ApiGroqCloudService $ai)
    {
        $user_id = auth()->id();

        $data = Cache::remember("dashboard_data_{$user_id}", now()->addHours(6), function () use ($ai) {
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
            $total_balance = round($total_by_type['Receita'] - $total_by_type['Despesa'], 2);

            $context = [
                'saldo_atual' => $total_balance,
                'total_receita' => $total_by_type['Receita'],
                'total_despesa' => $total_by_type['Despesa'],
                'ultimas_transacoes' => $lastest_transactions->map(fn($t) => [
                    'tipo' => $t->type,
                    'valor' => $t->price,
                    'descricao' => $t->description,
                    'data' => $t->created_at->format('Y-m-d')
                ])
            ];
        
            return [
            'last_transactions' => $lastest_transactions,
            'total_by_type' => $total_by_type,
            'total_balance' => $total_balance,
            'ai_insight' => $ai->getInsight(json_encode($context)) ?? null,
            ]; 
        });
        
        return Inertia::render('Dashboard', $data);
    }
}   