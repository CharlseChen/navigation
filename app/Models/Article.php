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

class Article extends Model {
    protected $fillable=['user_id','art_id','cate_id','art_title','copy_name','copy_url','art_intro','art_content','art_views','art_rank','art_status','art_isbest','art_re_time'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function mark(){
        return $this->belongsTo('App\Models\Mark','art_mark_type','id');//第二个参数为本表中列名
    }
    public function websort(){
        return $this->hasOne('App\Models\categorie', 'cate_id', 'cate_id');
    }
}