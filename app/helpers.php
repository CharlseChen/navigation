<?php


use Illuminate\Support\Facades\Auth;
/**
 * 获取app name
 */
if (! function_exists('app_name')) {

    function app_name(){
        return config('app.app_name');
    }
        

}


/*数据库setting表操作*/
if (! function_exists('Setting')) {

    function Setting(){
        return app('App\Models\Setting');
    }

}

/*数据库area地区表操作*/
if (! function_exists('Area')) {

    function Area(){
        return app('App\Models\Area');
    }

}

/*公告状态文字定义*/
if (! function_exists('get_status')) {

    function get_status($status,$map=[]){
        if(empty($map)){
            $map = [
                1 => '开启',
                0 => '关闭',
            ];
        }
        if($status==='all'){
            return $map;
        }
        if(isset($map[$status])){
            return $map[$status];
        }
        return '';
    }

}

/*公告状态文字定义*/
if (! function_exists('trans_common_status')) {

    function trans_common_status($status){
        $map = [
            0 => '待审核',
            1 => '已审核',
        ];

        if($status==='all'){
            return $map;
        }


        if(isset($map[$status])){
            return $map[$status];
        }

        return '';

    }

}


/*问题状态文本描述定义*/
if (! function_exists('trans_question_status')) {

    function trans_question_status($status){
        $map = [
            0 => '待审核',
            1 => '待解决',
            2 => '已解决',
        ];

        if($status==='all'){
            return $map;
        }

        if(isset($map[$status])){
            return $map[$status];
        }

        return '';
    }

}

/**
 * 检查用户权限，显示菜单
 */
if(!function_exists('get_menu_view'))
{
    function get_menu_view($route,$param=null)
    {
        $user = Auth::user();
        if($user->is('admins')){
            //超级管理员，不做检查
            if(empty($param)){
            $return = 'href="'.route($route).'"';
            }else{
                $return='href="'.route($route,$param).'"';
            }
        }else{
            if($user->can($route)){
                if(empty($param)){
                $return = 'href="'.route($route).'"';
                }else{
                    $return='href="'.route($route,$param).'"';
                }
            }else{
                if(config('game.admin_permission')){
                    $return = 'class="hidden"';
                }else{
                    if(empty($param)){
                    $return = 'href="'.route($route).'"';
                    }else{
                        $return='href="'.route($route).'"';
                    }
                }
            }
        }
        return $return;
    }
}



