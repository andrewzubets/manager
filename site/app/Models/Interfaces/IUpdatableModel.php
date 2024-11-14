<?php

namespace App\Models\Interfaces;

use Carbon\Carbon;

/**
 * Describes model that have crud date fields.
 */
interface IUpdatableModel
{
    /**
     * Gets creation datetime.
     *
     * @return Carbon|null
     *   Carbon object or null if not set.
     */
    public function getCreatedAt(): Carbon|null;

    /**
     * Gets update datetime.
     *
     * @return Carbon|null
     *   Carbon object or null if not set.
     */
    public function getUpdatedAt(): Carbon|null;
}
