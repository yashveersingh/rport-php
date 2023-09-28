<?php

namespace yashveersingh\rportPHP\console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use yashveersingh\rportPHP\Events\DeviceStatusChangedEvent;

class PublishResourcesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rport:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install RPort package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Installing RPort Package...');
        $this->info('Publishing configuration file...');
        if (!$this->configExists('rport.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration file');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration file was not overwritten');
            }
        }
        $this->info('Publishing event listener files if not exists...');
        $this->publishEventListeners([
            DeviceStatusChangedEvent::class => ['RPortDeviceStatusChangedListener']
        ]);
        $this->info('Published event listener files');
        $this->call('migrate');
        $this->info('Installed RPort Package');
        return $this::SUCCESS;
    }

    /**
     * @param string $fileName
     * @return bool
     */
    private function configExists(string $fileName): bool
    {
        return File::exists(config_path($fileName));
    }

    /**
     * @return bool
     */
    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    /**
     * @param bool $forcePublish
     * @return void
     */
    private function publishConfiguration(bool $forcePublish = false): void
    {
        $params = [
            '--provider' => 'yashveersingh\rportPHP\ServiceProviders\RPortServiceProvider',
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    /**
     * @param array $files
     * @return void
     */
    private function publishEventListeners(array $files): void
    {
        foreach ($files as $event => $listeners)
            foreach ($listeners as $listener)
                if (!class_exists('App\\Listeners\\' . $listener)) {
                    $this->call('make:listener', [
                        'name' => $listener,
                        '--event' => "\\$event"
                    ]);
                }
    }
}