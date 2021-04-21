<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

abstract class ApiRequest extends FormRequest
{
    
    protected $statusCode = '';
    protected $rules = [];
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function withValidator($validator)
    {
        $validator->statusCode = $this->getStatusCode();
    }  
    
    public function rules()
    {
        return $this->rules;
    }
    
    public function authorize()
    {
        return true;
    }
    
    public function allValid()
    {        
        return $this->only(array_keys($this->rules()));
    }

    protected function failedValidation(Validator $validator) {
        $validator->statusCode = $this->getStatusCode();
        throw new HttpResponseException(response()->validationException($validator));
    }
    
}