<?php

namespace App\Services\Integrations;

use App\DTO\ArticleIntegrationDto;
use Illuminate\Support\Facades\Http;

class NytimesApiIntegration implements ArticlesIntegrationInterface
{
    private $baseUrl;

    public const LANG = 'en';

    public function __construct()
    {
        $this->baseUrl = config('integrations.nytimes_api.url');
    }

    /**
     * @return ArticleIntegrationDto[]
     * @throws \Exception
     */

    public function getArticles(): array
    {
        $apiKey = config('integrations.nytimes_api.api_key');

        $url = $this->baseUrl . '?api-key=' . $apiKey;

        $data = [];

        $response = Http::get($url);

        if ($response->failed()) {
            throw new \Exception('Error while getting articles from NytimesApi');
        }

        $articles = $response->json()['results'];

        foreach ($articles as $article) {
            $data[] =
            new ArticleIntegrationDto(
                title: $article['title'] ?? "no title",
                description: $article['abstract'],
                url: $article['url'],
                urlToImage: data_get($article, 'multimedia.url'),
                publishedAt: $article['published_date'],
                content: $article['abstract'],
                category: $article['section'],
                source: "nytimes_api"
            );
        }

        return $data;
    }
}
