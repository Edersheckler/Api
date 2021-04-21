<?php

namespace App\Logics\Messages;

use Log;
use Illuminate\Support\Collection;


class MessagesLogic
{
    
    protected $collection;
    protected $status = [];

    public function __construct($collection = null)
    {
        if( is_null($collection)) {
            $this->collection = new Collection([]);
        }
    }
    
    public function setStatusError($code, $data = [])
    {
        $message = $this->getMessageCode($code, $data);
        
        if( !$message) {
            $message = 'Error code no definido';
            Log::info($message);
        } else {
            Log::error($message);
        }
        
        $this->status = [
            'code'=>$code,
            'message'=>$message
        ];
    }
    
    public function setStatusOk($code, $data = [])
    {
        $message = $this->getMessageCode($code, $data);
        
        if( !$message) {
            $message = 'Status code no defined';
            Log::info($message);
        } else {
            Log::debug($message);
        }
        
        $this->status = [
            'code'=>$code,
            'message'=>$message
        ];
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getAll()
    {
        if( in_array(config('app.env'), [
            'local',
            'testing',
        ])) {
            return $this->collection->all();
        }
        return $this->getErrors();
    }
    
    public function getErrors()
    {        
        return $this->collection->where('type', 'error')->map(function($record) {
            return collect($record)->toArray();
        })->values()->toArray();
    }
    
    public function getMessageCode($code, $data = [])
    {
        static $status = null;
        
        if( !$status) {
            $status = config('status');
        }
        
        $message = isset($status[$code]) ? $status[$code] : null;
        
        if( !empty($data) && !is_null($message)) {
            $message = $this->interpolate($message, $data);
        }
        
        return $message;
    }
    
    public function addMessage($message)
    {
        $this->collection->push($message);
    }
    
    public function mergeDefault(&$arregloBase, $arrayDefault)
    {        
        foreach($arrayDefault as $key => $val) {

            if (isset($arregloBase[$key])) {
                $arrayDefault[$key] = $arregloBase[$key];
                unset($arregloBase[$key]);
            } else {                
                $arrayDefault = array_merge($arregloBase, $arrayDefault);                
            }

        }
        
        return array_merge($arregloBase, $arrayDefault);        
    }
    
    public function interpolate($template, array $context = [])
    {        
        /* build a replacement array with braces around the context keys */
        $keysReplace = [];
        foreach($context as $key => $val) {
            
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                
                $keysReplace['{'.$key.'}'] = $val;
                
            }            
            
        }
        
        /* interpolate replacement values into the message and return */
        return strtr($template, $keysReplace);        
    }
    
}