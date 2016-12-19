@extends('admin/public/layout')

@section('title')
    编辑用户
@endsection

@section('content')
    <section class="content-header">
        <h1>
            编辑用户
            <small>编辑用户信息</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-mail-reply"></i> 返回</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                
                <table class="table">
                   <caption>用户信息</caption>
                   <thead>
                      <tr>
                         <th>ID</th>
                         <th>OpenID</th>
                         <th>用户名</th>
                         <th>用户昵称</th>
                         <th>性别</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr class="active">
                         <td>{{$user->id}}</td>
                         <td>{{$user->openid}}</td>
                         <td>{{$user->name}}</td>
                         <td>{{$user->nickname}}</td>
                         <td>@if(!$user->sex) 未知 @elseif($user->sex==1) 男性 @else 女性  @endif</td>
                      </tr>
                   </tbody>
                   <thead>
                      <tr>
                         <th>国家</th>
                         <th>省份</th>
                         <th>城市</th>
                         <th>头像</th>
                         <th>授权时间</th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr class="active">
                         <td>{{$user->country}}</td>
                         <td>{{$user->province}}</td>
                         <td>{{$user->city}}</td>
                         <td><img style="height:50px;width: 50px;" class="img-circle" src="{{ $user->headimgurl }}" /></td>
                         <td>{{$user->created_at}}</td>
                      </tr>
                   </tbody>
                   <thead>
                      <tr>
                         <th>来源的分享</th>
                         <th>分享来的用户数</th>
                         <th>来源应用</th>
                         <th>关注公众号</th>
                         <th>更新时间</th>
                      </tr>
                   </thead>
                  <tbody>
                      <tr class="active">
                         <td>@if($user->share_parent_userid) {{$user->parentUser->name}} @endif</td>
                         <td>{{$user->my_share_game_count}}</td>
                         <td>{{$user->userData->game->name}}</td>
                         <td>@if($user->userData->is_attention) 是 @else 否 @endif</td>
                         <td>{{$user->updated_at}}</td>
                      </tr>
                   </tbody>
                </table>
                
                <table class="table">
                   <caption>用户分享过来的用户</caption>
                   <thead>
                      <tr>
                         <th>用户ID</th>
                         <th>OpenID</th>
                         <th>用户名</th>
                         <th>用户昵称</th>
                         <th>头像</th>
                         <th>授权时间</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach($shareusers as $key=>$shareuser)
                      <tr class="@if($key%2) @else success @endif">
                         <td>{{$shareuser->id}}</td>
                         <td>{{$shareuser->openid}}</td>
                         <td><a href="{{ route('admin.wechatuser.edit',['id'=>$shareuser->id])  }}">{{$shareuser->name}}</a></td>
                         <td><a href="{{ route('admin.wechatuser.edit',['id'=>$shareuser->id])  }}">{{$shareuser->nickname}}</a></td>
                         <th><a href="{{ route('admin.wechatuser.edit',['id'=>$shareuser->id])  }}"><img style="height:50px;width: 50px;" class="img-circle" src="{{ $shareuser->headimgurl }}" /></a></th>
                         <td>{{$shareuser->updated_at}}</td>
                      </tr>
                      @endforeach
                      <tr>
                       <td colspan="6">
                         <div class="text-right">
                            <span class="total-num">共 {{ $shareusers->total() }} 条数据</span>
                            {!! str_replace('/?', '?', $shareusers->render()) !!}
                           </div>
                      	</td>
                      </tr>
                   </tbody>
                </table>
                
                <table class="table table-condensed">
               <caption>用户微应用数据 </caption>
               <thead>
                  <tr>
                     <th>应用名称</th>
                     <th>最高积分</th>
                     <th>该用户应用总次数</th>
                     <th>该用户分享来用户数</th>
                     <th>该用户分享开始应用的数</th>
                     <th>操作</th>
                  </tr>
               </thead>
               <tbody>
               	@foreach($wechatUserGame as $usergame)
                  <tr>
                     <td><a href="{{ route('admin.wechatuser.gamedatalist',['user_id'=>$usergame->user_id,'game_id'=>$usergame->game_id])  }}">{{$usergame->game->name}}</a></td>
                     <td>{{$usergame->max_integral}}</td>
                     <td>{{$usergame->start_times}}</td>
                     <td>{{$usergame->share_number}}</td>
                     <td>{{$usergame->share_start_number}}</td>
                     <td><form name="cleangame_form" id ="cleangame_form" action="{{ route('admin.wechatuser.index',['user_id'=>$usergame->user_id,'game_id'=>$usergame->game_id]) }}" method="GET">
                     <button class="btn btn-default btn-sm" data-toggle="tooltip" title="清除游戏数据" onclick="confirm_submit('cleangame_form','{{  route('admin.wechatuser.cleangame',['user_id'=>$usergame->user_id,'game_id'=>$usergame->game_id]) }}','清除游戏数据？')"><i class="fa fa-trash-o"></i></button>
                     </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
                    <form role="form" name="userForm" method="POST" action="{{ route('admin.wechatuser.update',['id'=>$user->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($user->status===1) checked @endif /> 开启
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($user->status===0) checked @endif /> 关闭
                                    </label>
                                </div>
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
        set_active_menu('manage_content',"{{ route('admin.wechatuser.index') }}");
    </script>
@endsection