<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-08 02:40:18
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\District;

class DemandController extends AdminController {

    public function index(Request $request) {
        $filter = $request->all();
        $query = Demand::query();
        if (isset($filter['id']) && $filter['id'] > 0) {
            $query->where('id', '=', intval($filter['id']));
        }

        /* 网站名称查询 */
        if (isset($filter['word']) && $filter['word']) {
            $query->where('title', 'like', '%' . $filter['word'] . '%');
        }
        /* 创建时间过滤 */
        if (isset($filter['date_range']) && $filter['date_range']) {
            $query->whereBetween('created_at', explode(" - ", $filter['date_range']));
        }
        $list = $query->orderBy('created_at', 'desc')->paginate(config('website.admin.page_size'));
        return view('admin.demand.index', ['list' => $list]);
    }

    public function create() {
        //获取分类信息
        $sort_list = District::all()->toArray();
        return view('admin.demand.create', ['list' => $sort_list]);
    }

    public function store(Request $request) {

        $data = $request->all();
        $validate = ['title' => 'required', 'url' => 'required|active_url'];
        $msg = ['title.required' => '请输入标题', 'url.required' => '请输入链接地址', 'url.active_url' => '请输入有效的链接'];
        $this->validate($request, $validate, $msg);
        $result = Demand::insert(['title' => $data['title'], 'url' => $data['url'], 'rank' => $data['rank'], 'cate_id' => $data['cate_id'], 'status' => $data['status'], 'created_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.demand.index'), '添加成功');
        }
    }

    public function edit($id) {
        //获取分类信息
        $sort_list = District::all()->toArray();
        $query = Demand::query()->where('id', $id)->first();
        return view('admin.demand.edit', ['data' => $query, 'list' => $sort_list]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $validate = ['title' => 'required', 'url' => 'required|active_url'];
        $msg = ['title.required' => '请输入标题', 'url.required' => '请输入链接地址', 'url.active_url' => '请输入有效的链接'];
        $this->validate($request, $validate, $msg);
        $result = Demand::where('id', $id)->update(['title' => $data['title'], 'url' => $data['url'], 'rank' => $data['rank'], 'status' => $data['status'], 'cate_id' => $data['cate_id'], 'updated_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.demand.index'), '更新成功');
        }
    }

    public function destroy(Request $request) {
        $data = $request->all();
        $result = Demand::destroy($data['id']);
        if($result){
            return $this->success(route('admin.demand.index'), '删除成功');
        }
    }

}
