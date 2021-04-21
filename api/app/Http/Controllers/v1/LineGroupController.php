<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\LineGroup;

class LineGroupController extends Controller
{
    public function paging()
    {
        try {
            $results = LineGroup::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = LineGroup::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

   
}
