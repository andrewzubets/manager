<?php

namespace App\Api\Frontend;

use App\Api\Menu\MenuManager;
use Illuminate\Contracts\Support\Jsonable;

class PreloadedState implements Jsonable
{
    protected array $data = [];

    public function __construct(MenuManager $menuManager)
    {
        $menuManager->loadJsonMenu('navigation/top-menu');
        $this->setData('top-menu', [
            'left' => $menuManager->getMenu('left', false),
            'right' => $menuManager->getMenu('right', false),
        ]);
    }

    public function setData(string $key, mixed $data): static
    {
        $this->data[$key] = $data;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson($options = 0): string
    {
        if ($options === 0) {
            if (config('app.env') !== 'production') {
                $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;
            }
        }

        return json_encode($this->data, $options);
    }
}
