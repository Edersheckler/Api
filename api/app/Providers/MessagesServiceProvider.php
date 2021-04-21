<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Logics\Messages\MessagesLogic;

class MessagesServiceProvider extends ServiceProvider
{
    
    protected $defer = true;
    
    public function boot()
    {
        $this->app->singleton('messages', function() {
            return new MessagesLogic();
        });
    }
    
    public function provides()
    {
        return [
            'messages'
        ];
      }
}