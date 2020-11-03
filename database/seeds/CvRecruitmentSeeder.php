<?php

use Illuminate\Database\Seeder;

class CvRecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cvrecruitments')->truncate();

        $cvrecruitments = [
            ["cv_id" => 1, "recruitment_id" => 1],
            ["cv_id" => 2, "recruitment_id" => 2],
            ["cv_id" => 3, "recruitment_id" => 3],
            ["cv_id" => 4, "recruitment_id" => 4],
            ["cv_id" => 5, "recruitment_id" => 5],
            ["cv_id" => 6, "recruitment_id" => 6],
            ["cv_id" => 7, "recruitment_id" => 7],
            ["cv_id" => 8, "recruitment_id" => 8],
            ["cv_id" => 9, "recruitment_id" => 9],
            ["cv_id" => 10, "recruitment_id" => 10],
            ["cv_id" => 11, "recruitment_id" => 11],
        ];
        foreach ($cvrecruitments as $item) {
            App\Models\Cvrecruitment::create([
                    'cv_id'          => $item['cv_id'],
                    'recruitment_id' => $item['recruitment_id'],
                ]
            );
        }
        Schema::enableForeignKeyConstraints();
    }
}
