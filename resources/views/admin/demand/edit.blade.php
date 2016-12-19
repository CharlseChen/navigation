@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <h1>
        供需信息管理
        <small>编辑</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('admin/public/error')
            <div class="box box-default">
                <form role="form" name="userForm" method="POST" action="{{ route('admin.demand.update',['id'=>$data->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label>需求信息标题</label>
                            <input type="text" name="title" class="form-control " required oninvalid="setCustomValidity('必须填标题信息!');"  oninput="setCustomValidity('')" placeholder="请输标题信息" value="{{old('title',$data->title)}}">
                            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                        </div>
                        <div class="form-group @if ($errors->has('url')) has-error @endif">
                            <label>需求详情url(请输入网站的完整路径,例如:http://navigation_123.com)</label>
                            <input type="text" name="url" class="form-control " required oninvalid="setCustomValidity('必须填写需求详情页链接url!');"  oninput="setCustomValidity('')" placeholder="请输入需求详情页链接url" value="{{old('url',$data->url)}}">
                            @if ($errors->has('url')) <p class="help-block">{{ $errors->first('url') }}</p> @endif
                        </div>

                        <div class="form-group">
                            <label for="status">所属分类</label>
                            <select class="form-control" name="cate_id">
                                @foreach($list as $v)<option value="{{$v['id']}}"@if($v['id']==$data->cate_id)selected @endif>{{$v['name']}}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group @if ($errors->has('rank')) has-error @endif">
                            <label>排序数</label>
                            <input type="text" name="rank" class="form-control " placeholder="请输入排序数(数字越小排名越靠前)" value="{{old('rank',$data->rank)}}">
                            @if ($errors->has('rank')) <p class="help-block">{{ $errors->first('rank') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($data->status)selected  @endif> 正常</option>
                                <option value="0" @if(!$data->status)selected @endif> 关闭</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

<script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('/static/js/webuploader/webuploader.min.js') }}"></script>
<script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.js') }}"></script>
<script type="text/javascript">

// 添加全局站点信息
$(document).ready(function () {
    set_active_menu('websort_manage', "{{ route('admin.website.index') }}");
    $('#desc_editor').summernote({
        lang: 'zh-CN',
        height: 300,
        onImageUpload: function (files, editor, welEditable) {
            upload_editor_image(files[0], "desc_editor", $("#editor_token").val());
        }
    });
});
</script>
@endsection