<?php

namespace App\Api\Frontend;

use Illuminate\Support\Facades\File;
use Psy\Util\Json;

/**
 * Marks assets with versions.
 *
 * Used to set additional version parameter to
 * frontend file forcing browser to reload it.
 */
class FrontendVersion
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $config = config('api.frontend');
        $this->path = base_path($config['path'] ?? 'public/build/versions.json');
        $this->isDevMode = $config['is_local'] ?? false;
        if (! $this->load()) {
            $this->data = $config['default'] ?? [];
        }
    }

    /**
     * All version data.
     */
    protected ?array $data = null;

    /**
     * Path to stored version file.
     */
    protected string $path;

    /**
     * Sets if version requested under development mode.
     *
     * If true then time() function will be used instead.
     */
    protected bool $isDevMode;

    /**
     * Loads version info from version file.
     *
     * @return bool
     *              True if loaded successfully.
     */
    protected function load(): bool
    {
        if (! File::exists($this->path)) {
            return false;
        }

        $this->data = File::json($this->path);

        return true;
    }

    /**
     * Saves current version data to version file.
     */
    public function save(): void
    {
        $contents = Json::encode($this->data ?? [], \JSON_PRETTY_PRINT);
        File::put($this->path, $contents);
    }

    /**
     * Gets query string part with version parameter.
     *
     * @param  string  $path
     *                        Script path.
     * @return string
     *                Query string part.
     */
    public function getQueryString(string $path): string
    {
        if ($this->isDevMode) {
            return 't='.time();
        }

        return 'v='.$this->getVersion($path);
    }

    /**
     * Gets version for script.
     *
     * @param  string  $path
     *                        Script path.
     * @return int
     *             Version number, 1 if not present.
     */
    public function getVersion(string $path): int
    {
        return $this->data[$path] ?? 1;
    }

    /**
     * Sets version for script.
     *
     * @param  string  $path
     *                        Script path.
     * @param  int  $version
     *                        Version number.
     * @return $this
     */
    public function setVersion(string $path, int $version): static
    {
        if (! is_array($this->data)) {
            $this->data = [];
        }
        $this->data[$path] = $version;

        return $this;
    }

    /**
     * Increments version for script.
     *
     * @param  string  $path
     *                        Script path.
     * @return int
     *             New version.
     */
    public function incVersion(string $path): int
    {
        $newVersion = ($this->data[$path] ?? 1) + 1;
        $this->setVersion($path, $newVersion);

        return $newVersion;
    }

    /**
     * Increases all versions for scripts.
     *
     * @return int
     *             Total script versions that was increased.
     */
    public function incAllVersions(): int
    {
        if (! is_array($this->data)) {
            return 0;
        }

        foreach ($this->data as $scriptPath => $version) {
            $this->data[$scriptPath] = $version + 1;
        }

        return count($this->data);
    }

    /**
     * Gets all version data.
     */
    public function getAllVersions(): array
    {
        return $this->data;
    }
}
