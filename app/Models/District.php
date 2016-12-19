<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-07 02:47:55
 * @copyright www.qdefense.cn
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class District extends Model {

    protected $fillable = ['name', 'pic', "status", 'created_at'];

    /**
     * 图片上传地址
     * @param string $fileName
     */
    public static function getUploadPath($fileName = '') {
        return empty($fileName) ? 'static/upload/trade/' . gmdate("Y") . "/" . gmdate("m") : 'trade-' . gmdate("Y") . '-' . gmdate("m") . '-' . $fileName;
    }

}
