@extends('admin/public/layout')

@section('title')
    编辑用户
@endsection

@section('content')
    <section class="content-header">
        <h1>
            修改密码
            <small>修改用户密码</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="userForm" method="POST" action="{{ route('admin.account.chpass') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                          <div class="form-group @if ($errors->has('old_password')) has-error @endif">
                              <label for="name">旧密码</label>
                              <input name="old_password" id="old_password" type="password" maxlength="32" placeholder="旧密码" class="form-control" value="" />
                              @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
                          </div>

                          <div class="form-group @if ($errors->has('password')) has-error @endif">
                              <label for="name">新密码</label>
                              <input name="password" id="password" type="password" maxlength="32" placeholder="新密码" class="form-control" value="" />
                              @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                          </div>

                          <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                              <label for="name">确认新密码</label>
                              <input name="password_confirmation" id="password_confirmation" type="password" maxlength="32" placeholder="再次输入新密码" class="form-control" value="" />
                              @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                          </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">保存</button>
                          <button type="reset" class="btn btn-success">重置</button>
                        </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        set_active_menu('manage_user',"{{ route('admin.user.index') }}");
    </script>
@endsection