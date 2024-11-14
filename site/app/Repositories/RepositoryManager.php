<?php

namespace App\Repositories;

use App\Repositories\Question\IQuestionRepository;
use App\Repositories\Question\QuestionRepository;

/**
 * Manages repositories.
 */
class RepositoryManager
{
    /**
     * Gets current question repository.
     *
     * @return IQuestionRepository
     *   Question repository class.
     */
    public function getQuestionRepository(): IQuestionRepository {
        return new QuestionRepository();
    }
}
