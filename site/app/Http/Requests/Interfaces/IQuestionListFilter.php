<?php

namespace App\Http\Requests\Interfaces;

use App\Data\SortOrder;

/**
 * Interface for question list filter.
 */
interface IQuestionListFilter
{
    /**
     * Gets name filter value.
     *
     * @return string|null
     *   Name or null if not present.
     */
    public function getName(): null|string;

    /**
     * Gets with deleted records flag.
     *
     * Specifies if deleted records should be returned.
     *
     * @return bool
     *   True - with deleted records.
     */
    public function getWithTrashed(): bool;

    /**
     * Gets sort order filter value.
     *
     * Specifies sort order.
     *
     * @return SortOrder
     *   Sort order ASC or DESC value.
     */
    public function getSortOrder(): SortOrder;

    /**
     * Gets current page.
     *
     * @return int
     *   Current page, 1 if not present.
     */
    public function getPage(): int;
}
