<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\Country;

class CountryController extends Controller
{
    public function paging()
    {
        try {
            $results = Country::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = Country::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
