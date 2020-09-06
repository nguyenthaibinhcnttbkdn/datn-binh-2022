<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cities')->truncate();

        $cities = [
            ["name" => "Đà Nẵng"],
            ["name" => "Hà Nội"],
            ["name" => "Tp Hồ Chí Minh"],
            ["name" => "Vũng Tàu"],
            ["name" => "Cần Thơ"],
            ["name" => "Tam Kỳ"],
            ["name" => "Đà Lạt"],
        ];
        foreach ($cities as $item) {
            App\Models\City::create([
                    'name' => $item['name'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
