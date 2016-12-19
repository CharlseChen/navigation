@extends('admin/public/layout')

@section('title')记录管理@endsection

@section('content')
    <section class="content-header">
        <h1><a href="{{ route('admin.app.update',['id'=>$games->id])}}">{{$games->name}}</a>应用<a href="{{ route('admin.wechatuser.update',['id'=>$users->id])}}">{{$users->name}}</a>记录</h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                     <div class="box-header">
                        <div class="row">
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.wechatuser.gamedatalist',['user_id'=>$users->id,'game_id'=>$games->id])  }}" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-xs-2">
                                            <select class="form-control" name="game_id">
                                                <option value="-1">选择应用名称</option>
                                                @foreach($gameAll as $key => $gameval)
                                                    <option value="{{ $gameval->id }}" @if($gameid==$gameval->id) selected @endif >{{ $gameval->name }}</option>
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
                
                    <form role="form" name="listForm" method="post" action="{{ route('admin.app.destroy') }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <table class="table table-striped">
                                <tr>
                                   <th><input type="checkbox" class="checkbox-toggle"/></th>
                                    <th>记录ID</th>
                                    <th>应用名称</th>
                                    <th>应用积分</th>
                                    <th>来源</th>
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                @if ($maxInfo->id)
                                <tr class="success" title="最高积分记录">
                                 <td><input type="checkbox" value="{{ $maxInfo->id }}" name="id[]"/></td>
                                 <td>{{ $maxInfo->id }}</td>
                                <td>{{ $maxInfo->game->name }}</td>
                                <td>{{ $maxInfo->integral }}</td>
                                <td>@if($maxInfo->share_parent_userid ) {{ $maxInfo->parentUser->name }} @endif</td>
                                <td>{{ $maxInfo->created_at }}</td>
                                <td>{{ $maxInfo->created_at }}</td>
                                </tr>
                                @endif
                                
                                @if($usergames)
                                @foreach($usergames as $usergame)
                               <tr>
                               	<td><input type="checkbox" value="{{ $usergame->id }}" name="id[]"/></td>
                               	<td>{{ $usergame->id }}</td>
                                <td>{{ $usergame->game->name }}</td>
                                <td>{{ $usergame->integral }}</td>
                                <td>@if($usergame->share_parent_userid ) {{ $usergame->parentUser->name }} @endif</td>
                                <td>{{ $usergame->created_at }}</td>
                                <td>{{ $usergame->created_at }}</td>
                              </tr>
                                @endforeach
                                @endif
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                           <span class="total-num">共 {{ $usergames->total() }} 条数据</span>
                            {!! str_replace('/?', '?', $usergames->render()) !!}
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