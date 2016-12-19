<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-11-01 05:37:32
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Models\Article;
use App\Models\Mark;
use App\Models\Copycount;
use App\Models\Wx;

class WxController extends AdminController {

    public function index(Request $request) {
        $filter = $request->all();
        $query = Wx::query();
        if (isset($filter['id']) && $filter['id'] > 0) {
            $query->where('id', '=', intval($filter['wx_id']));
        }

        /* 网站名称查询 */
        if (isset($filter['word']) && $filter['word']) {
            $query->where('wx_name', 'like', '%' . $filter['word'] . '%');
        }
        /* 创建时间过滤 */
        if (isset($filter['date_range']) && $filter['date_range']) {
            $query->whereBetween('created_at', explode(" - ", $filter['date_range']));
        }
        $lists = $query->orderBy('created_at', 'desc')->paginate(config('website.admin.page_size'));
        return view('admin.wx.wx', ['list' => $lists, 'filter' => $filter]);
    }

    public function create() {
        return view('admin.wx.create');
    }

    public function store(Request $request) {
        $data = $request->all();
        $wx_pic="";
        $validate = ['wx_name' => 'required', 'wx_id' => 'required','wx_pic'=>'required'];
        $messege = ['wx_name.required' => '请输入公众号名称', 'wx_id.required' => '请输入公众号ID','wx_pic.required'=>'请上传公众号头像'];
        $wx_two_dimension = "http://open.weixin.qq.com/qr/code/?username=" . $data['wx_id'];
        $this->validate($request, $validate, $messege);
        //通过校验二维码是地址是否存在,间接判断公众号是否有效
        $validator = $this->getValidationFactory()->make(['wx_two_dimension' => $wx_two_dimension], ['wx_two_dimension' => 'active_url'], ['wx_two_dimension.active_url' => '您输入的公众号ID不存在,请复检!']);
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $file_path = Wx::getUploadPath();
        //将生成的二维码存储在本地
        $wx_td_code = Wx::getImage($wx_two_dimension, public_path($file_path), uniqid(str_random(8)) . '.' . 'jpg', 1);
        $wx_td_save = Wx::getUploadPath($wx_td_code['file_name']);
        //存储用户上传图片
        if ($request->hasFile('wx_pic')) {
            $file = $request->file('wx_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $wx_pic = Wx::getUploadPath($filename);
        }
        $result = Wx::insert(['wx_name' => $data['wx_name'], 'wx_id' => $data['wx_id'], 'wx_two_dimension' => $wx_td_save, 'wx_pic' => $wx_pic, 'wx_rank' => intval($data['wx_rank']), 'status' => intval($data['status']), 'created_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.wx.index'), '添加成功!');
        }
    }

    public function edit(Request $request, $id) {
        $data = Wx::query()->where('id', $id)->first()->toArray();
        return view('admin.wx.edit', ['data' => $data]);
    }

    /**
     * 更新
     * @param Request $request
     */
    public function update(Request $request,$id) {
        $data = $request->all();
        $wx_pic="";
        $validate = ['wx_name' => 'required', 'wx_id' => 'required'];
        $messege = ['wx_name.required' => '请输入公众号名称', 'wx_id.required' => '请输入公众号ID'];
        $wx_two_dimension = "http://open.weixin.qq.com/qr/code/?username=" . $data['wx_id'];
        $this->validate($request, $validate, $messege);
        //通过校验二维码是地址是否存在,间接判断公众号是否有效
        $validator = $this->getValidationFactory()->make(['wx_two_dimension' => $wx_two_dimension], ['wx_two_dimension' => 'active_url'], ['wx_two_dimension.active_url' => '您输入的公众号ID不存在,请复检!']);
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $file_path = Wx::getUploadPath();
        //将生成的二维码存储在本地
        $wx_td_code = Wx::getImage($wx_two_dimension, public_path($file_path), uniqid(str_random(8)) . '.' . 'jpg', 1);
        $wx_td_save = Wx::getUploadPath($wx_td_code['file_name']);
        if ($request->hasFile('wx_pic')) {
            $file = $request->file('wx_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $wx_pic = Wx::getUploadPath($filename);
        }
        $result = Wx::where('id', $id)->update(['wx_name' => $data['wx_name'], 'wx_id' => $data['wx_id'], 'wx_two_dimension' => $wx_td_save, 'wx_pic' => $wx_pic, 'wx_rank' => intval($data['wx_rank']), 'status' => intval($data['status']), 'updated_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.wx.index'), '更新成功!');
        }
    }

    /**
     * 软删除
     * @param Request $request
     * @return type
     */
    public function destroy(Request $request) {
        $ids = $request->input('id');
        $delete_data = Wx::query()->whereIn('id', $ids);
        $result = $delete_data->delete();
        if ($result) {
            return $this->success(route('admin.wx.index'), '删除成功');
        } else {
            return $this->error(route('admin.wx.index'), '删除失败');
        }
    }

}
