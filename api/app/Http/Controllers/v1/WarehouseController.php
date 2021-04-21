<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\Warehouse;

class WarehouseController extends Controller
{

    public function byId(
        $id
    ) {
        try {
            $result = Warehouse::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
