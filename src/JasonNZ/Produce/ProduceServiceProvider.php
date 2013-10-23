<?php namespace JasonNZ\Produce;

use Illuminate\Support\ServiceProvider;
use JasonNZ\Produce\Commands\ProduceCommand;

class ProduceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jason-nz/produce');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProduceCommand();
        $this->registerRepositoryGenerator();
        $this->registerModelGenerator();
        $this->registerMigrationGenerator();
        $this->registerSeedGenerator();
        $this->registerViewGenerator();
        $this->registerControllerGenerator();
        $this->registerComposerGenerator();
        $this->registerValidatorGenerator();
        $this->registerTestGenerator();
        $this->registerCommands();
    }

    public function registerProduceCommand()
    {
        $this->app['produce'] = $this->app->share(function($app) {
            return new ProduceCommand();
        });
    }

    public function registerRepositoryGenerator()
    {
        $this->app['RepositoryGenerator'] = $this->app->share(function($app) {
            return new RepositoryGenerator($app['config'], $app['files']);
        });
    }

    public function registerModelGenerator()
    {
        $this->app['ModelGenerator'] = $this->app->share(function($app) {
            return new ModelGenerator($app['config'], $app['files']);
        });
    }

    public function registerMigrationGenerator()
    {
        $this->app['MigrationGenerator'] = $this->app->share(function($app) {
            return new MigrationGenerator($app['config'], $app['files']);
        });
    }

    public function registerSeedGenerator()
    {
        $this->app['SeedGenerator'] = $this->app->share(function($app) {
            return new SeedGenerator($app['config'], $app['files']);
        });
    }

    public function registerViewGenerator()
    {
        $this->app['ViewGenerator'] = $this->app->share(function($app) {
            return new ViewGenerator($app['config'], $app['files']);
        });
    }

    public function registerControllerGenerator()
    {
        $this->app['ControllerGenerator'] = $this->app->share(function($app) {
            return new ControllerGenerator($app['config'], $app['files']);
        });
    }

    public function registerComposerGenerator()
    {
        $this->app['ComposerGenerator'] = $this->app->share(function($app) {
            return new ComposerGenerator($app['config'], $app['files']);
        });
    }

    public function registerValidatorGenerator()
    {
        $this->app['ValidatorGenerator'] = $this->app->share(function($app) {
            return new ValidatorGenerator($app['config'], $app['files']);
        });
    }

    public function registerTestGenerator()
    {
        $this->app['TestGenerator'] = $this->app->share(function($app) {
            return new TestGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    public function registerCommands()
    {
        $this->commands(
            'produce'
        );
    }
}
