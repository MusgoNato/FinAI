<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $lastest_transactions = auth()->user()->transactions()->latest()->take(5)->get();
        return view('dashboard', ['last_transactions' => $lastest_transactions]);
    }
}