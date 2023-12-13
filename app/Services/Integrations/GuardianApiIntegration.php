<?php


namespace App\Services\Integrations;

use App\DTO\ArticleIntegrationDto;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\NewsApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GuardianApiIntegration implements ArticlesIntegrationInterface
{

    private $baseUrl;


    const LANG = 'en';

    public function __construct()
    {
        $this->baseUrl = config('integrations.guardian_api.url');
    }

    /**
     * @return ArticleIntegrationDto[]
     * @throws \Exception
     */

    public function getArticles(): array

    {
        $apiKey = config('integrations.guardian_api.api_key');

        $limit = 2;

        $url = $this->baseUrl . '?api-key=' . $apiKey . '&show-fields=thumbnail&page-size=' . $limit;


        $data = [];

        $response = Http::get($url);

        if ($response->failed()) {
            throw new \Exception('Error while getting articles from GuardianApi');
        }

        $articles = $response->json()['response']['results'];

        foreach ($articles as $article) {
            $data[] = new ArticleIntegrationDto(
                title: $article['webTitle'],
                description: $article['fields']['thumbnail'],
                url: $article['webUrl'],
                urlToImage: $article['fields']['thumbnail'],
                publishedAt: $article['webPublicationDate'],
                content: $article['webTitle'],
                category: $article['sectionName'],
                source: "guardian_api"
            );
        }

        return $data;
    }
}
