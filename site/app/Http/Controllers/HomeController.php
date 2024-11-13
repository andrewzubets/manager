<?php

namespace App\Http\Controllers;

use App\Api\Frontend\VueControllerBase;
use Illuminate\View\View;

/**
 * Home controller.
 */
class HomeController extends VueControllerBase
{
    /**
     * Common action that called before returning vue view.
     */
    protected function common(): void {}

    /**
     * Home page.
     */
    public function home(): View
    {
        $this->setMetaTitle('Главная');

        return $this->vue();
    }

    /**
     * Question list.
     */
    public function questions(): View
    {
        return $this->vue([]);
    }
}
