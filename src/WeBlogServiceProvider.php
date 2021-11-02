<?php

namespace Nowyouwerkn\WeBlog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator; 
use Illuminate\Pagination\LengthAwarePaginator;

class WeBlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Nowyouwerkn\WeBlog\Controllers\CategoryController');
        $this->app->make('Nowyouwerkn\WeBlog\Controllers\FrontController');
        $this->app->make('Nowyouwerkn\WeBlog\Controllers\PostController');
        $this->app->make('Nowyouwerkn\WeBlog\Controllers\PostCommentController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        // Utilizar estilos de Bootstrap en la paginación
        Paginator::useBootstrap();

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'weblog');

        // Primera ruta es de donde viene el recurso a publicar y la segunda ruta en que parte se instalará.
        $this->publishes([
            __DIR__.'/resources/views/front/werkn-backbone-bootstrap' => resource_path('views/front/theme/'),
        ], 'werkn-theme');

        // Publicar archivos de base de datos
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations/'),
        ], 'migration_files');
    }
}
