<?php


use Illuminate\Database\Seeder;
use App\Models\FAQ;
use App\Models\FaqCategory;
use Illuminate\Support\Str;

class FAQTableSeeder extends Seeder
{
    public function run(\Faker\Generator $faker)
    {
        FAQ::truncate();
        FaqCategory::truncate();

        for ($i = 0; $i < 3; $i++) {
            $item = new FaqCategory([
                'name' => $faker->sentence(2)
            ]);

            $item->slug = Str::slug($item->name);

            $item->save();

            for ($a = 0; $a < $faker->numberBetween(3, 8); $a++) {
                $item->faqs()->create([
                    'question' => $faker->sentence(8),
                    'answer'   => $faker->paragraph(3),
                ]);
            }
        }
    }
}