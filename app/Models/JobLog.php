<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLog extends Model
{
    use HasFactory;

    protected $table = 'job_logs';

    protected $fillable = [
        'productKey',
        'productName',
        'destination'
    ];
}
