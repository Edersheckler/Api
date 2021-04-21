<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\ArticleLine;

class ArticleLineController extends Controller
{
    public function paging()
    {
        try {
            $results = ArticleLine::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = ArticleLine::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

   
}
