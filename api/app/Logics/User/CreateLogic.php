<?php

namespace App\Logics\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateLogic
{

    protected $repository;

    public function __construct(
        User $repository
    )
    {
        $this->repository = $repository;
    }

    public function init($input)
    {
        $input['password'] = Hash::make($input['password']);
        $user = $this->repository->create( $input );

        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        return $data;
    }
}