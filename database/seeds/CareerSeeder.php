<?php

use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('careers')->truncate();

        $careers = [
            ["name" => "PHP"],
            ["name" => "JAVA"],
            ["name" => "JS"],
            ["name" => "C#"],
            ["name" => "C++"],
            ["name" => "REACT"],
            ["name" => "LARAVEL"],
        ];
        foreach ($careers as $item) {
            App\Models\Career::create([
                    'name' => $item['name'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
