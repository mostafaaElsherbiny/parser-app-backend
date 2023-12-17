<?php

namespace App\Console\Commands\Intergration;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\NewsApiResource;
use App\Jobs\ParseArticles;
use App\Models\Article;
use App\Services\Integrations\NewsApiIntegration;

class ParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse articles from integrations and save to DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $availableIntegrations = config('integrations.available_integrations');

        foreach ($availableIntegrations as $key => $availableIntegration) {
            $this->info('Parsing Now ' . $availableIntegration . ' integration');
            $integration = config('integrations.' . $availableIntegration . '.class');

            $integration = new $integration();

            ParseArticles::dispatch($integration);
        }


    }
}
