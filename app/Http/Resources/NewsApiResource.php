<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => data_get($this, 'title'),
            'description' => data_get($this, 'description'),
            'urlToImage' => data_get($this, 'urlToImage'),
            'publishedAt' => data_get($this, 'publishedAt'),
            'content' => data_get($this, 'content'),
            'url' => data_get($this, 'url'),
            'source' => data_get($this, 'source'),
        ];
    }
}
