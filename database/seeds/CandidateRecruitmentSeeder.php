<?php

use Illuminate\Database\Seeder;

class CandidateRecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('candidate_recruitments')->truncate();

        $candidate_recruitments = [
            ["candidate_id" => 1, "recruitment_id" => 1],
            ["candidate_id" => 1, "recruitment_id" => 2],
            ["candidate_id" => 1, "recruitment_id" => 3],
            ["candidate_id" => 1, "recruitment_id" => 4],
            ["candidate_id" => 1, "recruitment_id" => 5],
            ["candidate_id" => 1, "recruitment_id" => 6],
            ["candidate_id" => 1, "recruitment_id" => 7],
            ["candidate_id" => 1, "recruitment_id" => 8],
            ["candidate_id" => 1, "recruitment_id" => 9],
            ["candidate_id" => 1, "recruitment_id" => 10],
            ["candidate_id" => 1, "recruitment_id" => 11],
            ["candidate_id" => 1, "recruitment_id" => 12],
            ["candidate_id" => 1, "recruitment_id" => 13],
            ["candidate_id" => 1, "recruitment_id" => 14],
            ["candidate_id" => 1, "recruitment_id" => 15],
            ["candidate_id" => 1, "recruitment_id" => 16],
            ["candidate_id" => 2, "recruitment_id" => 2],
            ["candidate_id" => 3, "recruitment_id" => 3],
            ["candidate_id" => 4, "recruitment_id" => 4],
            ["candidate_id" => 5, "recruitment_id" => 5],
            ["candidate_id" => 6, "recruitment_id" => 6],
            ["candidate_id" => 7, "recruitment_id" => 7],
            ["candidate_id" => 8, "recruitment_id" => 8],
            ["candidate_id" => 9, "recruitment_id" => 9],
            ["candidate_id" => 10, "recruitment_id" => 10],
            ["candidate_id" => 11, "recruitment_id" => 11],
            ["candidate_id" => 12, "recruitment_id" => 12],
            ["candidate_id" => 13, "recruitment_id" => 13],
            ["candidate_id" => 14, "recruitment_id" => 14],
            ["candidate_id" => 15, "recruitment_id" => 15],
            ["candidate_id" => 16, "recruitment_id" => 16],
            ["candidate_id" => 17, "recruitment_id" => 17],
            ["candidate_id" => 18, "recruitment_id" => 18],
            ["candidate_id" => 19, "recruitment_id" => 19],
            ["candidate_id" => 20, "recruitment_id" => 20],

        ];
        foreach ($candidate_recruitments as $item) {
            App\Models\CandidateRecruitment::create([
                    'candidate_id'   => $item['candidate_id'],
                    'recruitment_id' => $item['recruitment_id'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
