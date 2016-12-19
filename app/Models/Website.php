<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-17 10:24:00
 * @copyright www.qdefense.cn
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Website extends Model {

    protected $fillable = ['user_id', 'cate_id', 'web_name', 'web_url', 'web_url', 'web_pic', 'web_intro', 'web_istop', 'web_isbest', 'web_islink', 'web_grank', 'web_status'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function mark() {
        return $this->belongsTo('App\Models\Mark', 'web_mark_type', 'id'); //第二个参数为本表中列名
    }

    public function websort() {
        return $this->hasOne('App\Models\categorie', 'cate_id', 'cate_id');
    }

    /**
     * 图片上传地址
     * @param string $fileName
     */
    public static function getUploadPath($fileName = '') {
        return empty($fileName) ? 'static/upload/salon/' . gmdate("Y") . "/" . gmdate("m") : 'salon-' . gmdate("Y") . '-' . gmdate("m") . '-' . $fileName;
    }

}
