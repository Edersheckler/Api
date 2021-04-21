<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Logics\User\CreateLogic;
use App\Http\Requests\User\CreateRequest;

class UserController extends Controller
{
  public function create(
    CreateRequest $request,
    CreateLogic $logic
  ) {
    $result = $logic->init($request->allValid());

    return response()->create($result);
  }
}
