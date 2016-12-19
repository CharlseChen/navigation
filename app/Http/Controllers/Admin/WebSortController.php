<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class WebSortController extends AdminController {
    /* 权限验证规则 */

    protected $validateRules = [
        'cate_name' => 'required|max:60',
    ];

    /**
     * 分类管理首页 
     * @return type
     */
    public function index(Request $request) {
        //获取网站分类树相关数据
        $cate_mod=$request->input('cate_mod');
        $data = Categorie::query()->where('cate_mod', '=', $cate_mod)->orderBy('root_id', 'asc')->orderBy('cate_sort', 'asc')->orderBy('updated_at', 'desc')->get()->toArray();
        if (!empty($data)) {
            $result = Categorie::tree($data, $pid = 0);
        } else {
            $result = array();
        }
        //获取新增网站分类相关数据
        $max_level = Categorie::query()->where('cate_mod', '=', $cate_mod)->max('level');

        //当数据库中尚未添加目录信息的情况下
        empty($max_level) && $max_level = 0;
        return view('admin.websort.list', ['list' => $result, 'max_level' => $max_level,'cate_mod'=>$cate_mod]);
    }

    /**
     * 删除分类节点
     * @param Request $request
     */
    public function destroy(Request $request) {
        $post_param = $request->all();
        $ids_pre = explode("   ", rtrim($post_param['delete_ids']));
        sort($ids_pre, SORT_NUMERIC);
        //获取网站分类树相关数据
        $data = Categorie::query()->where('cate_mod', '=', $post_param['cate_mod'])->orderBy('root_id', 'asc')->get(['cate_id', 'root_id'])->toArray();
        $c_id = array();
        foreach ($ids_pre as $k => $id) {
            //如果循环数组中的节点为前面节点的子节点,则跳过 
            if (in_array($id, $c_id)) {
                continue;
            }
            //获取删除节点的所有子节点 
            $result = Categorie::tree($data, $id);
            if (!empty($result)) {
                foreach ($result as $v) {
                    $c_id[] = $v['cate_id'];
                }
            }
        }
        $ids = array_unique(array_merge($ids_pre, $c_id));
        $result = Categorie::whereIn('cate_id', $ids)->delete();
        return $this->success(route("admin.websort.index",['cate_mod'=>$post_param['cate_mod']]), '删除成功!');
    }

    /**
     * 添加新节点时,供用户选择父节点菜单数据
     * @param Request $request
     * @return type
     */
    public function content(Request $request) {
        $post_data = $request->all();
        if (isset($post_data['type'])) {
            $result = Categorie::where('level', $post_data['level'] - 1)->where('cate_mod', $post_data['type'])->get()->toArray();
            return response()->json($result);
        }
    }

    /**
     * 新增节点
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $post_data = $request->all();
        //添加根节点时,父节点为0
        !isset($post_data['parent_node']) && $post_data['parent_node'] = 0;
        $validateMsg = ['cate_name.required' => '请填写新增节点名称', 'cate_name.max' => '节点名称过长'];
        $this->validate($request, $this->validateRules, $validateMsg);
        $result = Categorie::insert(['root_id' => $post_data['parent_node'], "cate_mod" => $post_data['cate_mod'], "cate_name" => $post_data['cate_name'], 'level' => $post_data['level'], 'cate_sort' => intval($post_data['cate_sort'])]);
        if ($result) {
            return $this->success(route("admin.websort.index",['cate_mod'=>$post_data['cate_mod']]), '添加成功!');
        }
    }

    /**
     * 更改节点名称
     * @param Request $request
     * @return type
     */
    public function update(Request $request) {
        $post_data = $request->all();
        $cate_id = intval($post_data['cate_id']);
        $cate_name = trim(strip_tags($post_data['cate_name']));
        $validateMsg = ['cate_name.required' => '请填写新增节点名称', 'cate_name.max' => '节点名称过长'];
        $this->validate($request, $this->validateRules, $validateMsg);
        $result = Categorie::where('cate_id', $cate_id)->update(['cate_name' => $cate_name]);
        if ($result) {
            return $this->success(route("admin.websort.index",['cate_sort'=>$post_data['cate_mod']]), '更改成功!');
        }
    }

    /**
     * 修改排序
     * @param Request $request
     * @return type
     */
    public function sortdir(Request $request) {
        $cate_id = intval($request->input('cate_id'));
        $cate_sort = intval($request->input('cate_sort'));
        $cate_mod=$request->input('cate_mod');
        $cate_info = Categorie::where('cate_id', '=', $cate_id);
        $result = $cate_info->update(['cate_sort' => $cate_sort,]);
        if ($result) {
            return $this->success(route("admin.websort.index",['cate_mod'=>$cate_mod]), '修改成功!');
        }
    }

}
