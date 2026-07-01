<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('finance_categories')->insert([
            ['id' => 1, 'name' => 'مساهمات الانخراطات', 'type' => 'income', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 2, 'name' => 'مساهمات طبية (حصص الشبه طبي)', 'type' => 'income', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 3, 'name' => 'مساهمات المحسنين', 'type' => 'income', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 4, 'name' => 'أخرى', 'type' => 'income', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 5, 'name' => 'أجور الأخصائيات والموظفين', 'type' => 'expense', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 6, 'name' => 'مصاريف التكوين', 'type' => 'expense', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 7, 'name' => 'مصاريف التسيير والإدارة', 'type' => 'expense', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 8, 'name' => 'تجهيز المقر واللوجستيك والنظافة', 'type' => 'expense', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
            ['id' => 9, 'name' => 'مصاريف مختلفة', 'type' => 'expense', 'created_at' => '2026-06-06 09:50:26', 'updated_at' => '2026-06-06 09:50:26'],
        ]);
    }
}
