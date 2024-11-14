<?php

namespace App\Http\Requests\Interfaces;

/**
 * Describes received question data from client.
 *
 */
interface IReceivedQuestionData
{
    /**
     * Gets received id.
     *
     * @return int|null
     */
    public function getId(): null|int;

    /**
     * Gets received name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Gets if question enabled.
     *
     * @return bool
     */
    public function getIsEnabled(): bool;

}
