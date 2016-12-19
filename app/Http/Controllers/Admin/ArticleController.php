<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Models\Article;
use App\Models\Mark;
use App\Models\Copycount;
use App\Models\Website;

class ArticleController extends AdminController {

    public function index(Request $request) {
        $filter = $request->all();
        $query = Article::query();
        if (isset($filter['id']) && $filter['id'] > 0) {
            $query->where('art_id', '=', intval($filter['id']));
        }

        /* 文章名称查询 */
        if (isset($filter['word']) && $filter['word']) {
            $query->where('art_title', 'like', '%' . $filter['word'] . '%');
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
        return view('admin.article.index', ['list' => $lists, 'filter' => $filter]);
    }

    /**
     * 删除分类节点
     * @param Request $request
     */
    public function destroy(Request $request) {
        $post_param = $request->all();
        $result = Article::query()->whereIn('art_id', $post_param['id'])->delete();
        if ($result) {
            return $this->success(route("admin.article.index"), '删除成功!');
        } else {
            return $this->error(route("admin.article.index"), '删除失败!');
        }
    }

    public function create(Request $request) {
        //获取网站分类树相关数据
        $data = Categorie::query()->where('cate_mod', '=', 'article')->orderBy('root_id', 'asc')->orderBy('cate_sort', 'asc')->orderBy('updated_at', 'desc')->get()->toArray();
        if (!empty($data)) {
            $result = Categorie::tree($data, $pid = 0);
        } else {
            $result = array();
        }
        $mark_css = Mark::query()->get()->toArray();
        return view('admin.article.create', ['list' => $result, 'mark_css' => $mark_css]);
    }

    public function store(Request $request) {
        $data = $request->all();
        $art_title = htmlspecialchars(trim($data['art_title']));
        $art_intro = htmlspecialchars(trim($data['art_intro']));
        $art_content = htmlspecialchars(trim($data['art_content']));
        $art_rank = intval($data['art_rank']);
        $cate_id = intval($data['cate_id']);
        $art_mark_type = intval($data['art_mark_type']);
        $art_status = intval($data['art_status']);

        if ($data['art_from'] == 1) {
            $rule = ['author' => 'required'];
            $message = ['author.required' => '请填写文章作者姓名'];
            $author = htmlspecialchars(trim($data['author']));
            $copy_name = "";
            $radio_name = "";
            $copy_url = "";
            $this->validate($request, $rule, $message);
        }
        if ($data['art_from'] == 2) {
            if (!empty($data['copy_name'])) {
                $rule = ['copy_url' => 'required|active_url'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url'];
                $this->validate($request, $rule, $message);
                $copy_name = $data['copy_name'];
                $copy_url = $data['copy_url'];
            } elseif (empty($data['copy_name']) && (!isset($data['radio_name']))) {
                $rule = ['copy_url' => 'required|active_url', 'copy_name' => 'required'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url', 'copy_name.required' => '请输入来源网址'];
                $this->validate($request, $rule, $message);
            } elseif (empty($data['copy_name']) && isset($data['radio_name'])) {
                $rule = ['copy_url' => 'required|active_url'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url'];
                $this->validate($request, $rule, $message);
                $copy_url = $data['copy_url'];
                $copy_name = $data['radio_name'];
            }
            $author = "";
        }
        $regular_data = ['art_title' => 'required', 'art_content' => 'required'];
        $regular_message = ['art_title.required' => '请输入文章标题', 'art_content.required' => '请输入文章内容'];
        $this->validate($request, $regular_data, $regular_message);
        $result = Article::insert(['author' => $author, 'cate_id' => $cate_id, 'art_title' => $art_title, 'copy_name' => $copy_name, 'copy_url' => $copy_url, 'art_intro' => $art_intro, 'art_content' => $art_content, 'art_rank' => $art_rank, 'art_mark_type' => $art_mark_type, 'art_status' => $art_status, 'created_at' => \Carbon\Carbon::now()]);
        Copycount::countOne($copy_name);
        if ($result) {
            return $this->success(route('admin.article.index'), '新建文章成功');
        }
    }

    /**
     * 文章详情及编辑页面
     * @param Request $request
     */
    public function edit($id) {
        $datas = Article::query()->where('art_id', $id)->first()->toArray();
        //获取网站分类树相关数据
        $data = Categorie::query()->where('cate_mod', '=', 'article')->orderBy('root_id', 'asc')->orderBy('cate_sort', 'asc')->orderBy('updated_at', 'desc')->get()->toArray();
        if (!empty($data)) {
            $result = Categorie::tree($data, $pid = 0);
        } else {
            $result = array();
        }
        $mark_css = Mark::query()->get()->toArray();
        return view('admin.article.edit', ['datas' => $datas, 'list' => $result, 'mark_css' => $mark_css]);
    }

    /**
     * 更新数据库数据
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request, $id) {
        $data = $request->all();
        $art_title = htmlspecialchars(trim($data['art_title']));
        $art_intro = htmlspecialchars(trim($data['art_intro']));
        $art_content = htmlspecialchars(trim($data['art_content']));
        $art_rank = intval($data['art_rank']);
        $cate_id = intval($data['cate_id']);
        $art_mark_type = intval($data['art_mark_type']);
        $art_status = intval($data['art_status']);
        if ($data['art_from'] == 1) {
            $rule = ['author' => 'required'];
            $message = ['author.required' => '请填写文章作者姓名'];
            $author = htmlspecialchars(trim($data['author']));
            $copy_name = "";
            $radio_name = "";
            $copy_url = "";
            $this->validate($request, $rule, $message);
        }
        if ($data['art_from'] == 2) {
            if (!empty($data['copy_name'])) {
                $rule = ['copy_url' => 'required|active_url'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url'];
                $this->validate($request, $rule, $message);
                $copy_name = $data['copy_name'];
                $copy_url = $data['copy_url'];
            } elseif (empty($data['copy_name']) && (!isset($data['radio_name']))) {
                $rule = ['copy_url' => 'required|active_url', 'copy_name' => 'required'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url', 'copy_name.required' => '请输入来源网址'];
                $this->validate($request, $rule, $message);
            } elseif (empty($data['copy_name']) && isset($data['radio_name'])) {
                $rule = ['copy_url' => 'required|active_url'];
                $message = ['copy_url.active_url' => '请输入有效的文章url', 'copy_url.required' => '请输入文章url'];
                $this->validate($request, $rule, $message);
                $copy_url = $data['copy_url'];
                $copy_name = $data['radio_name'];
            }
            $author = "";
        }
        $regular_data = ['art_title' => 'required', 'art_content' => 'required'];
        $regular_message = ['art_title.required' => '请输入文章标题', 'art_content.required' => '请输入文章内容'];
        $this->validate($request, $regular_data, $regular_message);
        $result = Article::where('art_id', $id)->update(['author' => $author, 'cate_id' => $cate_id, 'art_title' => $art_title, 'copy_name' => $copy_name, 'copy_url' => $copy_url, 'art_intro' => $art_intro, 'art_content' => $art_content, 'art_rank' => $art_rank, 'art_mark_type' => $art_mark_type, 'art_status' => $art_status, 'updated_at' => \Carbon\Carbon::now()]);
        if ($result) {
            return $this->success(route('admin.article.index'), '更新文章信息成功');
        }
    }

    /**
     * 获取用户习惯输入的
     * @return type
     */
    public function getChoice() {
        $data = Copycount::query()->orderBy('count', 'desc')->take(5)->get();
        if ($data->count() == 0) {
            $data = [];
        }
        return response()->json($data);
    }
    /**
     * 文章置顶
     * @param Request $request
     */
    public function top(Request $request) {
        $data=$request->all();
        $art_top_pic="";
        $art_top=0;
        !empty($data['art_top'])&&$art_top=$data['art_top'];
        $file_path = Website::getUploadPath();
        if ($request->hasFile('art_top_pic')) {
            $file = $request->file('art_top_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid(str_random(8)) . '.' . $extension;
            $savePath = public_path($file_path);
            $file->move($savePath, $filename);
            $art_top_pic = Website::getUploadPath($filename);
        }
        $result=  Article::where('art_id',intval($data['art_id']))->update(['art_top'=>$art_top,'art_top_pic'=>$art_top_pic]);
        $message='置顶成功';
        if($result&&$data['art_top']){
            return $this->success(route('admin.article.index'), $message);
        }
        if($result&&!$data['art_top']){
            return response()->json(['status'=>'success']);
        }
                
    }

}
