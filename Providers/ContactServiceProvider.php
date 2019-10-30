<?php

namespace Modules\Contact\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Contact\Console\FixContactsCommand;
use Modules\Contact\Events\Handlers\RegisterContactSidebar;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Traits\CanPublishConfiguration;

class ContactServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerCommands();
        $this->app['events']->listen(BuildingSidebar::class, RegisterContactSidebar::class);

        $this->app['events']->listen(
            LoadingBackendTranslations::class,
            function (LoadingBackendTranslations $event) {
                $event->load('contacts', array_dot(trans('contact::contacts')));
                $event->load('contactaddresses', array_dot(trans('contact::contactaddresses')));
                // append translations
            }
        );
    }

    public function registerCommands()
    {
        $this->commands([
            FixContactsCommand::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Resources/views' => base_path('resources/views/asgard/contact'),
        ], 'views');

        $this->app['view']->prependNamespace(
            'contact',
            base_path('resources/views/asgard/contact')
        );

        include_once __DIR__.'/../includes/functions.php';

        $this->publishConfig('contact', 'config');
        $this->publishConfig('contact', 'settings');
        $this->publishConfig('contact', 'permissions');
        $this->publishConfig('contact', 'contact-type');
        $this->publishConfig('contact', 'barcode');
        $this->publishConfig('contact', 'user-salutation');
        $this->publishConfig('contact', 'gst_states');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Contact\Repositories\ContactRepository',
            function () {
                $repository = new \Modules\Contact\Repositories\Eloquent\EloquentContactRepository(new \Modules\Contact\Entities\Contact());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Contact\Repositories\Cache\CacheContactDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Contact\Repositories\ContactAddressRepository',
            function () {
                $repository = new \Modules\Contact\Repositories\Eloquent\EloquentContactAddressRepository(new \Modules\Contact\Entities\ContactAddress());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Contact\Repositories\Cache\CacheContactAddressDecorator($repository);
            }
        );
        // add bindings
    }
}
