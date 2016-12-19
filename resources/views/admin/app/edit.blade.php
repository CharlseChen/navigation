@extends('admin/public/layout')
@section('title')应用管理@endsection

@section('content')
    <section class="content-header">
        <h1>
            应用管理
            <small>编辑应用</small>
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
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.app.update',['id'=>$game->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label>应用中文名称</label>
                                <input type="text" name="name" class="form-control "  placeholder="应用名称" value="{{ old('name',$game->name) }}">
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('short_name')) has-error @endif">
                                <label>应用简写</label>
                                <span class="text-muted">(拼音或者英文简写,会对应到前台URL后缀)</span>
                                <input type="text" name="short_name" class="form-control " readonly  placeholder="请输入拼音简写，会对应到前台URL后缀" value="{{ old('short_name',$game->short_name) }}">
                                @if ($errors->has('short_name')) <p class="help-block">{{ $errors->first('short_name') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('max_start_game')) has-error @endif">
                                <label>单用户可玩次数</label>
                                <span class="text-muted">(0为无限制)</span>
                                <input type="text" name="max_start_game" class="form-control "  placeholder="0" value="{{ old('max_start_game',$game->max_start_game) }}">
                                @if ($errors->has('max_start_game')) <p class="help-block">{{ $errors->first('max_start_game') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('share_title')) has-error @endif">
                                <label>分享的标题</label>
                                <span class="text-muted"></span>
                                <input type="text" name="share_title" class="form-control "  placeholder="请填入分享时候的标题" value="{{ old('share_title',$game->share_title) }}">
                                @if ($errors->has('share_title')) <p class="help-block">{{ $errors->first('share_title') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('share_desc')) has-error @endif">
                                <label>分享的描述</label>
                                <span class="text-muted"></span>
                                <input type="text" name="share_desc" class="form-control "  placeholder="请填入分享时候的描述" value="{{ old('share_desc',$game->share_desc) }}">
                                @if ($errors->has('share_desc')) <p class="help-block">{{ $errors->first('share_desc') }}</p> @endif
                            </div>                            
                             <div class="form-group @if ($errors->has('share_img')) has-error @endif">
                                <label>分享的头像</label>
                                <span class="text-muted"></span>
                                <input type="text" name="share_img" class="form-control "  placeholder="请填入分享时候的图片" value="{{ old('share_img',$game->share_img) }}">
                                @if ($errors->has('share_desc')) <p class="help-block">{{ $errors->first('share_desc') }}</p> @endif
                            </div>                            
                            <div class="form-group">
                                <label>是否必须关注</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="must_follow" value="1" @if($game->must_follow===1) checked @endif /> 是
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="must_follow" value="0" @if($game->must_follow===0) checked @endif /> 否
                                    </label>
                                </div>
                            </div>
                           <div class="form-group">
                                <label>是否需要授权</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="must_auth" value="1" @if($game->must_auth===1) checked @endif /> 是
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="must_auth" value="0" @if($game->must_auth===0) checked @endif /> 否
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($game->status===1) checked @endif /> 开启
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($game->status===0) checked @endif /> 关闭
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
