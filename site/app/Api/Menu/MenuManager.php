<?php

namespace App\Api\Menu;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuManager
{
    private Filesystem $filesystem;

    public function __construct(
        private array $menus = []
    )
    {
        $this->filesystem = Storage::disk('data');
    }

    public function loadFromPath(string $dataPath): bool {

        if(Str::endsWith($dataPath, '.php')){
           return $this->loadPhpMenu($dataPath);
        }
        if(Str::endsWith($dataPath, '.json')){
            return $this->loadJsonMenu($dataPath);
        }
        return $this->loadPhpMenu($dataPath . '.php');
    }

    public function loadJsonMenu(string $dataPath): bool {
        if(!$this->filesystem->exists($dataPath)){
            return false;
        }
        $menus = Json::decode($this->filesystem->get($dataPath),true);
        if(is_array($menus)){
            $this->menus = $menus;
            return true;
        }
        return false;
    }

    public function loadPhpMenu(string $dataPath): bool {
        if(!$this->filesystem->exists($dataPath)){
            return false;
        }
        $menus = include $this->filesystem->path($dataPath);
        if(is_array($menus)){
            $this->menus = $menus;
            return true;
        }
        return false;
    }

    public function getMenu(string $menuId): array {
        $menuItems = $this->menus[$menuId] ?? [];
        return $this->prepareMenuItems($menuItems);
    }

    private function prepareMenuItems(array $menuItems): array
    {
        $processedMenuItems = [];
        foreach ($menuItems as $menuItem){
            $href = $menuItem['href'] ?? '';
            $label = $menuItem['label'] ?? '';
            $sub = $menuItem['sub'] ?? null;
            if(isset($menuItem['href.route'])){
                $href = route($menuItem['href.route']);
            }
            if(isset($menuItem['label.trans'])){
                $label = trans($menuItem['label.trans']);
            }
            $processedMenuItem = [
                'href' => $href,
                'label' => $label,
            ];
            if(!empty($sub)){
                $processedMenuItem['sub'] = $this->prepareMenuItems($sub);
            }
            $processedMenuItems[]=$processedMenuItem;
        }
        return $processedMenuItems;
    }
}
