@extends('admin/public/layout')

@section('content')
    <section class="content-header">
        <h1>
            应用管理
            <small>添加应用</small>
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
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">基本信息</h3>
                    </div>
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.app.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label>应用中文名称</label>
                                <input type="text" name="name" class="form-control "  placeholder="应用名称" value="{{ old('name','') }}">
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('short_name')) has-error @endif">
                                <label>应用简写</label>
                                <span class="text-muted">(拼音或者英文简写,会对应到前台URL后缀)</span>
                                <input type="text" name="short_name" class="form-control "  placeholder="请输入拼音简写，会对应到前台URL后缀" value="{{ old('short_name','') }}">
                                @if ($errors->has('short_name')) <p class="help-block">{{ $errors->first('short_name') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('max_start_game')) has-error @endif">
                                <label>单用户可玩次数</label>
                                <span class="text-muted">(0为无限制)</span>
                                <input type="text" name="max_start_game" class="form-control "  placeholder="0" value="{{ old('max_start_game','') }}">
                                @if ($errors->has('max_start_game')) <p class="help-block">{{ $errors->first('max_start_game') }}</p> @endif
                            </div>
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" checked /> 开启
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" /> 关闭
                                    </label>
                                </div>
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
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.app.index') }}");
    </script>
@endsection
