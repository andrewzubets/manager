<?php

namespace App\Api\Menu;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Manages menu.
 *
 * Used to load menu from json file and prepare it for view or vue.
 */
class MenuManager
{
    /**
     * Menus.
     */
    private array $menus;

    /**
     * Constructs menu manager.
     *
     * @param  array  $menus
     *                        An array of menus.
     */
    public function __construct(array $menus = [])
    {
        $this->menus = $menus;
    }

    /**
     * Loads menu data from json file.
     *
     * @param  string  $path
     *                        Path to menu.json located in "data" disk.
     * @return bool
     *              True if loaded successfully.
     */
    public function loadJsonMenu(string $path): bool
    {
        if (! Str::endsWith($path, '.json')) {
            $path .= '.json';
        }
        $disk = Storage::disk('data');
        if (! $disk->exists($path)) {
            return false;
        }
        $menus = Json::decode($disk->get($path), true);
        if (is_array($menus)) {
            $this->menus = $menus;

            return true;
        }

        return false;
    }

    /**
     * Gets menu from loaded data.
     *
     * @param  string  $menuId
     *                          Menu's id.
     * @param  bool  $absolute
     *                          Should links contain site's base url.
     * @return array
     *               Array of menu items.
     */
    public function getMenu(string $menuId, bool $absolute = true): array
    {
        $menuItems = $this->menus[$menuId] ?? [];

        return $this->processMenuItems($menuItems, $absolute);
    }

    /**
     * Processes menu items.
     *
     * Evaluating route or translation values.
     *
     * @param  array  $menuItems
     *                            Menu items to process.
     * @param  bool  $absolute
     *                          Should links contain site's base url.
     * @return array
     *               An array of processed items.
     */
    private function processMenuItems(array $menuItems, bool $absolute = true): array
    {
        $processedMenuItems = [];
        foreach ($menuItems as $menuItem) {
            $sub = $menuItem['sub'] ?? null;
            $processedMenuItem = [
                'href' => $this->getHref($menuItem, $absolute),
                'label' => $this->getLabel($menuItem),
                'route' => $menuItem['route'] ?? null,
                'active_routes' => $this->getActiveRoutes($menuItem),
            ];
            if (! empty($sub)) {
                $processedMenuItem['sub'] = $this->processMenuItems($sub, $absolute);
            }
            $processedMenuItems[] = $processedMenuItem;
        }

        return $processedMenuItems;
    }

    /**
     * Gets href from loaded menu item props.
     *
     * @param  array  $menuItem
     *                           Unprocessed menu item.
     * @param  bool  $absolute
     *                          Should links contain site's base url.
     * @return string
     *                Empty string if no href found.
     */
    private function getHref(array $menuItem, bool $absolute = true): string
    {
        if (isset($menuItem['href'])) {
            return $menuItem['href'];
        }
        if (isset($menuItem['route'])) {
            $routeArgs = $menuItem['route_args'] ?? [];

            return route($menuItem['route'], $routeArgs, $absolute);
        }

        return '';
    }

    /**
     * Gets label from loaded menu item props.
     *
     * @param  array  $menuItem
     *                           Unprocessed menu item.
     * @return string
     *                Empty string if no label found.
     */
    private function getLabel(array $menuItem): string
    {
        if (isset($menuItem['label'])) {
            return $menuItem['label'];
        }
        if (isset($menuItem['trans'])) {
            return trans($menuItem['trans']);
        }

        return '';
    }

    /**
     * Gets label from loaded menu item props.
     *
     * @param  array  $menuItem
     *                           Unprocessed menu item.
     * @return array
     *               Array of active routes.
     */
    private function getActiveRoutes(array $menuItem): ?array
    {
        if (isset($menuItem['active_routes'])) {
            return $menuItem['active_routes'];
        }
        $activeRoutes = [];
        if (isset($menuItem['route'])) {
            $activeRoutes[] = $menuItem['route'];
        }
        if (empty($menuItem['sub'])) {
            return $activeRoutes;
        }
        foreach ($menuItem['sub'] as $subMenuItem) {
            $subActiveRoutes = $this->getActiveRoutes($subMenuItem);
            $activeRoutes = array_merge($activeRoutes, $subActiveRoutes);
        }

        return array_values(array_unique($activeRoutes));
    }
}
