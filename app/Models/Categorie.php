<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categorie extends Model {

    protected $fillable=['cate_id','root_id','cate_mod','cate_name','cate_isbest','cate_order'];
    static public $treeList = array(); //存放无限分类结果如果一页面有多个无限分类可以使用 Tool::$treeList = array(); 清空
    /**
     * 无限级分类
     * @access public 
     * @param Array $data     //数据库里获取的结果集 
     * @param Int $pid             
     * @param Int $count       //第几级分类
     * @return Array $treeList   
     */
    public static function tree(&$data,$pid = 0,$count = 1) {
        foreach ($data as $key => $value){
            if($value['root_id']==$pid){
                $value['Count'] = $count;
                self::$treeList []=$value;
                self::tree($data,$value['cate_id'],$count+1);
            } 
        }
        return self::$treeList ;
    }
    /**
     * 无限极分类菜单(此方法测试通过,考虑到性能暂时不使用)
     * @param type $pid
     * @param type $cate
     * @param type $arr
     * @param type $deep
     * @return type
     */
    public static function getLists($pid = 0, $cate,&$arr=array(),$deep=1) {        
        foreach ($cate as $k=> $v) {
            if ($v['root_id'] == $pid) {
                $arr[] =  str_repeat('&nbsp;&nbsp;&nbsp;', $deep).'|---'.$v['cate_name'];                
                $arr = array_merge($arr, self::getLists($v['cate_id'], $cate, ++$deep));
                --$deep;
            }
        }
        return $arr;
    }
}
