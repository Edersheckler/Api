<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'oauth_clients';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'name',
        'secret'
    ];

    public function scopeCredentials($query, $id,$secret)
    {
        return $query->where('id' , $id)
                ->where( 'secret', $secret);
    }

}