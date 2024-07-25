<?php

namespace App\Console\Commands;

use App\Api\Frontend\FrontendVersion;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Used to execute frontend actions.
 */
class FrontendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:frontend {action=help}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handles frontend actions.';

    /**
     * Handles command.
     *
     * @return void
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): void
    {
        $action = $this->argument('action');
        $action = Str::trim($action);
        $action = Str::lower($action);

        switch ($action){
            case 'inc-all': $this->onIncrementAll(); break;
            case 'info': $this->onInfo(); break;
            default: $this->onHelp();
        }
    }

    /**
     * Prints help info.
     */
    private function onHelp(): void
    {
        $this->info('Available actions:');
        $help = [
            [
                'i',
                'Increment version.'
            ],
            [
                'all',
                'Get all version info.'
            ],
        ];
        $this->output->table([
            'id',
            'description'
        ],$help);
    }

    /**
     * Increments all frontend versions.
     *
     * @return void
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function onIncrementAll(): void
    {
        $version = $this->getFrontendVersion();
        $affected = $version->incVersions();
        $version->save();

        $this->output->success("Increased {$affected} versions.");
        $this->onInfo();
    }


    /**
     * Prints versions info.
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function onInfo(): void
    {
        $version =  $this->getFrontendVersion();
        $this->output->table([
            'script type', 'id', 'version'
        ], $version->getVersionsInfo());
    }

    /**
     * Retrieves frontend version service.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getFrontendVersion(): FrontendVersion {
        return app()->get('frontend_version');
    }
}
