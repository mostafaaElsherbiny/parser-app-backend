<?php
return [
    'news_api' => [
        'api_key' => env('WEBAPI_KEY'),
        'class' => \App\Services\Integrations\NewsApiIntegration::class,
        'url' => 'https://newsapi.org/v2/top-headlines',
        'categories' => [
            'business',
            'entertainment',
            'general',
            'health',
            'science',
            'sports',
            'technology',
        ],
    ],
    'guardian_api' => [
        'api_key' => env('GUARDIAN_KEY'),
        'class' => \App\Services\Integrations\GuardianApiIntegration::class,
        'url' => 'https://content.guardianapis.com/search',
    ],
    'nytimes_api' => [
        'api_key' => env('NYTIMES_KEY'),
        'class' => \App\Services\Integrations\NytimesApiIntegration::class,
        'url' => 'https://api.nytimes.com/svc/topstories/v2/home.json',
    ],
    'available_integrations' => [
        'news_api',
        'guardian_api',
        'nytimes_api',
    ],
   
];
