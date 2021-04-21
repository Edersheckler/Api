<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\ArticlePrice;

class ArticlePriceController extends Controller
{
    public function paging()
    {
        try {
            $results = ArticlePrice::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byArticlePrice(
        $articlePriceId
    ) {
        try {
            $result = ArticlePrice::where('PRECIO_ARTICULO_ID', '=', $articlePriceId)->first();
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byPriceArticleAndCurrency(
        $articlePriceId,
        $articleId,
        $currencyId
    ) {
        try {
            $result = ArticlePrice::where([
                ['ARTICULO_ID', '=', $articleId],
                ['PRECIO_ARTICULO_ID', '=', $articlePriceId],
                ['MONEDA_ID', '=', $currencyId],
            ])
                ->first();
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
