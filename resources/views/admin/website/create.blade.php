@extends('admin/public/layout')
<link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@section('title')
网站列表管理
@endsection

@section('content')
<section class="content-header">
    <h1>
        网站管理
        <small>创建编辑</small>
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
                <form role="form" name="userForm" method="POST" action="{{ route('admin.website.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('web_name')) has-error @endif">
                            <label>网站名称</label>
                            <input type="text" name="web_name" class="form-control " required oninvalid="setCustomValidity('必须填写网站名称!');"  oninput="setCustomValidity('')" placeholder="请输入网站名称" value="{{old('web_name')}}">
                            @if ($errors->has('web_name')) <p class="help-block">{{ $errors->first('web_name') }}</p> @endif
                        </div>
                        <div class="form-group @if ($errors->has('web_url')) has-error @endif">
                            <label>网站url(请输入网站的完整路径,例如:http://navigation_123.com)</label>
                            <input type="text" name="web_url" class="form-control " required oninvalid="setCustomValidity('必须填写网站url!');"  oninput="setCustomValidity('')" placeholder="请输入网站url" value="{{old('web_url')}}">
                            @if ($errors->has('web_url')) <p class="help-block">{{ $errors->first('web_url') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label>上传网站图标(16*16)</label>
                            <input type="file" name='web_pic' id="imgs" value="{{old('web_pic')}}"/>
                        </div>
                        <div class="form-group @if ($errors->has('web_intro')) has-error @endif">
                            <label>网站简介</label>
                            <textarea name="web_intro" id="desc_editor" class="form-control" placeholder="请输入网站简介" style="height:300px;">{{old('web_intro')}}</textarea>                       
                        </div>
                        <div class="form-group">
                            <label for="status">所属分类</label>
                            <select class="form-control" name="cate_id">
                                @foreach($list as $v)<option value="{{$v['cate_id']}}">| @for($i=$v['Count'];$i>0;$i--)--@endfor{{$v['cate_name'].'('.$v['Count'].'级目录)'}}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group @if ($errors->has('web_rank')) has-error @endif">
                            <label>网站所在分类排序数</label>
                            <input type="text" name="web_rank" class="form-control " placeholder="请输入网站排序(数字越小排名越靠前)" value="{{old('web_rank')}}">
                            @if ($errors->has('web_rank')) <p class="help-block">{{ $errors->first('web_rank') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label>网站链接样式选择</label>
                           <div>
                               <label><input type="radio" name="art_mark_type"  checked="true" value="0">无样式</label>
                                @foreach($mark_css as $k=> $va)

                                <label class='{{$va['class_name']}}'>
                                    <input type="radio" name="art_mark_type" id="optionsRadios2" value="{{$va['id']}}">
                                           {{$va['class_name']}}
                                </label>

                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select class="form-control" name="web_status">
                                <option value="1"> 正常</option>
                                <option value="0"> 关闭</option>
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