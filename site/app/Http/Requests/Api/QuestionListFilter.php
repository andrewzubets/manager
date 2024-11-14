<?php

namespace App\Http\Requests\Api;

use App\Data\SortOrder;
use App\Http\Requests\Interfaces\IQuestionListFilter;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Question list filter request.
 *
 */
class QuestionListFilter extends FormRequest implements IQuestionListFilter
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): null|string
    {
        return $this->request->get('name');
    }


    /**
     * {@inheritdoc}
     */
    public function getWithTrashed(): bool
    {
        return $this->request->get('trashed', 0) == 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortOrder(): SortOrder
    {
        $value = SortOrder::tryFrom($this->request->get('sortOrder','asc'));
        if($value instanceof SortOrder){
            return $value;
        }
        return SortOrder::Asc;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(): int
    {
        return $this->request->get('page', 1);
    }
}
