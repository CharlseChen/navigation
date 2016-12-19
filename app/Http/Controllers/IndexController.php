<?php
namespace App\Http\Controllers;

use Log;


class IndexController extends Controller
{
    public function home()
    {
        $wechat = app('wechat');
        $userService = $wechat->user;
        
        $users = $userService->lists();
        
        dd($users);
        
    }
}