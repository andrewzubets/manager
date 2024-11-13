<?php

namespace App\Api\Frontend;

use Illuminate\View\View;

/**
 * Vue controller base class.
 */
abstract class VueControllerBase
{
    protected string $metaTitle = '';

    protected array $preloadedState = [];

    protected array $data = [];

    protected function setMetaTitle(string $title): static
    {
        $this->metaTitle = $title;
        if (! isset($this->preloadedState['meta'])) {
            $this->preloadedState['meta'] = [];
        }
        $this->preloadedState['meta']['title'] = $title;

        return $this;
    }

    protected function setPreloadedState(string $key, mixed $value): static
    {
        $this->preloadedState[$key] = $value;

        return $this;
    }

    protected function setData(string $key, mixed $value): static
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Prepares vue view response.
     */
    protected function vue(): View
    {
        $this->common();

        return view('vue', [
            'meta_title' => $this->metaTitle,
            'data' => $this->data,
            'preloaded_state' => $this->preloadedState,
        ]);
    }

    abstract protected function common(): void;
}
