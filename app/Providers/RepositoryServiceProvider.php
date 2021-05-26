<?php


namespace App\Providers;


use App\Repositories\Eloquent\CandidateRepository;
use App\Repositories\Eloquent\EmployerRepository;
use App\Repositories\Eloquent\RecruitmentRepository;
use App\Repositories\Eloquent\RankRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\CareerRepository;
use App\Repositories\Eloquent\SalaryRepository;
use App\Repositories\Eloquent\TypeOfWorkRepository;
use App\Repositories\Eloquent\CurriculumVitaeRepository;
use App\Repositories\Eloquent\CandidateRecruitmentRepository;
use App\Repositories\Eloquent\CvrecruitmentRepository;
use App\Repositories\Eloquent\EmployerCvRepository;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CareerRepositoryInterface;
use App\Repositories\Interfaces\SalaryRepositoryInterface;
use App\Repositories\Interfaces\TypeOfWorkRepositoryInterface;
use App\Repositories\Interfaces\CurriculumVitaeRepositoryInterface;
use App\Repositories\Interfaces\CandidateRecruitmentRepositoryInterface;
use App\Repositories\Interfaces\CvrecruitmentRepositoryInterface;
use App\Repositories\Interfaces\EmployerCvRepositoryInterface;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CandidateRepositoryInterface::class, CandidateRepository::class);
        $this->app->bind(EmployerRepositoryInterface::class, EmployerRepository::class);
        $this->app->bind(RecruitmentRepositoryInterface::class, RecruitmentRepository::class);
        $this->app->bind(RankRepositoryInterface::class, RankRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CareerRepositoryInterface::class, CareerRepository::class);
        $this->app->bind(SalaryRepositoryInterface::class, SalaryRepository::class);
        $this->app->bind(TypeOfWorkRepositoryInterface::class, TypeOfWorkRepository::class);
        $this->app->bind(CurriculumVitaeRepositoryInterface::class, CurriculumVitaeRepository::class);
        $this->app->bind(CandidateRecruitmentRepositoryInterface::class, CandidateRecruitmentRepository::class);
        $this->app->bind(CvrecruitmentRepositoryInterface::class, CvrecruitmentRepository::class);
        $this->app->bind(EmployerCvRepositoryInterface::class, EmployerCvRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
