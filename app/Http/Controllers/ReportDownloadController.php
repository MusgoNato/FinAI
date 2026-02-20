<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Http\Requests\ReportDownloadRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ReportDownloadController extends Controller
{
    public function index()
    {
        return Inertia::render('Feat/Reports');
    }

    /**
     * Summary of download
     * @param ReportDownloadRequest $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
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

    /**
     * Summary of getPDFDocument
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    private function getPDFDocument(array $data)
    {
        
        // Filtragem pelas transações
        $transactions = $this->getQueryData($data);


        $total_income = $transactions->where('type', 'Receita')->sum('price');
        $total_expense = $transactions->where('type', 'Despesa')->sum('price');

        $total_balance = round($total_income - $total_expense, 2);

        $pdf = Pdf::loadView('reports.document', ['filters' => $data, 'transactions' => $transactions, 'total_balance' => $total_balance, 'total_income' => $total_income, 'total_expense' => $total_expense]);      
        return $pdf->download('report.pdf');
    }

    /**
     * Summary of getExcelDocument
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    private function getExcelDocument(array $data)
    {
        // 
        $transactions = $this->getQueryData($data);
        return Excel::download(new TransactionsExport($transactions), 'report.xlsx');
    }

    /**
     * Summary of getCsvDocument
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    private function getCsvDocument(array $data)
    {
        //
        $transactions = $this->getQueryData($data);
        return Excel::download(new TransactionsExport($transactions), 'report.csv');
 
    }

    /**
     * Summary of getQueryData
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction>
     */
    private function getQueryData(array $data)
    {
        $query = auth()->user()->transactions();

        $query->when($data['start_date'] ?? null, fn ($q, $date) =>
            $q->whereDate('date', '>=', $date)
        );

        $query->when($data['end_date'] ?? null, fn ($q, $date) =>
            $q->whereDate('date', '<=', $date)
        );

        $query->when($data['category'] ?? null, fn ($q, $category) =>
            $q->where('category', $category)
        );

        $query->when($data['type'] ?? null, fn ($q, $type) =>
            $q->where('type', $type)
        );

        $query->when($data['account_id'] ?? null, fn ($q, $account) =>
            $q->where('account_id', $account)
        );

        $query->when($data['status'] ?? null, fn ($q, $status) =>
            $q->where('status', $status)
        );

        $query->when($data['min_amount'] ?? null, fn ($q, $min) =>
            $q->where('price', '>=', $min)
        );

        $query->when($data['max_amount'] ?? null, fn ($q, $max) =>
            $q->where('price', '<=', $max)
        );

        match ($data['sort_by'] ?? 'date_desc') {
            'date_asc' => $query->orderBy('date', 'asc'),
            'date_desc' => $query->orderBy('date', 'desc'),
            'amount_asc' => $query->orderBy('price', 'asc'),
            'amount_desc' => $query->orderBy('price', 'desc'),
        };

        return $query->limit(200)->get();
    }
}
