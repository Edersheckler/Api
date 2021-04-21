<?php

namespace App\Http\Controllers;

use App\Models\DoctoPV;
use App\Models\Colas;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function index()
    {
        try {

            $tables = DB::select('SELECT a.RDB$RELATION_NAME
            FROM RDB$RELATIONS a
            WHERE COALESCE(RDB$SYSTEM_FLAG, 0) = 0 AND RDB$RELATION_TYPE = 0');
           
           return $tables;

        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
