@extends('admin/public/layout')
@section('title')站点设置@endsection
@section('content')
<section class="content-header">
    <h1>
        站点设置
        <small>微信公众号信息设置@if (!$checkCacheConf) <span class="form-group has-error"><label>(缓存未生成,请保存下生成缓存)</label></span> @endif </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.setting.website') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form role="form" name="addForm" id="website_form" method="POST" action="{{ route('admin.setting.wechat') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('wechat_appid')) has-error @endif">
                            <label for="wechat_appid">appID</label>
                            <span class="text-muted">AppID(应用ID)</span>
                            <input type="text" name="wechat_appid" class="form-control " placeholder="微信公众号里，AppID(应用ID)" value="{{ old('wechat_appid',Setting()->get('wechat_appid')) }}">
                            @if ($errors->has('wechat_appid')) <p class="help-block">{{ $errors->first('wechat_appid') }}</p> @endif
                        </div>

                        <div class="form-group @if ($errors->has('wechat_appsecret')) has-error @endif">
                            <label for="wechat_appsecret">appsecret</label>
                            <span class="text-muted">AppSecret(应用密钥)</span>
                            <input type="text" name="wechat_appsecret" class="form-control " placeholder="微信公众号里，AppSecret(应用密钥)" value="{{ old('wechat_appsecret',Setting()->get('wechat_appsecret')) }}">
                            @if ($errors->has('wechat_appsecret')) <p class="help-block">{{ $errors->first('wechat_appsecret') }}</p> @endif
                        </div>
                        
                         <div class="form-group @if ($errors->has('wechat_token')) has-error @endif">
                            <label for="wechat_token">token</label>
                            <span class="text-muted">Token(令牌)</span>
                            <input type="text" name="wechat_token" class="form-control " placeholder="微信公众号里，您设置的Token" value="{{ old('wechat_token',Setting()->get('wechat_token')) }}">
                            @if ($errors->has('wechat_token')) <p class="help-block">{{ $errors->first('wechat_token') }}</p> @endif
                        </div>
                        
                        
                        <div class="form-group @if ($errors->has('wechat_encodingaeskey')) has-error @endif">
                            <label for="wechat_encodingaeskey">EncodingAESKey</label>
                            <span class="text-muted">EncodingAESKey(消息加解密密钥)</span>
                            <input type="text" name="wechat_encodingaeskey" class="form-control " placeholder="微信公众号里，您设置生成的EncodingAESKey" value="{{ old('wechat_encodingaeskey',Setting()->get('wechat_encodingaeskey')) }}">
                            @if ($errors->has('wechat_encodingaeskey')) <p class="help-block">{{ $errors->first('wechat_encodingaeskey') }}</p> @endif
                        </div>
                        
                        <div class="form-group @if ($errors->has('wechat_loglevel')) has-error @endif">
                            <label for="wechat_loglevel">微信API日志级别</label>
                            <span class="text-muted">(微信API回调的日志级别)</span>
                            <select name="wechat_loglevel" class="form-control">
                                <option value="debug"  @if(Setting()->get('wechat_loglevel') == 'debug') selected @endif  >debug</option>
                                <option value="info"  @if(Setting()->get('wechat_loglevel') == 'info') selected @endif  >info</option>
                                <option value="notice"  @if(Setting()->get('wechat_loglevel') == 'notice') selected @endif  >notic</option>
                                <option value="warning"  @if(Setting()->get('wechat_loglevel') == 'warning') selected @endif  >warning</option>
                                <option value="error"  @if(Setting()->get('wechat_loglevel') == 'error') selected @endif  >error</option>
                                <option value="critical"  @if(Setting()->get('wechat_loglevel') == 'critical') selected @endif  >critical</option>
                                <option value="alert"  @if(Setting()->get('wechat_loglevel') == 'alert') selected @endif  >alert</option>
                                <option value="emergency"  @if(Setting()->get('wechat_loglevel') == 'emergency') selected @endif  >emergency</option>
                            </select>
                            @if ($errors->has('wechat_loglevel')) <p class="help-block">{{ $errors->first('wechat_loglevel') }}</p> @endif
                        </div>     
                        
                         <div class="form-group @if ($errors->has('wechat_logpath')) has-error @endif">
                            <label for="wechat_logpath">微信API日志存储路径</label>
                            <span class="text-muted">(相对路径，直接设置storage目录下路径，如：logs/wechat.log)</span>
                            <input type="text" name="wechat_logpath" class="form-control " placeholder="logs/wechat.log" value="{{ old('wechat_logpath',Setting()->get('wechat_logpath')) }}">
                            @if ($errors->has('wechat_logpath')) <p class="help-block">{{ $errors->first('wechat_logpath') }}</p> @endif
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="button" id="saveBtn" class="btn btn-primary" name="submitBtn">保存</button>
                        <button type="reset" class="btn btn-success">重置</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/static/js/jquery.jsonp.js') }}"></script>
<script type="text/javascript">
    $(function(){
        set_active_menu('global',"{{ route('admin.setting.wechat') }}");
        $("#saveBtn").click(function(){
            $("#website_form").submit();
        });

    });
</script>
@endsection