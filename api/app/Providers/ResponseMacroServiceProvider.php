<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Validation\Validator;
use Laravel\Lumen\Http\ResponseFactory;

class ResponseMacroServiceProvider extends ServiceProvider
{
    
    public function responseDelete($value)
    {
        $data = $this->addDefaultResult($value);        
        $this->addBenchMark($data);
        
        if( $value) {
            $data ['data']= $value;
        }
        
        $this->addStatus($data);
        return $this->responseJson($data, 200);
    }
        
    public function responseCreate($value)
    {        
        $data = $this->addDefaultResult($value);        
        
        $this->addBenchMark($data);

        if( $value) {
            $data ['data']= $value;
        }

        $this->addStatus($data);

        return $this->responseJson($data, $value ? 201 : 422);        
    }
    
    public function responseData($value, $status = 200)
    {
        $data = $this->addDefaultResult($value);        
        
        $this->addBenchMark($data);
        
        if( $value) {
            $data ['data']= $value;
        }
        
        $this->addStatus($data);
        
        return $this->responseJson($data, $status);        
    }
    
    public function responseDataNull($value, $status = 200)
    {
        $data = $this->addDefaultResult($value);        
        
        $this->addBenchMark($data);
        
        $data ['data']= $value;
        
        $this->addStatus($data);
        
        return $this->responseJson($data, $status);        
    }
    
    public function responsePaging($value, $status = 200)
    {        
        $data = $this->addDefaultResult($value);        
        
        $this->addBenchMark($data);
        
        if( $value) {
            $data ['data']= $value;
        }

        $this->addStatus($data);

        return $this->responseJson($data, $status);        
    }
    
    public function boot()
    {        
        ResponseFactory::macro('create', [$this, 'responseCreate']);
        ResponseFactory::macro('delete', [$this, 'responseDelete']);
        ResponseFactory::macro('data', [$this, 'responseData']);
        ResponseFactory::macro('dataNull', [$this, 'responseDataNull']);
        ResponseFactory::macro('paging', [$this, 'responsePaging']);        
        ResponseFactory::macro('unauthenticated', [$this, 'responseUnauthenticated']);        
        ResponseFactory::macro('unauthorized', [$this, 'responseUnauthorized']);
        ResponseFactory::macro('validationException', [$this, 'responseValidationException']);
    }
    
    public function responseValidationException(Validator $validator)
    {
        $errors = $validator->getMessageBag()->toArray();
        $messages = app('messages');
        
        foreach($errors as $field => $fieldErrors) {
            foreach($fieldErrors as $message) {
                if( isset($validator->statusCode) && isset($validator->statusCode[$field])) {
                    $messages->setStatusError($validator->statusCode[$field]);
                } else {
                    $messages->setStatusError(false);
                }
            }
            /* only first error */
            break;
        }
        
        return response()->json([
            'success'=>false,
            'status'=>$messages->getStatus()
        ], 422);
    }
    
    public function responseUnauthenticated()
    {
        $messages = app('messages');
        $messages->setStatusError('-S5.0');
        return response()->json([
            'success'=>false,
            'status'=>$messages->getStatus()
        ], 401);
    }
    
    public function responseUnauthorized($message)
    {
        $data = $this->addDefaultResult($message);
        return response()->json($data, 401);
    }
    
    public function responseJson(&$value, $status = 200)
    {        
        if( $value !== false) {
            return response()->json($value, $status);
        }

        return response()->json($value, $status);        
    }
    
    public function addDefaultResult(&$value)
    {        
        return [
            'success'=>$value ? true : false,
        ];        
    }
    
    public function addStatus(&$data)
    {
        $data ['status']= app('messages')->getStatus();
    }
    
    public function addBenchMark(&$data)
    {        
        if( env('APP_ENV') === 'local') {                
            $data ['benchmark']= round(memory_get_usage() / 1024 / 1024, 2) . 'MB';
        }        
    }
        
}