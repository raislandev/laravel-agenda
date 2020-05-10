<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    
    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'causer_id',
        'causer_type',
        'properties'
    ];

    
}
