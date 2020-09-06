<?php


namespace App\Providers;


use App\Repositories\Eloquent\CandidateRepository;
use App\Repositories\Eloquent\EmployerRepository;
use App\Repositories\Eloquent\RecruitmentRepository;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
use App\Repositories\Interfaces\EmployerRepositoryInterface;
use App\Repositories\Interfaces\RecruitmentRepositoryInterface;
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
