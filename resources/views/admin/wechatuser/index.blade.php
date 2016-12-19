@extends('admin/public/layout')

@section('title')
    微用户管理
@endsection

@section('content')
    <section class="content-header">
        <h1>
            用户列表
            <small>显示当前系统的所有微信授权用户</small>
        </h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="btn-group">
                                    {{-- <a href="{{ route('admin.wechatuser.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新用户"><i class="fa fa-plus"></i></a> --}}
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.wechatuser.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.wechatuser.index') }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="用户名" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="openid" placeholder="openid" value="{{ $filter['openid'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="parent_userid" placeholder="搜索对应用户分享来的新用户" value="{{ $filter['parent_userid'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">选择状态</option>
                                                @foreach(get_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                            <tr>
                                <th><input type="checkbox" class="checkbox-toggle"/></th>
                                <th>用户ID</th>
                                <th>用户openid</th>
                                <th>用户名</th>
                                <th>用户昵称</th>
                                <th>性别</th>
                                <th>城市</th>
                                <th>头像</th>
                                <th>来源的分享</th>
                                <th>分享来的用户数</th>
                                <th>授权时间</th>
                                <th>更新时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" value="{{ $user->id }}" name="id[]"/></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->openid }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->nickname }}</td>
                                <td>@if(!$user->sex) 未知 @elseif($user->sex==1) 男性 @else 女性  @endif</td>
                                <td>{{ $user->city }}</td>
                                <td><img style="height:50px;width: 50px;" class="img-circle" src="{{ $user->headimgurl }}" /></td>
                                <th>@if($user->share_parent_userid) {{$user->parentUser->name}} @endif</th>
                                <th>{{$user->my_share_game_count}}</th>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td><span class="label @if($user->status===0) label-danger @elseif($user->status===1) label-success @endif">{{ get_status($user->status) }}</span> </td>
                                <td>
                                    <div class="btn-group-xs" >
                                      <a class="btn btn-default" href="{{ route('admin.wechatuser.edit',['id'=>$user->id]) }}" data-toggle="tooltip" title="编辑用户信息"><i class="fa fa-edit"></i></a>
                                     </div>
                                </td>
                            </tr>
                            @endforeach
                           </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    {{-- <a href="{{ route('admin.wechatuser.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新用户"><i class="fa fa-plus"></i></a> --}}
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.wechatuser.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $users->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $users->render()) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('manage_content',"{{ route('admin.wechatuser.index') }}");
    </script>
@endsection