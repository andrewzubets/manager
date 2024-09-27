<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Question controller.
 */
class QuestionController extends Controller
{
    /**
     * Display a listing of the questions.
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return Question::search($request->all())->paginate();
    }


    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Question $question): Question
    {
        return $question;
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): void
    {
        $question->delete();
    }
}
