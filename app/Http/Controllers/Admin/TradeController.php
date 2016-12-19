<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-07 09:21:16
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\District;

class TradeController extends AdminController {

    public function district() {
        $query = District::query();
        $lists = $query->orderBy('created_at', 'desc')->paginate(config('website.admin.page_size'));
        return view('admin.trade.district', ['list' => $lists]);
    }

    public function create() {
        return view('admin.trade.district_e');
    }

    public function store(Request $request) {
        $data = $request->all();
        $validate = ['name' => 'required', 'pic' => 'required'];
        $msg = ['name.required' => '请填写需求信息分类名称', 'pic.required' => '请上传分类封面'];
        $this->validate($request, $validate, $msg);
        isset($data['rank']) ? $rank = $data['rank'] : $rank = "";
        if ($request->hasFile('pic')) {
            $file_path = District::getUploadPath();
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $pic = District::getUploadPath($filename);
        }
        $result = District::insert(['name' => $data['name'], 'pic' => $pic, 'rank' => intval($rank), 'status' => intval($data['status']), 'created_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.trade.district'), '添加成功');
        }
    }

    public function edit($id) {
        $data = District::query()->where('id', $id)->first();
        return view('admin.trade.edit', ['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $validate = ['name' => 'required'];
        $msg = ['name.required' => '请填写需求信息分类名称'];
        $this->validate($request, $validate, $msg);
        isset($data['rank']) ? $rank = $data['rank'] : $rank = "";
        $pic = "";
        if ($request->hasFile('pic')) {
            $file_path = District::getUploadPath();
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $pic = District::getUploadPath($filename);
        }
        $update_data = ['name' => $data['name'], 'rank' => intval($rank), 'status' => intval($data['status']), 'updated_at' => \Carbon\Carbon::now()];
        !empty($pic) && $update_data['pic'] = $pic;
        $result = District::where('id', $id)->update($update_data);
        if ($result) {
            return $this->success(route('admin.trade.district'), '更新成功');
        }
    }

    public function destroy(Request $request) {
        $data = $request->all();
        if (!empty($data['id'])) {
            $result = District::destroy($data['id']);
        }
        if ($result) {
            return $this->success(route('admin.trade.district'), "删除成功");
        }
    }

}
