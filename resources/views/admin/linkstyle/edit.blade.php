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
        网站链接样式管理
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
                <form role="form" name="userForm" method="POST" action="{{ route('admin.style.update',['id'=>$data->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name='_method' value="PUT">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('class_name')) has-error @endif">
                            <label>样式名称</label>
                            <input type="text" name="class_name" class="form-control " required oninvalid="setCustomValidity('必须填写网站名称!');"  oninput="setCustomValidity('')" placeholder="请输入链接样式类名" value="{{old('class_name',$data->class_name)}}">
                            @if ($errors->has('web_name')) <p class="help-block">{{ $errors->first('class_name') }}</p> @endif
                        </div>
                        <div>
                            <label>样式展示:</label>
                            <a class="show_style {{$data->class_name}}" href="javascript:void(0);">量子防务</a>
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
    //激活菜单
    set_active_menu('link_style', "{{ route('admin.style.index') }}");
    $('#desc_editor').summernote({
        lang: 'zh-CN',
        height: 300,
        onImageUpload: function (files, editor, welEditable) {
            upload_editor_image(files[0], "desc_editor", $("#editor_token").val());
        }
    });
    $('[name="class_name"]').blur(function () {
       var class_name=$(this).val(); 
       $(".show_style").addClass(class_name);
    });
});
</script>
@endsection