<?php

use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('salaries')->truncate();

        $salaries = [
            ["name" => "Thương lượng"],
            ["name" => "1-3 Triệu"],
            ["name" => "3-5 Triệu"],
            ["name" => "5-7 Triệu"],
            ["name" => "7-10 Triệu"],
            ["name" => "10-12 Triệu"],
            ["name" => "12-15 Triệu"],
            ["name" => "15-20 Triệu"],
            ["name" => "20-25 Triệu"],
            ["name" => "25-30 Triệu"],
            ["name" => "Trên 30 Triệu"],
        ];
        foreach ($salaries as $item) {
            App\Models\Salary::create([
                    'name' => $item['name'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
