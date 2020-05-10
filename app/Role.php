<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Role extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'description'
    ];

    protected static $logAttributes = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
