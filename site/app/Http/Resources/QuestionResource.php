<?php

namespace App\Http\Resources;

use App\Models\Interfaces\IQuestionModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->resource instanceof IQuestionModel) {
            $question = $this->resource;

            return [
                'id' => $question->getId(),
                'name' => $question->getName(),
                'is_enabled' => $question->getIsEnabled(),
                'category' => '',
                'created_at' => $question->getCreatedAt(),
                'updated_at' => $question->getUpdatedAt(),
            ];
        }

        return parent::toArray($request);
    }
}
