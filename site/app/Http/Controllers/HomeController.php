<?php

namespace App\Http\Controllers;

use App\Api\Frontend\VueControllerBase;
use App\Api\Menu\MenuManager;
use Illuminate\View\View;

/**
 * Home controller.
 */
class HomeController extends VueControllerBase
{

    /**
     * Common action that called before returning vue view.
     *
     * @return void
     */
    protected function common(): void
    {

    }

    /**
     * Home page.
     *
     * @return View
     */
    public function home(): View
    {
        $this->setMetaTitle('Главная');
        return $this->vue();
    }

    /**
     * Question list.
     *
     * @return View
     */
    public function questions(): View
    {
        return $this->vue([]);
    }


}
