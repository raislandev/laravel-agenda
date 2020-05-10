<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'email','user_id' 
    ];

    protected static $logAttributes = ['name', 'email','user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }
}
