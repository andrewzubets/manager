<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Controller that handles questions requests.
 */
class QuestionController extends Controller
{
    /**
     * Gets question list.
     *
     * @param Request $request
     *   Request instance.
     *
     * @return array
     *   An array of list data with pagination info.
     */
    public function index(Request $request): array
    {

        $paginated = Question::filter($request->all())
            ->paginate()
            ->setPath('');

        return [
            'data' => QuestionResource::collection($paginated->items()),
            'pagination'=>[
                'previous_page' => $paginated->currentPage() - 1,
                'current_page' =>$paginated->currentPage(),
                'next_page' =>$paginated->currentPage() + 1,
                'last_page' => $paginated->lastPage(),
                'has_pages' => $paginated->hasPages(),
                'has_more_pages'=>$paginated->hasMorePages(),
                'has_prev_pages'=>$paginated->currentPage() > 1,
            ],
        ];
    }

    /**
     * Creates new question record.
     *
     * @param Request $request
     *   Request instance.
     *
     * @return Question
     *   New question record.
     */
    public function store(Request $request): Question
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $name = $request->get('name');
        $isEnabled = $request->get('is_enabled', 0);
        $record = new Question();
        $record->name = $name;
        $record->is_enabled = $isEnabled;
        $record->save();

        return $record;
    }

    /**
     * Gets question record.
     *
     * @param Question $question
     *   Resolved question record.
     *
     * @return Question
     *   Requested question.
     */
    public function show(Question $question): Question
    {
        return $question;
    }

    /**
     * Updates existing question record.
     *
     * @param Request $request
     *   Request instance.
     * @param Question $question
     *   Updated question record.
     *
     * @return Question
     *   Updated question.
     */
    public function update(Request $request, Question $question): Question
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $name = $request->get('name');
        $isEnabled = $request->get('is_enabled', 0);

        $question->name = $name;
        $question->is_enabled = $isEnabled;
        $question->save();

        return $question;
    }

    /**
     * Deletes existing question record from database.
     *
     * @param Question $question
     *   Resolved question.
     */
    public function destroy(Question $question): void
    {
        $question->delete();
    }
}
