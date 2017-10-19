<?php

namespace CodePub\Providers;

use CodePub\Repositories\CategoryRepository;
use CodePub\Repositories\CategoryRepositoryEloquent;
use CodePub\Repositories\UserRepository;
use CodePub\Repositories\UserRepositoryEloquent;
use CodePub\Repositories\BookRepositoryEloquent;
use CodePub\Repositories\BookRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
           $this->app->bind(BookRepository::class, BookRepositoryEloquent::class);
            $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        }
        //
    }


}
