<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\DoctoPV;
use App\Models\Firebird\DoctoPVLiga;

class DoctoController extends Controller
{
    public function paging()
    {
        try {
            $result = DoctoPV::paginate(50);
            return response()->paging($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function pagingLigas()
    {
        try {
            $result = DoctoPVLiga::take(100)->get();
            return response()->paging($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function byId(
        $id
    ) {
        try {
            $result = DoctoPV::find($id);
            //DOCTOS_PV_COBROS & IMPUESTOS_DOCTOS_PV
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function detailById(
        $id
    ) {
        try {
            $result = DoctoPV::with('detalle')->find($id)->toArray();
            /*  [
                'TIPO_DOCTO' => $type,
                'detalle' => $details
            ] = $result;

            if ($type == 'F') {
                hacer un mapper para pegar las relaciones de la tabla de ligas si el 
            } */

            return response()->paging($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
