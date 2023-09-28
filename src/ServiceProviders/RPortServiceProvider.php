<?php

namespace yashveersingh\rportPHP\ServiceProviders;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;
use yashveersingh\rportPHP\console\PublishResourcesCommand;
use yashveersingh\rportPHP\console\SyncDeviceStatusCommand;
use yashveersingh\rportPHP\Events\DeviceStatusChangedEvent;
use yashveersingh\rportPHP\Facades\RPortConfig;

class RPortServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerResources();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->scheduleCommands();
        }
        $this->registerResources2();
        $this->registerEvents();
    }

    /**
     * @return void
     */
    private function registerResources(): void
    {
        $this->registerFacades();
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
            $this->commands([
                PublishResourcesCommand::class,
                SyncDeviceStatusCommand::class
            ]);
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('rport.php'),
            ], 'config');
        }
    }

    /**
     * @return void
     */
    protected function registerResources2(): void
    {
        $this->app->bind('RPortRequest', function ($app) {
            return new \yashveersingh\rportPHP\Requests\Request(RPortConfig::url()->get(), RPortConfig::username()->get(), RPortConfig::token()->get());
        });
    }

    /**
     * @return void
     */
    private function registerFacades(): void
    {
        $this->app->bind('RPort', function ($app) {
            return new \yashveersingh\rportPHP\RPort();
        });
        $this->app->bind('RPortConfig', function ($app) {
            return new \yashveersingh\rportPHP\Helpers\Config\Config();
        });
    }

    /**
     * @return void
     */
    protected function scheduleCommands(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('rport:sync')->everyMinute();
        });
    }

    /**
     * @return void
     */
    private function registerEvents(): void
    {
        $classNames = [
            'RPortDeviceStatusChangedListener'
        ];
        foreach ($classNames as $className) {
            if (!class_exists('App\\Listeners\\' . $className))
                continue;
            try {
                $class = new ReflectionClass('App\\Listeners\\' . $className);
                Event::listen(
                    DeviceStatusChangedEvent::class,
                    $class->getName()
                );
            } catch (\ReflectionException $e) {
                continue;
            }
        }
    }
}