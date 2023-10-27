<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();
        $tecnologies = Technology::all()->pluck('id')->toArray();

        foreach ($projects as $project) {
            $project
                ->tecnologies()
                ->attach($faker->randomElements($tecnologies, random_int(0, 3)));
        }
    }
}