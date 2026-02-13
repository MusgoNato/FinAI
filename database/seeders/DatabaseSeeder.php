<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Database\Factories\TransactionFactory;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => now(),
        ]);

        User::factory(100)
            ->hasTransactions(1000)
            ->create();

        Transaction::factory()
            ->count(1000)
            ->for($user)
            ->create();
        }
}
