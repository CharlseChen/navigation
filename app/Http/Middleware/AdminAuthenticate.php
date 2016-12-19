<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      //  echo $request->route()->getName();
        

//        if(!$request->user()->is('admin')){
//            abort(403);
//        }

        
        
        //dd($request->user()->can('admin.user.index'));
        //dd($request->route()->getName());
        //检查是否登录
        if(!$request->user()){
            return redirect(route('admin.account.login'));
        }
//        dd($request->user());
        //超级管理员，不检查权限
//        if(!$request->user()->is('admins'))
//        {
//            if(config('game.admin_permission')){
//                //检查是否有权限
//                if(!$request->user()->can($request->route()->getName()))
//                {
//                    //return redirect()->to(route('admin.index.index'));
//                }
//            }
//        }
        //dd($request->user(),$request->user()->is('admin'));
          
        if(!$request->session()->get('admin.login') && $request->route()->getName() !== 'admin.account.login'){
            return redirect(route('admin.account.login'));
        }      
        return $next($request);
    }
}
