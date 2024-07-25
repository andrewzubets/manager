<?php

namespace App\Api\Frontend;



use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class FrontendVersion
{
    public function __construct()
    {
        $config = config('api.frontend');
        $this->path = $config['path'] ?? 'versions.json';
        $this->is_local = $config['is_local'] ?? false;//App::environment('local');
        if(!$this->load()){
            $this->data = $config['default'] ?? [];
        }
    }
    protected ?array $data = null;
    protected string $path;
    protected bool $is_local;

    protected const VERSION_FILE = 'public/build/versions.json';

    protected function getFileContent(): string {
        return file_get_contents($this->path) ?: '';
    }

    protected function fileExists(): bool {
        return file_exists($this->path);
    }

    public function load(): bool {
        if(!$this->fileExists()){
            return false;
        }
        $this->data = json_decode($this->getFileContent(),true);
        return true;
    }
    public function save(): void {
        $contents = json_encode($this->data ?? [], \JSON_PRETTY_PRINT);
        file_put_contents($this->path, $contents);
    }

    public function getQueryString(string $scriptType, string $id): string {
        if($this->is_local){
            return 't='.time();
        }
        return 'v='.$this->getVersion($scriptType, $id);
    }

    public function getVersion(string $scriptType, string $id): int {
        dd($this->data);
        return $this->data[$scriptType][$id] ?? 1;
    }
    public function setVersion(string $scriptType, string $id, int $version): static {
        if(!is_array($this->data)){
            $this->data = [];
        }
        if(!is_array($this->data[$scriptType])){
            $this->data[$scriptType] = [];
        }
        $this->data[$scriptType][$id] = $version;
        return $this;
    }

    public function incVersion(string $scriptType, string $id): int {
        $version = ($this->data[$scriptType][$id] ?? 1) + 1;
        $this->setVersion($scriptType, $id, $version);
        return $version;
    }

    public function incVersions(): int
    {
        if(!is_array($this->data)){
            return 0;
        }
        $total = 0;
        foreach ($this->data as $scriptType => $dataPairs){
            foreach ($dataPairs as $id => $version){
                $this->data[$scriptType][$id] = $version + 1;
                $total++;
            }
        }
        return $total;
    }

    public function getVersionsInfo(): array
    {
        if(!is_array($this->data)){
            return [];
        }
        $info = [];
        foreach ($this->data as $scriptType => $dataPairs){
            foreach ($dataPairs as $id => $version){
                $info[]=[
                    $scriptType,
                    $id,
                    $version
                ];
            }
        }
        return $info;
    }
}
