<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

class CreateRequest extends ApiRequest
{

    protected $statusCode = [
        'name' => '-A15.3',
        'email' => '-A15.4',
        'password' => '-A15.5',
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ];

}