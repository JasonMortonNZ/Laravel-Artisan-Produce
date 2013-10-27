<?php namespace JasonNZ\Produce;

use Illuminate\Support\ServiceProvider;
use JasonNZ\Produce\Commands\ProduceCommand;
use JasonNZ\Produce\Commands\ProduceAllCommand;
use JasonNZ\Produce\Commands\ProduceModelCommand;
use JasonNZ\Produce\Commands\ProduceControllerCommand;
use JasonNZ\Produce\Commands\ProduceRepositoryCommand;
use JasonNZ\Produce\Commands\ProduceValidatorCommand;
use JasonNZ\Produce\Commands\ProduceMigrationCommand;
use JasonNZ\Produce\Commands\ProduceSeedCommand;
use JasonNZ\Produce\Commands\ProduceTestCommand;
use JasonNZ\Produce\Commands\ProduceComposerCommand;
use JasonNZ\Produce\Commands\ProduceViewCommand;

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
        $this->registerCommands();
        $this->registerGenerators();
        $this->registerArtisanCommands();
    }

    public function registerArtisanCommands()
    {
        $this->registerProduceCommand();
        $this->registerProduceAllCommand();
        $this->registerProduceModelCommand();
        $this->registerProduceControllerCommand();
        $this->registerProduceRepositoryCommand();
        $this->registerProduceValidatorCommand();
        $this->registerProduceTestCommand();
        $this->registerProduceSeedCommand();
        $this->registerProduceMigrationCommand();
        $this->registerProduceComposerCommand();
        $this->registerProduceViewCommand();
    }

    public function registerGenerators()
    {
        $this->registerRepositoryGenerator();
        $this->registerModelGenerator();
        $this->registerMigrationGenerator();
        $this->registerSeedGenerator();
        $this->registerViewGenerator();
        $this->registerControllerGenerator();
        $this->registerComposerGenerator();
        $this->registerValidatorGenerator();
        $this->registerTestGenerator();
    }

    /**
     * Register the 'php artisan produce' command
     *
     * @return ProduceCommand
     */
    public function registerProduceCommand()
    {
        $this->app['produce'] = $this->app->share(function($app) {
            return new ProduceCommand();
        });
    }
    /**
     * Register the 'php artisan produce:all' command
     *
     * @return ProduceAllCommand
     */
    public function registerProduceAllCommand()
    {
        $this->app['produce.all'] = $this->app->share(function($app) {
            return new ProduceAllCommand();
        });
    }

    /**
     * Register the 'php artisan produce:model' command
     *
     * @return ProduceModelCommand
     */
    public function registerProduceModelCommand()
    {
        $this->app['produce.model'] = $this->app->share(function($app) {
            return new ProduceModelCommand();
        });
    }

    /**
     * Register the 'php artisan produce:controller' command
     *
     * @return ProduceControllerCommand
     */
    public function registerProduceControllerCommand()
    {
        $this->app['produce.controller'] = $this->app->share(function($app) {
            return new ProduceControllerCommand();
        });
    }

    /**
     * Register the 'php artisan produce:repository' command
     *
     * @return ProduceRepositoryCommand
     */
    public function registerProduceRepositoryCommand()
    {
        $this->app['produce.repository'] = $this->app->share(function($app) {
            return new ProduceRepositoryCommand();
        });
    }

    /**
     * Register the 'php artisan produce:validator' command
     *
     * @return ProduceValidatorCommand
     */
    public function registerProduceValidatorCommand()
    {
        $this->app['produce.validator'] = $this->app->share(function($app) {
            return new ProduceValidatorCommand();
        });
    }

    /**
     * Register the 'php artisan produce:test' command
     *
     * @return ProduceTestCommand
     */
    public function registerProduceTestCommand()
    {
        $this->app['produce.test'] = $this->app->share(function($app) {
            return new ProduceTestCommand();
        });
    }

    /**
     * Register the 'php artisan produce:seed' command
     *
     * @return ProduceSeedCommand
     */
    public function registerProduceSeedCommand()
    {
        $this->app['produce.seed'] = $this->app->share(function($app) {
            return new ProduceSeedCommand();
        });
    }

    /**
     * Register the 'php artisan produce:migration' command
     *
     * @return ProduceMigrationCommand
     */
    public function registerProduceMigrationCommand()
    {
        $this->app['produce.migration'] = $this->app->share(function($app) {
            return new ProduceMigrationCommand();
        });
    }

    /**
     * Register the 'php artisan produce:composer' command
     *
     * @return ProduceComposerCommand
     */
    public function registerProduceComposerCommand()
    {
        $this->app['produce.composer'] = $this->app->share(function($app) {
            return new ProduceComposerCommand();
        });
    }

    /**
     * Register the 'php artisan produce:view' command
     *
     * @return ProduceViewCommand
     */
    public function registerProduceViewCommand()
    {
        $this->app['produce.view'] = $this->app->share(function($app) {
            return new ProduceViewCommand();
        });
    }

    /**
     * Register the RepositoryGenerator with the IoC
     *
     * @return RepositoryGenerator
     */
    public function registerRepositoryGenerator()
    {
        $this->app['RepositoryGenerator'] = $this->app->share(function($app) {
            return new RepositoryGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the ModelGenerator with the IoC
     *
     * @return ModelGenerator
     */
    public function registerModelGenerator()
    {
        $this->app['ModelGenerator'] = $this->app->share(function($app) {
            return new ModelGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the MigrationGenerator with the IoC
     *
     * @return MigrationGenerator
     */
    public function registerMigrationGenerator()
    {
        $this->app['MigrationGenerator'] = $this->app->share(function($app) {
            return new MigrationGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the SeedGenerator with the IoC
     *
     * @return SeedGenerator
     */
    public function registerSeedGenerator()
    {
        $this->app['SeedGenerator'] = $this->app->share(function($app) {
            return new SeedGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the ViewGenerator with the IoC
     *
     * @return ViewGenerator
     */
    public function registerViewGenerator()
    {
        $this->app['ViewGenerator'] = $this->app->share(function($app) {
            return new ViewGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the Controller Generator with the IoC
     *
     * @return ControllerGenerator
     */
    public function registerControllerGenerator()
    {
        $this->app['ControllerGenerator'] = $this->app->share(function($app) {
            return new ControllerGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the ComposerGenerator (view-composer) with the IoC
     *
     * @return ComposerGenerator
     */
    public function registerComposerGenerator()
    {
        $this->app['ComposerGenerator'] = $this->app->share(function($app) {
            return new ComposerGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the ValidatorGenerator with the IoC
     *
     * @return ValidatorGenerator
     */
    public function registerValidatorGenerator()
    {
        $this->app['ValidatorGenerator'] = $this->app->share(function($app) {
            return new ValidatorGenerator($app['config'], $app['files']);
        });
    }

    /**
     * Register the TestGenerator with the IoC
     *
     * @return TestGenerator
     */
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

    /**
     * Register the produce command
     */
    public function registerCommands()
    {
        $this->commands(
            'produce',
            'produce.all',
            'produce.model',
            'produce.controller',
            'produce.repository',
            'produce.validator',
            'produce.test',
            'produce.seed',
            'produce.migration',
            'produce.composer',
            'produce.view'
        );
    }
}
