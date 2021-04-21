<?php

namespace App\Http\Controllers\v1;
use App\Models\Usuarios;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsuarioController extends BaseController
{    
    /**
     * Get all users  
     */
    public function getall(
        Usuarios $usuarios
    ) {
        try {
            $records = $usuarios->all();
            return response()->json($records);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}