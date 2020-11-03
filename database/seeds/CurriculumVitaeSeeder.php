<?php

use Illuminate\Database\Seeder;

class CurriculumVitaeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('curriculumvitaes')->truncate();

        $curriculumvitaes = [
            ["title" => 1, "avatar" => 1, "object" => 1, "candidate_id" => 1],
            ["title" => 2, "avatar" => 2, "object" => 2, "candidate_id" => 1],
            ["title" => 3, "avatar" => 3, "object" => 3, "candidate_id" => 1],
            ["title" => 4, "avatar" => 4, "object" => 4, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 5, "avatar" => 5, "object" => 5, "candidate_id" => 1],
            ["title" => 6, "avatar" => 6, "object" => 6, "candidate_id" => 2],


        ];
        foreach ($curriculumvitaes as $item) {
            App\Models\Curriculumvitae::create([
                    'title'        => $item['title'],
                    'avatar'       => $item['avatar'],
                    'object'       => $item['object'],
                    'candidate_id' => $item['candidate_id'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
