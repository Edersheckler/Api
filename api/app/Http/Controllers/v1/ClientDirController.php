<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\ClientDir;

class ClientDirController extends Controller
{
    public function paging()
    {
        try {
            $results = ClientDir::paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = ClientDir::find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byClientId(
        $clientId
    ) {
        try {
            $result = ClientDir::where('CLIENTE_ID',$clientId)->first();
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
