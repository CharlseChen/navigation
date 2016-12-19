@extends('admin/public/layout')

@section('title')推荐管理@endsection

@section('content')
    <section class="content-header">
        <h1>微应用管理</h1>
        <p class="breadcrumb"><a href="{{ back() }}">返回上一级</a></p>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ route('admin.app.destroy') }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.app.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新应用"><i class="fa fa-plus"></i></a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle"/></th>
                                    <th>微应用名称</th>
                                    <th>微应用名称缩写</th>
                                    <th>单用户可玩次数</th>
                                    <th>进入用户数</th>
                                    <th>应用打开数</th>
                                    <th>已提交用户数</th>
                                    <th>是否需要授权</th>
                                    <th>状态</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($games as $game)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $game->id }}" name="id[]"/></td>
                                        <td>{{ $game->name }}</td>
                                        <td>{{ $game->short_name }}</td>
                                        <td>@if(!$game->max_start_game) 无限制 @else {{ $game->max_start_game }} 次 @endif</td>
                                        <td>{{ $game->gameData->user_count }}</td>
                                        <td>{{ $game->gameData->view_count }}</td>
                                        <td>{{ $game->gameData->end_count }}</td>
                                        <td><span class="label @if($game->must_auth===0) label-danger @elseif($game->must_auth===1) label-success @endif">@if($game->must_auth===0) 否 @elseif($game->must_auth===1) 是 @endif</span></td>
                                        <td><span class="label @if($game->status===0) label-danger @elseif($game->status===1) label-success @endif">{{ get_status($game->status) }}</span></td>
                                        <td>{{ $game->updated_at }}</td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.app.edit',['id'=>$game->id]) }}" data-toggle="tooltip" title="编辑推荐信息"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $games->render()) !!}
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