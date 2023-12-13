<?php

namespace App\Services\Api;

use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class ArticleService
 *
 * @package App\Services\Api
 */

class ArticleService
{


    public function getArticles(Request $request)
    {
        return  Article::when(
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
}
