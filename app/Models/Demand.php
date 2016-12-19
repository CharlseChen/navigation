<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-08 02:25:25
 * @copyright www.qdefense.cn
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Demand extends Model {

    protected $fillable=['title','url','views','rank','cate_id','created_at'];
    public function district() {
        return $this->belongsTo('App\Models\District', 'cate_id', 'id'); //第二个参数为本表中列名
    }

}
