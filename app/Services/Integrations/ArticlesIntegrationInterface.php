<?php

namespace App\Services\Integrations;

use Illuminate\Http\Resources\Json\JsonResource;

interface ArticlesIntegrationInterface
{
    public function getArticles(): array;
}
