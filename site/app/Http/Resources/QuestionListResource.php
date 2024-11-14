<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *    An array with collection of records and pagination info.
     */
    public function toArray(Request $request): array
    {
        if(!$this->resource instanceof Paginator){
            return [];
        }
        return [
            'data' => QuestionResource::collection($this->resource->items()),
            'pagination' => [
                'previous_page' => $this->resource->currentPage() - 1,
                'current_page' => $this->resource->currentPage(),
                'next_page' => $this->resource->currentPage() + 1,
                'last_page' => $this->resource->lastPage(),
                'has_pages' => $this->resource->hasPages(),
                'has_more_pages' => $this->resource->hasMorePages(),
                'has_prev_pages' => $this->resource->currentPage() > 1,
            ],
        ];
    }
}
