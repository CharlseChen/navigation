<?php

/**
 * 推荐相关控制器
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-25 05:24:38
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class WebRecommentController extends AdminController {

    public function index(Request $request) {
        $data = $request->all();
        if ($data['type'] == 'web') {
            $result = Website::query()->where('web_id', $data['id'])->update(['web_isbest' => !$data['status'], 'web_re_time' => \Carbon\Carbon::now()]);
            $msg = $data['status'] ? '已取消推荐' : '推荐成功';
            if ($result) {
                return $this->success(route('admin.website.index'), $msg);
            }
        } else {
            //文章推荐
            $result = Article::query()->where('art_id', $data['id'])->update(['art_isbest' => !$data['status'], 'art_re_time' => \Carbon\Carbon::now()]);
            $msg = $data['status'] ? '已取消推荐' : '推荐成功';
            if ($result) {
                return $this->success(route('admin.article.index'), $msg);
            }
        }
    }

}
