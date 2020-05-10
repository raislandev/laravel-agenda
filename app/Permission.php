<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'description' 
    ];

    protected static $logAttributes = ['name', 'description'];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
} 
