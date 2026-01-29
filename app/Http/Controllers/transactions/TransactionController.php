<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\transactions\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        //
        $validate = $request->validated();

        if($validate)
        {
            auth()->user()->transactions()->create([
                'description' => $validate['description'],
                'category' => $validate['category'],
                'price' => $validate['price'],
                'date' => $validate['date'],
                'notes' => $validate['notes'] ?? null,
            ]);

            return redirect()->route('dashboard')->with(['success' => 'Transação criada com sucesso']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // Como ja estou passando via parametro o model Transaction, nao eh necessario o FindOrFail para busca do formulario,
        // o mesmo ja sera carregado pelo Laravel dessa forma, basta passar de forma direto o proprio Model para a view edit
        return view('transactions.edit', ['transaction_info' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        //
        $transaction->update($request->validated());

        return redirect()->route('dashboard')->with(['success' => 'Transação atualizada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
        $transaction->delete();

        return back()->with(['success' => 'Transação deletada com sucesso']);
    }
}
