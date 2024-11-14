<?php

namespace App\Repositories\Question;

use App\Http\Requests\Interfaces\IReceivedQuestionData;
use App\Http\Requests\Interfaces\IQuestionListFilter;
use App\Models\Interfaces\IQuestionModel;
use App\Models\Question;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

/**
 * Question repository.
 */
class QuestionRepository implements IQuestionRepository
{
    /**
     * {@inheritdoc}
     */
    public function getQuestion(int $questionId): IQuestionModel
    {
        return Question::findOrFail($questionId);
    }

    /**
     * {@inheritdoc}
     */
    public function createQuestion(IReceivedQuestionData $questionData): IQuestionModel
    {
        $model = new Question();
        $model->is_enabled = $questionData->getIsEnabled();
        $model->name = $questionData->getName();
        $model->save();

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaginatedList(IQuestionListFilter $questionFilter): PaginatorContract
    {
        $query = Question::query();
        $name = $questionFilter->getName();
        $withTrashed = $questionFilter->getWithTrashed();
        $query->orderBy('updated_at', $questionFilter->getSortOrder()->value);
        if (!empty($name)) {
            $query->where('name', 'like', '%'.$name.'%');
        }
        if ($withTrashed) {
            $query->withTrashed();
        }
        return $query
            ->paginate()
            ->setPath('');
    }

    /**
     * {@inheritdoc}
     */
    public function updateQuestion(IReceivedQuestionData $questionData, int $questionId): IQuestionModel
    {
        $question = Question::findOrFail($questionId);
        $question->name = $questionData->getName();
        $question->is_enabled = $questionData->getIsEnabled();
        $question->save();

        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteQuestion(int $questionId): void
    {
        $question = Question::findOrFail($questionId);
        $question->delete();
    }
}
