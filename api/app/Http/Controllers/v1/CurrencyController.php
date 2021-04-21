<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\CurrencyUR;

class CurrencyController extends Controller
{
    public function paging()
    {
        try {
            $results = CurrencyUR::paginate();
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = CurrencyUR::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
