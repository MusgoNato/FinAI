<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\transactions\CreateTransaction;
use Illuminate\Http\Request;

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
    public function store(CreateTransaction $request)
    {
        //
        $validate = $request->validated();

        if($validate)
        {
            auth()->user()->transactions()->create([
                'description' => $validate['description'],
                'price' => $validate['price'],
                'date' => $validate['date'],
                'notes' => $validate['notes'] ?? null,
            ]);

            return redirect()->route('dashboard')->with(['success' => 'Despesa criada com sucesso']);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
