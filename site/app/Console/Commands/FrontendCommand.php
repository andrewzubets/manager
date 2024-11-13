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
     * Action list.
     */
    protected array $actions = [
        'inc-all' => [
            'method' => 'onIncrementAll',
            'description' => 'Increment version.',
        ],
        'info' => [
            'method' => 'onInfo',
            'description' => 'Get all version info.',
        ],
        'help' => [
            'method' => 'onHelp',
            'description' => 'Lists all available actions.',
        ],
    ];

    /**
     * Handles command.
     *
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): void
    {
        $action = $this->argument('action');
        $action = Str::trim($action);
        $action = Str::lower($action);

        if (isset($this->actions[$action])) {
            $method = $this->actions[$action]['method'];
            $this->{$method}();
        } else {
            $this->onHelp();
        }
    }

    /**
     * Prints help info.
     */
    private function onHelp(): void
    {
        $this->info('Available actions:');
        $rows = [];
        foreach ($this->actions as $id => $actionData) {
            $rows[] = [
                $id,
                $actionData['description'],
            ];
        }
        $this->output->table([
            'id',
            'description',
        ], $rows);
    }

    /**
     * Increments all frontend versions.
     *
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function onIncrementAll(): void
    {
        $version = $this->getFrontendVersion();
        $affected = $version->incAllVersions();
        $version->save();

        $this->output->success("Increased {$affected} versions.");
        $this->onInfo();
    }

    /**
     * Prints versions info.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function onInfo(): void
    {
        $version = $this->getFrontendVersion();
        $versions = [];
        foreach ($version->getAllVersions() as $path => $versionNumber) {
            $versions[] = [$path, $versionNumber];
        }
        $this->output->table([
            'script path', 'version',
        ], $versions);
    }

    /**
     * Retrieves frontend version service.
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getFrontendVersion(): FrontendVersion
    {
        return app()->get('frontend_version');
    }
}
