<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FinanceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            // Incomes
            ['name' => 'مساهمات الانخراطات', 'type' => 'income'],
            ['name' => 'مساهمات طبية (حصص الشبه طبي)', 'type' => 'income'],
            ['name' => 'مساهمات المحسنين', 'type' => 'income'],
            ['name' => 'أخرى', 'type' => 'income'],
            
            // Expenses
            ['name' => 'أجور الأخصائيات والموظفين', 'type' => 'expense'],
            ['name' => 'مصاريف التكوين', 'type' => 'expense'],
            ['name' => 'مصاريف التسيير والإدارة', 'type' => 'expense'],
            ['name' => 'تجهيز المقر واللوجستيك والنظافة', 'type' => 'expense'],
            ['name' => 'مصاريف مختلفة', 'type' => 'expense'],
        ];

        foreach ($categories as $category) {
            \App\FinanceCategory::updateOrCreate(
                ['name' => $category['name'], 'type' => $category['type']],
                $category
            );
        }
    }
}
