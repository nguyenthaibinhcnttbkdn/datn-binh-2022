<?php

use Illuminate\Database\Seeder;

class EmployerCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('employer_candidates')->truncate();

        $employer_candidates = [
            ["candidate_id" => 1, "employer_id" => 1],
            ["candidate_id" => 2, "employer_id" => 1],
            ["candidate_id" => 3, "employer_id" => 1],
            ["candidate_id" => 4, "employer_id" => 1],
            ["candidate_id" => 5, "employer_id" => 1],
            ["candidate_id" => 6, "employer_id" => 1],
            ["candidate_id" => 7, "employer_id" => 1],
            ["candidate_id" => 8, "employer_id" => 1],
            ["candidate_id" => 9, "employer_id" => 1],
            ["candidate_id" => 10, "employer_id" => 1],
            ["candidate_id" => 11, "employer_id" => 1],
            ["candidate_id" => 12, "employer_id" => 1],
            ["candidate_id" => 13, "employer_id" => 1],
            ["candidate_id" => 14, "employer_id" => 1],
            ["candidate_id" => 15, "employer_id" => 1],
            ["candidate_id" => 16, "employer_id" => 1],
            ["candidate_id" => 17, "employer_id" => 1],
            ["candidate_id" => 18, "employer_id" => 1],
            ["candidate_id" => 19, "employer_id" => 1],
            ["candidate_id" => 20, "employer_id" => 1],
        ];
        foreach ($employer_candidates as $item) {
            App\Models\EmployerCandidate::create([
                    'candidate_id' => $item['candidate_id'],
                    'employer_id'  => $item['employer_id'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
