<?php

namespace App\Http\Controllers\v1;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\HTTP\Resources\UsuarioResource;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsuarioController extends BaseController
{
    protected $repository;

    public function __construct(
        Usuarios $repository

    ) {
        $this->repository = $repository;
    }

    /**
     * Get all users  
     */
    public function paging(
        Request $request

    ) {
        $limit = $request->input('limit', 50);
        $records = $this->repository->paginate($limit);
        return response()->paging($records);
    }


    /**
     * Creates  
     */
    public function create(
        Request $request
    ) {
        #dd($request->all());
        $usuario = Usuarios::create($request->all());
        return response()->create($usuario);
    }

    /**
     * Get by id  
     */
    public function getById(
        $id
    ) {
        $record = $this->repository->find($id);
        return response()->data($record);
    }

    /**
     * Update by id  
     */
    public function updateById(
        $id
    ) {
    }

    /**
     * Delete by id  
     */
    public function deleteById(
        $id
    ) {
    }
}
