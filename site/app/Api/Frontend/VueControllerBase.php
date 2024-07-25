<?php

namespace App\Api\Frontend;

use Illuminate\View\View;


/**
 * Vue controller base class.
 */
abstract class VueControllerBase
{
    /**
     * Prepares vue view response.
     */
    protected function vue(array $data, array $preloadedState = []): View {
        return view('vue', [
            'data' => $data,
            'preloaded_state' => $preloadedState,
        ]);
    }
}
