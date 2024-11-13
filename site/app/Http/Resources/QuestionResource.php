<?php

namespace App\Http\Resources;

use App\Models\Question;
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
        if ($this->resource instanceof Question) {
            $question = $this->resource;

            return [
                'id' => $question->id,
                'name' => $question->name,
                'is_enabled' => $question->is_enabled,
                'category' => '',
                'created_at' => $question->created_at,
                'updated_at' => $question->updated_at,
            ];
        }

        return parent::toArray($request);
    }
}
