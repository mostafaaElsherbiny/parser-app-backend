<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetArticleRequest;
use App\Services\Api\ArticleService;

class ArticleController extends Controller
{
    public function __construct(
        public  ArticleService $articleService
    ) {
    }
    public function index(
        GetArticleRequest $request
    ) {
        return  $this->articleService->getArticles($request);
    }

    public function getAllAvailableCategories()
    {
        $categories = Article::select('category')->distinct()->get();

        $categories = $categories->pluck('category')->transform(function ($item, $key) {
            return [
                'label' => $item,
                'value' => $item
            ];
        });
        return response()->json($categories);
    }
}
