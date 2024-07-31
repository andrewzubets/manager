<?php

namespace App\View\Components;

use App\Api\Menu\MenuManager;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
class Header extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(private readonly MenuManager $menuManager)
    {
        $this->menuManager->loadJsonMenu('navigation/top-menu');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $left = $this->menuManager->getMenu('left');
        $right = $this->menuManager->getMenu('right');
        return view('components.header',[
            'navbarBrand' => [
              'href'=>route('home'),
              'label'=>trans('site.name'),
            ],
            'leftMenu' => $left,
            'rightMenu' => $right,
        ]);
    }


}
