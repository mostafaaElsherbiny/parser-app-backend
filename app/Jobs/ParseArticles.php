<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\Integrations\ArticlesIntegrationInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ParseArticles implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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
        Log::info('Start parsing articles integration', [
            'integration' => $this->articlesIntegration::class,
        ]);

        collect(
            $this->articlesIntegration->getArticles()
        )->each(fn($article) =>
            Article::create($article->toArray())
        );

        Log::info('End parsing articles', [
            'integration' => $this->articlesIntegration::class,
        ]);
    }
}
