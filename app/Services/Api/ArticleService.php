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
        $searchAble = $request->has('filter_by') && $request->has('filter_value') && $request->has('filter_condition') == 'like';

        $filterAble = $request->has('filter_by') && $request->has('filter_value') && $request->has('filter_condition') == '=';

        $orderAble = $request->has('sortBy') && $request->has('sortValue');

        return Article::when($orderAble, fn ($query) => $query->sort($request->sortBy, $request->sortValue))
            ->when($filterAble, fn ($query) => $query->filter($request->filter_by, $request->filter_value))
            ->when($searchAble, fn ($q) => $q->search($request->filter_by, $request->filter_value))
            ->paginate($request->input('per_page', 10));
    }
}
