<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\Cashier;

class CashierController extends Controller
{

    public function paging()
    {
        try {
            $results = Cashier::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function byId(
        $id
    ) {
        try {
            $result = Cashier::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
