<?php

namespace App\Models\Attributes;

use Carbon\Carbon;

/**
 * Contains methods returning crud dates.
 *
 * @method mixed getAttribute
 * @method mixed setAttribute
 */
trait UpdateDataAttributes
{
    /**
     * Gets creation datetime.
     *
     * @return Carbon|null
     *   Carbon object or null.
     */
    public function getCreatedAt(): Carbon|null
    {
        return $this->getAttribute('created_at') ?? null;
    }

    /**
     * Gets updated datetime.
     *
     * @return Carbon|null
     *   Carbon object or null.
     */
    public function getUpdatedAt(): Carbon|null
    {
        return $this->getAttribute('updated_at') ?? null;
    }
}
