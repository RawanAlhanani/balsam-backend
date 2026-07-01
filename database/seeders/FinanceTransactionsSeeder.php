<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinanceTransactionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('finance_transactions')->insert([
            [
                'type' => 'income',
                'category' => 'Donation',
                'amount' => 5000.00,
                'description' => 'Annual donation from benevolent individual Mr. A. Smith',
                'date' => Carbon::parse('2023-09-01'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'expense',
                'category' => 'Office Supplies',
                'amount' => 150.75,
                'description' => 'Purchase of printer ink, paper, and pens for office use',
                'date' => Carbon::parse('2023-09-05'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'income',
                'category' => 'Membership Fees',
                'amount' => 1200.00,
                'description' => 'Quarterly membership fees collected from 12 members',
                'date' => Carbon::parse('2023-10-01'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'expense',
                'category' => 'Event Costs',
                'amount' => 850.00,
                'description' => 'Catering and venue rental for "Sensory Play Day" event',
                'date' => Carbon::parse('2023-10-20'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'income',
                'category' => 'Grant Funding',
                'amount' => 10000.00,
                'description' => 'Grant received from local government for autism awareness program',
                'date' => Carbon::parse('2023-11-10'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'expense',
                'category' => 'Salaries',
                'amount' => 3500.00,
                'description' => 'Monthly salary payment for two full-time staff members',
                'date' => Carbon::parse('2023-11-30'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // New data for 2026
            [
                'type' => 'income',
                'category' => 'Donation',
                'amount' => 7500.00,
                'description' => 'Large donation from corporate sponsor for 2026 initiatives',
                'date' => Carbon::parse('2026-01-15'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'expense',
                'category' => 'Rent',
                'amount' => 1500.00,
                'description' => 'Monthly office rent for January 2026',
                'date' => Carbon::parse('2026-01-01'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'income',
                'category' => 'Fundraising Event',
                'amount' => 3000.00,
                'description' => 'Proceeds from the annual charity gala in February 2026',
                'date' => Carbon::parse('2026-02-20'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'expense',
                'category' => 'Utilities',
                'amount' => 250.00,
                'description' => 'Electricity and water bill for February 2026',
                'date' => Carbon::parse('2026-02-28'),
                'tuteur_id' => null,
                'enfant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
