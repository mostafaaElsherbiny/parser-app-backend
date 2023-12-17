<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Services\Integrations\ArticlesIntegrationInterface;

class ParseArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ArticlesIntegrationInterface $articlesIntegration)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Start parsing articles' . $this->articlesIntegration . ' integration');
        $data = $this->articlesIntegration->getArticles();

        foreach ($data as $article) {
            $resource = new Article([
                'title' => $article->title,
                'description' => $article->description,
                'url' => $article->url,
                'urlToImage' => $article->urlToImage,
                'publishedAt' => $article->publishedAt,
                'content' => $article->content,
                'category' => $article->category,
                'source' => $article->source,
            ]);
            $resource->save();
        }

        Log::info('End parsing articles');
    }
}
