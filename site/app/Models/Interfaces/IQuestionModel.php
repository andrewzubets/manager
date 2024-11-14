<?php

namespace App\Models\Interfaces;

interface IQuestionModel extends IUpdatableModel
{
    public function getId(): null|int;
    public function getName(): null|string;
    public function getIsEnabled(): bool;
}
