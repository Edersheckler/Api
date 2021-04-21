<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Firebird\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $repository;
    public function __construct(
        Article $repository
    ) {
        $this->repository = $repository;
    }
    /**
     * Paging
     *
     * @return void
     */
    public function paging()
    {
        try {
            $results = $this->repository->paginate(50);
            return response()->paging($results);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Gets by id
     *
     * @param [number] $id
     * @return void
     */
    public function byId(
        $id
    ) {
        try {
            $result = $this->repository->find($id);
            return response()->data($result);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Gets articles like clave
     *
     * @param Request $request
     * @param [number] $id
     * @return void
     */
    public function byIClave(
        Request $request,
        $id
    ) {
        $data = null;
        try {
            $almacenId = $request->header('ALMACEN_ID', 19);
            $clienteId = $request->header('CLIENTE_ID', 0);
            $records = $this->repository->getLikeClave($id, $almacenId, $clienteId);
            if (count($records)) {
                $data = $records;
            }
            return response()->paging($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Gets articles by clave
     *
     * @param Request $request
     * @param [number] $id
     * @return void
     */
    public function byClave(
        Request $request,
        $id
    ) {
        $data = null;
        try {
            $almacenId = $request->header('ALMACEN_ID', 19);
            $clienteId = $request->header('CLIENTE_ID', 0);
            $records = $this->repository->getByClave($id, $almacenId, $clienteId);
            if (count($records)) {
                $data = $records[0];
            }
            return response()->data($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Gets articles like name
     *
     * @param Request $request
     * @param [string] $nombre
     * @return void
     */
    public function byIName(
        Request $request,
        $nombre
    ) {
        $data = null;
        try {
            $almacenId = $request->header('ALMACEN_ID', 19);
            $clienteId = $request->header('CLIENTE_ID', 0);
            $records = $this->repository->getLikeName($nombre, $almacenId, $clienteId);
            if (count($records)) {
                $data = $records;
            }
            return response()->paging($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
