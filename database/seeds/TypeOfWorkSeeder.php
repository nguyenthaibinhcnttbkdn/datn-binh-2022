<?php

use Illuminate\Database\Seeder;

class TypeOfWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('type_of_works')->truncate();

        $type_of_works = [
            ["name" => "Bán thời gian"],
            ["name" => "Dài hạn"],
            ["name" => "Hợp đồng"],
            ["name" => "Không cố định"],
            ["name" => "Tạm thời"],
            ["name" => "Thực tập sinh"],
            ["name" => "Thời gian cố định"],
        ];
        foreach ($type_of_works as $item) {
            App\Models\TypeOfWork::create([
                    'name' => $item['name'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
