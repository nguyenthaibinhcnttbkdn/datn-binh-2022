<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SalarySeeder::class);
        $this->call(TypeOfWorkSeeder::class);
        $this->call(EmployerSeeder::class);
        $this->call(CandidateSeeder::class);
        $this->call(RecruitmentSeeder::class);
        $this->call(CandidateRecruitmentSeeder::class);
        $this->call(EmployerCandidateSeeder::class);
        $this->call(CurriculumVitaeSeeder::class);
        $this->call(CvRecruitmentSeeder::class);
    }
}
