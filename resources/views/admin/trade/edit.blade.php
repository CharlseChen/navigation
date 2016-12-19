@extends('admin/public/layout')
<link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@section('title')
供需信息
@endsection

@section('content')
<section class="content-header">
    <h1>
        新增管理
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
                <form role="form" name="userForm" method="POST" action="{{ route('admin.trade.update',['id'=>$data->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label>需求信息分类名称</label>
                            <input type="text" name="name" class="form-control " required oninvalid="setCustomValidity('需求信息分类名称!');"  oninput="setCustomValidity('')" placeholder="请输入需求信息分类名称" value="{{old('name',$data['name'])}}">
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label>上传分类封面</label><br>
                            <img src="{{asset('static/upload/' . str_replace("-", "/",$data->pic))}}" width="20px"height="20px">
                            <input type="file" name='pic' id="imgs" value="{{old('pic')}}"/>
                        </div>
                        <div class="form-group @if ($errors->has('rank')) has-error @endif">
                            <label>分类排序数</label>
                            <input type="text" name="rank" class="form-control" placeholder="请输入排序数(数字越小排名越靠前)" value="{{old('rank',$data->rank)}}">
                            @if ($errors->has('rank')) <p class="help-block">{{ $errors->first('rank') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($data->status) selected @endif> 正常</option>
                                <option value="0"@if(!$data->status) selected @endif> 关闭</option>
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
set_active_menu('trade_sort', "{{ route('admin.trade.district') }}");
</script>
@endsection