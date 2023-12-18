<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Log;
use App\Models\Operation;
use App\Models\Guide;
use App\Models\GuideFiles;
use App\Models\Table;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guides = Guide::factory()
            ->count(10)
            ->sequence(fn($sequence) => [
                'title' => 'Инструкция ' . ($sequence->index + 1)
            ])
            ->create()
            ->each(function ($guide) {
                $chaptersCount = rand(3, 5);
                for ($i = 1; $i <= $chaptersCount; $i++) {
                    $text = fake()->realText(1000);
                    Chapter::create([
                        'guide_id' => $guide->id,
                        'title' => 'Раздел ' . $i,
                        'text_html' => $text,
                        'text' => $text,
                        'sort' => $i
                    ]);
                }
            });

        Table::create(['title' => 'Инструкции', 'table' => 'guides']);

        $operationTitles = ['Добавление', 'Редактирование', 'Скрытие', 'Удаление', 'Утверждение'];

        $operationsGuides = Operation::factory()
            ->count(count($operationTitles))
            ->sequence(fn($sequence) => [
                'title' => $operationTitles[$sequence->index],
                'table_id' => 1
            ])
            ->create();

        for ($i = 1; $i <= 10; $i++) {
            $name = '11_01_2023 15_15_00.html';
            GuideFiles::create([
                'guide_id' => $i,
                'name' => $name,
                'path' => '/storage/guides/' . $i . '/' . $name
            ]);
        }

        Log::create([
            'operation_id' => $operationsGuides->random()->id,
            'text' => fake()->sentence(),
            'uid' => rand(1, 1000),
            'itemable_id' => $guides->random()->id,
            'itemable_type' => 'App\Models\Guide'
        ]);
    }
}
