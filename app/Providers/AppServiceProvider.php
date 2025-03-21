<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::preventLazyLoading();

        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });

        //this tells app to use bootstrap instead of tailwind paginator
        // Paginator::useBootstrapFive();
    }
}
