<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck('id');
        $types[] = null;


        for ($i = 0; $i < 50; $i++) {
            $type_id = $faker->randomElement($types);

            $project = new Project;
            $project->type_id = $type_id;
            $project->title = $faker->firstNameMale();
            $project->description = $faker->paragraph(8);
            $project->image = "https://picsum.photos/300/200";
            $project->save();
        }
    }
}