<?php

namespace App\Providers;

use App\Api\Frontend\FrontendVersion;
use App\Api\Frontend\PreloadedState;
use App\Repositories\RepositoryManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Main service provider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            // Provider will be absent on production no need to replace with import.
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Directive to rotate frontend versions.
        Blade::directive('front_version', function ($expression) {
            return "<?php echo app('frontend_version')->getQueryString($expression); ?>";
        });
    }

    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        'frontend_version' => FrontendVersion::class,
        'preloaded_state' => PreloadedState::class,
        'repository.manager' => RepositoryManager::class,
    ];
}
