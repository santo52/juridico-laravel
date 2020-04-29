<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'error_log';

    protected $primaryKey = 'id';

    protected $fillable = [
        'xhr', 'status', 'error',
        'created_at', 'updated_at', 'user_id'
    ];
}
