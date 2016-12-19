<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  Route::get('/', function () {
  return view('welcome');
  });
 */

/* 首页 */
Route::get('/', function () {
    return view('welcome');
});
/* 后台管理部分处理 */
Route::Group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    /* 用户登陆 */
    Route::match(['get', 'post'], 'login', ['as' => 'admin.account.login', 'uses' => 'AccountController@login']);


    Route::group(['middleware' => ['auth.admin']], function() {
        /* 用户退出 */
        Route::get('logout', ['as' => 'admin.account.logout', 'uses' => 'AccountController@logout']);

        /* 修改密码 */
        Route::any('chpass', ['as' => 'admin.account.chpass', 'uses' => 'UserController@chpass']);

        /* 首页 */
        Route::resource('index', 'IndexController', ['only' => ['index']], function() {
            dd('welcome');
        });
        Route::get('index/sidebar', ['as' => 'sidebar', 'uses' => 'IndexController@sidebar']);

        /* 权限管理 */
        Route::resource('permission', 'PermissionController', ['except' => ['show']]);
        Route::get('permission/destroy', ['as' => 'admin.permission.destroy', 'uses' => 'PermissionController@destroy']);

        /* 角色管理 */
        Route::resource('role', 'RoleController', ['except' => ['show']]);
        Route::post('role/permission', ['as' => 'admin.role.permission', 'uses' => 'RoleController@permission']);
        Route::get('role/destroy', ['as' => 'admin.role.destroy', 'uses' => 'RoleController@destroy']);

        /* 用户删除 */
        Route::post('user/destroy', ['as' => 'admin.user.destroy', 'uses' => 'UserController@destroy']);
        /* 用户审核 */
        Route::post('user/verify', ['as' => 'admin.user.verify', 'uses' => 'UserController@verify']);
        /* 用户管理 */
        Route::resource('user', 'UserController', ['except' => ['show', 'destroy', 'chpass']]);
        Route::get('regidit/index', ['as' => 'admin.regidit.index', 'uses' => 'RegiditController@index']);
        /* 站点设置 */
        Route::any('setting/website', ['as' => 'admin.setting.website', 'uses' => 'SettingController@website']);
        /* 时间设置 */
        Route::any('setting/time', ['as' => 'admin.setting.time', 'uses' => 'SettingController@time']);
        /* 注册设置 */
        Route::any('setting/register', ['as' => 'admin.setting.register', 'uses' => 'SettingController@register']);
        /* 防灌水 */
        Route::any('setting/irrigation', ['as' => 'admin.setting.irrigation', 'uses' => 'SettingController@irrigation']);
        /* 积分设置 */
        Route::any('setting/credits', ['as' => 'admin.setting.credits', 'uses' => 'SettingController@credits']);
        /* 分类节点删除重新定义 */
        Route::any('websort/destroy', ['as' => 'admin.websort.destroy', 'uses' => 'WebSortController@destroy']);
        /* 网站分类管理 */
        Route::resource('websort', 'WebSortController', ['except' => ['destroy', 'show']]);
        /* 分类节点删除重新定义 */
        Route::any('websort/destroy', ['as' => 'admin.websort.destroy', 'uses' => 'WebSortController@destroy']);
        /* 根据分类层级获取分类 */
        Route::post('websort/content', ['as' => 'admin.websort.content', 'uses' => 'WebSortController@content']);
        /* 分类节点名称更新 */
        Route::post('websort/update', ['as' => 'admin.websort.update', 'uses' => 'WebSortController@update']);
        /* 分类排序管理 */
        Route::post('websort/sortdir', ['as' => 'admin.websort.sortdir', 'uses' => 'WebSortController@sortdir']);
        /* 网站列表管理 */
        Route::resource('website', 'WebsiteController', ['except' => ['destroy']]);
        Route::post('website/destroy', ['as' => 'admin.website.destroy', 'uses' => 'WebsiteController@destroy']);
        /* 网站链接样式管理 */
        Route::resource('style', 'StyleController', ['except' => ['destroy', 'show']]);
        Route::post('style/destroy', ['as' => 'admin.style.destroy', 'uses' => 'StyleController@destroy']);
        /* 网站推荐 */
        Route::resource('web_recomment', 'WebRecommentController', ['except' => ['destroy']]);
        Route::post('web_recomment/destroy', ['as' => 'admin.web_recomment', 'uses' => 'WebRecommentController@destroy']);
        /* 文章分类列表 */
        Route::resource('article', 'ArticleController', ['except' => ['destroy', 'show']]);
        Route::post('article/destroy', ['as' => 'admin.article.destroy', 'uses' => 'ArticleController@destroy']);
        /* 获取用户习惯输入 */
        Route::post('article/getChoice', ['as' => 'admin.article.getChoice', 'uses' => 'ArticleController@getChoice']);
        /* 文章置顶接口 */
        Route::post('article/top', ['as' => 'admin.article.top', 'uses' => 'ArticleController@top']);
        /* 微信公众号管理 */
        Route::resource('wx', "WxController", ['except' => ['destroy']]);
        Route::post('wx/destroy', ['as' => 'admin.wx.destroy', 'uses' => 'WxController@destroy']);
        /* 供需信息 */
        Route::resource('trade', 'TradeController', ['except' =>['show','destroy']]);
        /* 供需信息分类管理 */     
        Route::any('trade/district', ['as' => 'admin.trade.district', 'uses' => 'TradeController@district']);
        Route::any('trade/destroy', ['as' => 'admin.trade.destroy', 'uses' => 'TradeController@destroy']);
        /*供需信息管理*/
        Route::resource('demand','DemandController',['except'=>['destroy']]);
        Route::post('demand/destroy',['as'=>'admin.demand.destroy','uses'=>'DemandController@destroy']);
        /*用户反馈*/
        Route::resource('feedback','FeedbackController',['except'=>['destroy']]);
        
    });
});

Route::get('image/avatar/{avatar_name}', ['as' => 'website.image.avatar', 'uses' => 'ImageController@avatar'])->where(['avatar_name' => '[0-9]+_(small|big|middle)']);
/* 富文本上传图片 */
Route::post('image/upload', ['as' => 'website.image.upload', 'uses' => 'ImageController@upload']);
Route::post('image/uploadimg/{model?}', ['as' => 'website.image.uploadimg', 'uses' => 'ImageController@imgupload'])->where(['model' => '(product)']);
Route::get('image/show/{image_name}', ['as' => 'website.image.show', 'uses' => 'ImageController@show']);