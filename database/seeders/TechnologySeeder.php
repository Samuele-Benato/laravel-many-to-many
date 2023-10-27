<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["HTML", "CSS", "SQL", "JavaScript", "PHP", "GIT", "Blade", "Bootstrap", "Vue.Js", "Markdown", "Sass"];

        foreach ($labels as $label) {
            $technology = new Technology();
            $technology->label = $label;
            $technology->save();
        }
    }
}