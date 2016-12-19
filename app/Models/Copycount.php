<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-31 11:10:22
 * @copyright www.qdefense.cn
 */
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Copycount extends Model {
    protected $fillable=['web_name','count'];
    /**
     * 统计用户输入习惯
     * @param type $copy_name
     */
    public static  function countOne($copy_name){
        $data=self::where('web_name',$copy_name)->first();
        if($data!=null&&$data->count()!==0){
            $data->increment('count');
            $data->save();
        }else{
            self::insert(['web_name'=>$copy_name,'count'=>1,'created_at'=>  \Carbon\Carbon::now()]);
        }
    }
}
