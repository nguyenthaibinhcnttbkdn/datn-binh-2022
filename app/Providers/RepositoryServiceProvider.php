<?php


namespace App\Providers;


use App\Repositories\Eloquent\CandidateRepository;
use App\Repositories\Interfaces\CandidateRepositoryInterface;
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
