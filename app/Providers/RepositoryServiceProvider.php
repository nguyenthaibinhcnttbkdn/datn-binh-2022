<?php


namespace App\Providers;


use App\Repositories\Eloquent\CandidateRepository;
use App\Repositories\Eloquent\EmployerRepository;
use App\Repositories\Eloquent\RecruitmentRepository;
use App\Repositories\Eloquent\RankRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
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
