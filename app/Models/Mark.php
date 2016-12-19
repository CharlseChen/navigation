<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-19 10:19:00
 * @copyright www.qdefense.cn
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Mark extends Model {
    protected $fillable=['class_name','id','created_at'];
    use SoftDeletes;
}
