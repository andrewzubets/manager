<?php

namespace App\Repositories\Question;

use App\Http\Requests\Interfaces\IReceivedQuestionData;
use App\Http\Requests\Interfaces\IQuestionListFilter;
use App\Models\Interfaces\IQuestionModel;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

/**
 * Interface for question repository.
 */
interface IQuestionRepository
{
    /**
     * Creates new question record.
     *
     * @param IReceivedQuestionData $questionData
     *   Passed trough question data object.
     * @return IQuestionModel
     *   Question model object.
     */
    public function createQuestion(IReceivedQuestionData $questionData): IQuestionModel;

    /**
     * Fetching paginated list for specified filter data.
     *
     * @param IQuestionListFilter $questionFilter
     *   Question list filter data.
     *
     * @return PaginatorContract
     *   Paginated list data.
     */
    public function getPaginatedList(IQuestionListFilter $questionFilter): PaginatorContract;

    /**
     * Fetching question for specified id.
     *
     * @param int $questionId
     *   Question id.
     * @return IQuestionModel
     *   Question model object.
     */
    public function getQuestion(int $questionId): IQuestionModel;

    /**
     * Updates question.
     *
     * @param IReceivedQuestionData $questionData
     *   Question updated data that should be applied.
     * @param int $questionId
     *   Question id.
     * @return IQuestionModel
     *   Updated question model.
     */
    public function updateQuestion(IReceivedQuestionData $questionData, int $questionId): IQuestionModel;

    /**
     * Deletes question.
     *
     * @param int $questionId
     *   Question id.
     * @return void
     */
    public function deleteQuestion(int $questionId): void;
}
