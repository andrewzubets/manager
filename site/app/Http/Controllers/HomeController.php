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
     * Home page.
     *
     * @return View
     */
    public function home(): View
    {
        return $this->vue([]);
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
