<?php

namespace App\DTO;

class ArticleIntegrationDto
{


    public function __construct(
        public string $title,
        public string $description,
        public string $url,
        public ?string $urlToImage,
        public string $publishedAt,
        public ?string $content,
        public string $category,
        public string $source
    ) {
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'urlToImage' => $this->urlToImage,
            'publishedAt' => $this->publishedAt,
            'content' => $this->content,
            'category' => $this->category,
            'source' => $this->source,
        ];
    }
}
