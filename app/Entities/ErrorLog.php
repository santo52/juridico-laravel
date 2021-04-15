<?php

namespace App\Entities;

use \App\BaseModel;

class ErrorLog extends BaseModel
{
    protected $table = 'error_log';

    protected $primaryKey = 'id';

    protected $fillable = [
        'xhr', 'status', 'error',
        'created_at', 'updated_at', 'user_id'
    ];
}
