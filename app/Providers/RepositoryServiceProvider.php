<?php

namespace App\Providers;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Repositories\FeedbackRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositoryList = [
        FeedbackRepositoryInterface::class => FeedbackRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositoryList as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
