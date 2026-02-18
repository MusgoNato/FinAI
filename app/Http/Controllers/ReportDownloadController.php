<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportDownloadRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;
use function PHPUnit\Framework\callback;

class ReportDownloadController extends Controller
{
    public function index()
    {
        return Inertia::render('Feat/Reports');
    }

    public function download(ReportDownloadRequest $request)
    {
        //
        $data = $request->validated();

        return match($data['document_type'])
        {
            'pdf' => $this->getPDFDocument($data),
            'excel' => $this->getExcelDocument($data),
            'csv' => $this->getCsvDocument($data),
        };
    }

    private function getPDFDocument(array $data)
    {
        
        // Filtragem pelas transações
        $transactions = auth()->user()->transactions()->when($data['start_date'] ?? null, function ($query, $start_date) {
            return $query->whereDate('date', '>=', $start_date);
        })
        ->when($data['end_date'] ?? null, function ($query, $end_date){
            return $query->whereDate('date', '<=', $end_date);
        })
        ->when($data['category'] ?? null, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->when($data['type'] ?? null, function ($query, $type) {
            return $query->where('type', $type);
        })
        ->when($data['min_amount'] ?? null, function ($query, $min_amount) {
            return $query->where('price', '>=', $min_amount);
        })
        ->when($data['max_amount'] ?? null, function ($query, $max_amount) {
            return $query->where('price', '<=', $max_amount);
        })
        ->when($data['sort_by'] ?? null, function ($query, $sort) {
            return match ($sort){
                'date_asc' => $query->orderBy('date', 'asc'),
                'date_desc' => $query->orderBy('date', 'desc'),
                'amount_asc' => $query->orderBy('price', 'asc'),
                'amount_desc' => $query->orderBy('price', 'desc'),
                default => $query->orderBy('date', 'desc'),
            };
        })
        ->limit(200)
        ->get();


        $total_income = $transactions->where('type', 'Receita')->sum('price');
        $total_expense = $transactions->where('type', 'Despesa')->sum('price');

        $total_balance = round($total_income - $total_expense, 2);

        $pdf = Pdf::loadView('reports.document', ['filters' => $data, 'transactions' => $transactions, 'total_balance' => $total_balance, 'total_income' => $total_income, 'total_expense' => $total_expense]);      
        return $pdf->download('report.pdf');
    }

    private function getExcelDocument(array $data)
    {
        // 
    }

    private function getCsvDocument(array $data)
    {
        // 
    }
}
