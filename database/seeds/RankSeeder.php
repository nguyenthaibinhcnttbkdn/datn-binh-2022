<?php

use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('ranks')->truncate();

        $ranks = [
            ["name" => "Internship"],
            ["name" => "Fresher"],
            ["name" => "Senior"],
            ["name" => "Junior"],
            ["name" => "Team Leader"],
            ["name" => "Project Manager"],
        ];
        foreach ($ranks as $item) {
            App\Models\Rank::create([
                    'name' => $item['name'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
