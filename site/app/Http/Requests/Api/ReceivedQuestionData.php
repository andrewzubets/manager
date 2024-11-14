<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Interfaces\IReceivedQuestionData;
use Illuminate\Foundation\Http\FormRequest;

class ReceivedQuestionData extends FormRequest implements IReceivedQuestionData
{
    /**
     * Determine if authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string {
        return (string) $this->request->get('name');
    }

    /**
     * {@inheritdoc}
     */
    public function getIsEnabled(): bool {
        return $this->request->get('is_enabled', 0) == 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): null|int
    {
        return $this->request->get('id');
    }
}
