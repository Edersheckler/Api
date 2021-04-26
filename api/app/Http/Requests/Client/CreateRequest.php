<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\ApiRequest;

class CreateRequest extends ApiRequest
{

    protected $statusCode = [
        'name' => '-A15.3',
        'email' => '-A15.4',
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:Usuarios',
    ];

}