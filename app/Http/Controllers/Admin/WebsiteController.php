<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-14 05:01:03
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Models\Website;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends AdminController {

    /**
     * 网站列表首页
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $filter = $request->all();
        $query = Website::query();
        if (isset($filter['id']) && $filter['id'] > 0) {
            $query->where('web_id', '=', intval($filter['id']));
        }

        /* 网站名称查询 */
        if (isset($filter['word']) && $filter['word']) {
            $query->where('web_name', 'like', '%' . $filter['word'] . '%');
        }
        /* 网站分类查询 */
        if (isset($filter['sort']) && $filter['sort']) {
            $cate_id = Categorie::where('cate_name', 'like', '%' . $filter['sort'] . '%')->first(['cate_id']);
            $query->where('cate_id', '=', $cate_id->cate_id);
        }
        /* 创建时间过滤 */
        if (isset($filter['date_range']) && $filter['date_range']) {
            $query->whereBetween('created_at', explode(" - ", $filter['date_range']));
        }
        $lists = $query->orderBy('created_at', 'desc')->paginate(config('website.admin.page_size'));
        return view('admin.website.index', ['list' => $lists, 'filter' => $filter]);
    }

    /**
     * 新增网站页
     * @return type
     */
    public function create() {
        //获取网站分类树相关数据
        $data = Categorie::query()->where('cate_mod', '=', 'webdir')->orderBy('root_id', 'asc')->orderBy('cate_sort', 'asc')->orderBy('updated_at', 'desc')->get()->toArray();
        if (!empty($data)) {
            $result = Categorie::tree($data, $pid = 0);
        } else {
            $result = array();
        }
        $mark_css = Mark::query()->get()->toArray();
        return view('admin.website.create', ['list' => $result, 'mark_css' => $mark_css]);
    }

    /**
     * 软删除
     * @param Request $request
     * @return type
     */
    public function destroy(Request $request) {
        $ids = $request->input('id');
        $delete_data = Website::query()->whereIn('web_id', $ids);
        $result = $delete_data->delete();
        if ($result) {
            return $this->success(route('admin.website.index'), '删除成功');
        } else {
            return $this->error(route('admin.website.index'), '删除失败');
        }
    }

    /**
     * 新增数据提交至数据库
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $data = $request->all();
        $web_pic = "";
        $web_intro = "";
        $web_rank = 0;
        $validate = ['web_name' => 'required|max:80', 'web_url' => 'required|active_url'];
        $validate_message = ['web_name.required' => '请输入网站名称', 'web_name.max' => '网站名称过长', 'web_url.required' => '请输入网站地址', 'web_url.active_url' => '您输入网站地址为无效地址'];
        $this->validate($request, $validate, $validate_message);
        isset($data['web_intro']) && $web_intro = $data['web_intro'];
        isset($data['web_rank']) && $web_rank = $data['web_rank'];
        $file_path = Website::getUploadPath();
        if ($request->hasFile('web_pic')) {
            $file = $request->file('web_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $web_pic = Website::getUploadPath($filename);
        }
        $result = Website::insert(['web_name' => $data['web_name'], 'user_id' => Auth()->id(), "cate_id" => intval($data['cate_id']), 'web_url' => $data['web_url'], 'web_intro' => $web_intro, 'web_pic' => $web_pic, 'web_rank' => $web_rank, 'web_mark_type' => $data['web_mark_type'], 'created_at' => \Carbon\Carbon::now(), 'web_status' => $data['web_status']]);
        if ($result) {
            return $this->success(route('admin.website.index'), '添加成功');
        }
    }

    /**
     * 网站信息编辑页 
     * @param Request $request 
     * @param type $id 网站id
     * @return type
     */
    public function edit(Request $request, $id) {
        $data = Website::query()->where('web_id', $id)->first();
        //获取网站分类树相关数据
        $datas = Categorie::query()->where('cate_mod', '=', 'webdir')->orderBy('root_id', 'asc')->orderBy('cate_sort', 'asc')->orderBy('updated_at', 'desc')->get()->toArray();
        if (!empty($datas)) {
            $result = Categorie::tree($datas, $pid = 0);
        } else {
            $result = array();
        }
        $mark_css = Mark::query()->get()->toArray();
        return view('admin.website.edit', ['list' => $data, 'lists' => $result, 'mark_css' => $mark_css]);
    }

    /**
     * 站点信息更新
     * @param Request $request
     * @return type
     */
    public function update(Request $request) {
        $data = $request->all();
        $web_pic = "";
        $web_intro = "";
        $web_rank = 0;
        $validate = ['web_name' => 'required|max:80', 'web_url' => 'required|active_url'];
        $validate_message = ['web_name.required' => '请输入网站名称', 'web_name.max' => '网站名称过长', 'web_url.required' => '请输入网站地址', 'web_url.active_url' => '您输入网站地址为无效地址'];
        $this->validate($request, $validate, $validate_message);
        isset($data['web_intro']) && $web_intro = $data['web_intro'];
        isset($data['web_rank']) && $web_rank = $data['web_rank'];
        $file_path = Website::getUploadPath();
        if ($request->hasFile('web_pic')) {
            $file = $request->file('web_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $web_pic = Website::getUploadPath($filename);
        }
        $result = Website::where('web_id', intval($data['web_id']))->update(['web_name' => $data['web_name'], 'user_id' => Auth()->id(), "cate_id" => intval($data['cate_id']), 'web_url' => $data['web_url'], 'web_intro' => $web_intro, 'web_pic' => $web_pic, 'web_rank' => $web_rank, 'web_mark_type' => $data['web_mark_type'], 'updated_at' => \Carbon\Carbon::now(), 'web_status' => $data['web_status']]);
        if ($result) {
            return $this->success(route('admin.website.index'), '更新成功');
        }
    }

}
