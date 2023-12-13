<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetArticleRequest;


class ArticleController extends Controller
{
    public function index(
        GetArticleRequest $request
    ) {
        return Article::when(
            $request->has('sortBy') && $request->has('sortValue'),
            fn ($query) => $query->orderBy(
                $request->input('sortBy'),
                $request->input('sortValue')
            )
        )
            ->when(
                $request->has('filter_by') && $request->has('filter_value') && $request->has('filter_condition') == '=',
                fn ($query) => $query->where(
                    $request->input('filter_by'),
                    $request->input('filter_condition'),
                    $request->input('filter_value')
                )
            )
            ->when(
                $request->has('filter_by') && $request->has('filter_value') && $request->has('filter_condition') == 'like',
                fn ($query) => $query->where(
                    $request->input('filter_by'),
                    $request->input('filter_condition'),
                    '%' . $request->input('filter_value') . '%'
                )->orWhere(
                    $request->input('filter_by'),
                    $request->input('filter_condition'),
                    $request->input('filter_value') . '%'
                )->orWhere(
                    $request->input('filter_by'),
                    $request->input('filter_condition'),
                    '%' . $request->input('filter_value')
                )
            )
            ->paginate($request->input('per_page', 10));
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
