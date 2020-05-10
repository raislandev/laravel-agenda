<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Phone extends Model
{
    use LogsActivity;

    protected $fillable = [
        'phone','client_id'
    ];

    protected static $logAttributes = ['name', 'client_id'];


    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
