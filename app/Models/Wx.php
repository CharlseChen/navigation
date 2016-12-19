<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-03 09:30:02
 * @copyright www.qdefense.cn
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wx extends Model {

    protected $fillable = ['id', 'wx_name', 'wx_id', 'wx_pic', 'wx_two_dimension', 'status'];

    use SoftDeletes;

    /**
     * 图片上传地址
     * @param string $fileName
     */
    public static function getUploadPath($fileName = '') {
        return empty($fileName) ? 'static/upload/navigation/' . gmdate("Y") . "/" . gmdate("m") : 'navigation-' . gmdate("Y") . '-' . gmdate("m") . '-' . $fileName;
    }

    /*
     * 功能：php完美实现下载远程图片保存到本地 
     * 参数：文件url,保存文件目录,保存文件名称，使用的下载方式 
     * 当保存文件名称为空时则使用远程文件原来的名称 
     */

    public static function getImage($url, $save_dir = '', $filename = '', $type = 0) {
        if (trim($url) == '') {
            return array('file_name' => '', 'save_path' => '', 'error' => 1);
        }
        if (trim($save_dir) == '') {
            $save_dir = './';
        }
        if (trim($filename) == '') {//保存文件名 
            $ext = strrchr($url, '.');
            if ($ext != '.gif' && $ext != '.jpg') {
                return array('file_name' => '', 'save_path' => '', 'error' => 3);
            }
            $filename = time() . $ext;
        }
        if (0 !== strrpos($save_dir, '/')) {
            $save_dir.='/';
        }
        //创建保存目录 
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return array('file_name' => '', 'save_path' => '', 'error' => 5);
        }
        //获取远程文件所采用的方法 
        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img); 
        //文件大小 
        $fp2 = @fopen($save_dir . $filename, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img, $url);
        return array('file_name' => $filename, 'save_path' => $save_dir . $filename, 'error' => 0);
    }

}
