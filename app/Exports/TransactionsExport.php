<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        return $this->transactions->map(function ($transaction) {
            return [
                'Date' => $transaction->date,
                'Type' => $transaction->type,
                'Category' => $transaction->category,
                'Amount' => $transaction->price,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Type',
            'Category',
            'Amount',
        ];
    }
}