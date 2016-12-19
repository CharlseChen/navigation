@extends('admin/public/layout')
<link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@section('title')
微信公众号管理
@endsection

@section('content')
<section class="content-header">
    <h1>
        公众号管理
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
                <form role="form" name="userForm" method="POST" action="{{ route('admin.wx.update',['id'=>$data['id']]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('wx_name')) has-error @endif">
                            <label>微信公众号名称</label>
                            <input type="text" name="wx_name" class="form-control " required oninvalid="setCustomValidity('必须填写微信公众号名称!');"  oninput="setCustomValidity('')" placeholder="请输入微信公众号名称" value="{{old('wx_name',$data['wx_name'])}}">
                            @if ($errors->has('wx_name')) <p class="help-block">{{ $errors->first('wx_name') }}</p> @endif
                        </div>
                        <div class="form-group @if ($errors->has('wx_id')) has-error @endif">
                            <label>微信公众号ID</label>
                            <input type="text" name="wx_id" class="form-control " required oninvalid="setCustomValidity('必须填写微信公众号ID!');"  oninput="setCustomValidity('')" placeholder="请输入微信公众号ID" value="{{old('wx_id',$data['wx_id'])}}">
                            @if ($errors->has('wx_id')) <p class="help-block">{{ $errors->first('wx_id') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label>上传公众号头像</label><br>
                            <img src="{{asset('static/upload/' . str_replace("-", "/",$data['wx_two_dimension']))}}"width="100px"height="100px">
                            <input type="file" name='wx_pic' id="imgs" value="{{old('wx_pic')}}"/>
                        </div>
                        <div class="form-group @if ($errors->has('wx_rank')) has-error @endif">
                            <label>网站所在分类排序数</label>
                            <input type="text" name="wx_rank" class="form-control " placeholder="请输入微信号排序(数字越小排名越靠前)" value="{{old('wx_rank',$data['wx_rank'])}}">
                            @if ($errors->has('wx_rank')) <p class="help-block">{{ $errors->first('wx_rank') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($data['status'])selected @endif > 正常</option>
                                <option value="0" @if(!$data['status']) selected @endif> 关闭</option>
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
    set_active_menu('root_menu', "{{ route('admin.wx.index') }}");
});
</script>
@endsection