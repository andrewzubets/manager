<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuestionListFilter;
use App\Http\Requests\Api\ReceivedQuestionData;
use App\Http\Resources\QuestionListResource;
use App\Http\Resources\QuestionResource;

/**
 * Controller that handles questions requests.
 */
class QuestionController extends Controller
{

    /**
     * Gets question list.
     *
     * @param QuestionListFilter $request
     *    Request containing question filter data.
     * @return QuestionListResource
     *    An array of question with pagination info.
     */
    public function index(QuestionListFilter $request): QuestionListResource
    {
        $paginated = $this->repositoryManager
            ->getQuestionRepository()
            ->getPaginatedList($request);

        return new QuestionListResource($paginated);
    }

    /**
     * Creates new question record.
     *
     * @param ReceivedQuestionData $questionRequest
     *   Transferred question data.
     * @return QuestionResource
     *   Newly created question.
     */
    public function store(ReceivedQuestionData $questionRequest): QuestionResource
    {
        $question = $this->repositoryManager
            ->getQuestionRepository()
            ->createQuestion($questionRequest);

        return new QuestionResource($question);
    }

    /**
     * Gets question record.
     *
     * @param int $questionId
     *   Requested question id.
     * @return QuestionResource
     *   Question resource.
     */
    public function show(int $questionId): QuestionResource
    {
        return new QuestionResource($this
            ->repositoryManager
            ->getQuestionRepository()
            ->getQuestion($questionId));
    }

    /**
     * Updates existing question record.
     *
     * @param ReceivedQuestionData $request
     *    Transferred question data.
     * @param int $questionId
     *    Question id.
     * @return QuestionResource
     *    Updated question resource.
     */
    public function update(ReceivedQuestionData $request, int $questionId): QuestionResource
    {
        return new QuestionResource($this->repositoryManager
            ->getQuestionRepository()
            ->updateQuestion($request, $questionId));
    }

    /**
     * Deletes existing question record from database.
     *
     * @param int $questionId
     *   Requested question id.
     */
    public function destroy(int $questionId): void
    {
        $this->repositoryManager
            ->getQuestionRepository()
            ->deleteQuestion($questionId);
    }
}
