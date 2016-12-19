<?php

/**
 * @author CharlseChen <charlse_chen@qq.com>
 * @date 2016-10-24 02:38:48
 * @copyright www.qdefense.cn
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Mark;

class StyleController extends AdminController {

    /**
     * 首页
     * @return type
     */
    public function index() {
        $result = 0;
        $data = Mark::query()->get()->toArray();
        !empty($data) && $result = $data;
        return view('admin.linkstyle.index', ['list' => $result]);
    }

    /**
     * 创建页面
     * @return type
     */
    public function create() {
        return view('admin.linkstyle.create');
    }

    /**
     * 数据写入数据库
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $class_name = htmlspecialchars(trim($request->input('class_name')));
        //检查新增样式名是否已存在
        $check=Mark::query()->where('class_name',$class_name)->count();
        if($check!=0){
            return $this->error(route('admin.style.create'), "抱歉!提交的样式名已存在");
        }
        $result = Mark::insert(['class_name' => $class_name, 'created_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.style.index'), '保存成功');
        }
    }

    /**
     * 编辑页 
     * @param Request $request 
     * @param type $id 网站id
     * @return type
     */
    public function edit($id) {
        $data = Mark::query()->where('id', $id)->first();
        return view('admin.linkstyle.edit',['data'=>$data]);
    }
    /***
     * 更新数据
     */
    public function update(Request $request,$id){
        $para=$request->all();
        $result=  Mark::query()->where('id',intval($id))->update(['class_name'=>$para['class_name'],'updated_at'=>  \Carbon\Carbon::now()]);
        if($result){
            return $this->success(route('admin.style.index'), '更新成功');
        }
    }
    /**
     * 软删除数据
     * @param Request $request
     * @return type
     */
    public function destroy(Request $request) {
        $ids = $request->input('id');
        $delete_data = Mark::query()->whereIn('id', $ids);
        $result = $delete_data->delete();
        if ($result) {
            return $this->success(route('admin.style.index'), '删除成功');
        } else {
            return $this->error(route('admin.style.index'), '删除失败');
        }
    }

}
