<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();

        $users = [
            ["email" => "employer1@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer2@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer3@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer4@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer5@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer6@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer7@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer8@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer9@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer10@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer11@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer12@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer13@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer14@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer15@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer16@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer17@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer18@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer19@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer20@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer21@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer22@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer23@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer24@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer25@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer26@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer27@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer28@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer29@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "employer30@gmail.com", "password" => bcrypt("12345678"), "role" => 2],
            ["email" => "candidate1@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate2@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate3@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate4@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate5@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate6@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate7@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate8@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate9@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate10@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate11@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate12@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate13@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate14@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate15@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate16@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate17@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate18@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate19@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate20@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate21@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate22@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate23@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate24@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate25@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate26@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate27@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate28@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate29@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "candidate30@gmail.com", "password" => bcrypt("12345678"), "role" => 3],
            ["email" => "admin@gmail.com", "password" => bcrypt("12345678"), "role" => 1],
        ];
        foreach ($users as $item) {
            App\Models\User::create([
                    'email'    => $item['email'],
                    'password' => $item['password'],
                    'role'     => $item['role'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
