<?php

namespace App\Services\Integrations;

use App\DTO\ArticleIntegrationDto;
use Illuminate\Support\Facades\Http;

class NewsApiIntegration implements ArticlesIntegrationInterface
{
    private $baseUrl;

    public const LANG = 'en';

    public function __construct()
    {
        $this->baseUrl = config('integrations.news_api.url');
    }

    /**
     * @return ArticleIntegrationDto[]
     * @throws \Exception
     */
    public function getArticles(): array
    {
        $categories = config('integrations.news_api.categories');

        $apiKey = config('integrations.news_api.api_key');

        $limit = 2;

        $url = $this->baseUrl . '?apiKey=' . $apiKey . '&language=' . self::LANG . '&pageSize=' . $limit;

        $data = [];

        foreach ($categories as $category) {
            $urlWithCat = $url . '&category=' . $category;
            $response = Http::get($urlWithCat);
            if ($response->failed()) {
                throw new \Exception('Error while getting articles from NewsApi');
            }

            $articles = $response->json()['articles'];

            foreach ($articles as $article) {
                $data[] =
                new ArticleIntegrationDto(
                    title: $article['title'],
                    description: $article['description'],
                    url: $article['url'],
                    urlToImage: $article['urlToImage'],
                    publishedAt: $article['publishedAt'],
                    content: $article['content'],
                    category: $category,
                    source: 'news_api'

                );
            }
        }

        return $data;
    }
}
