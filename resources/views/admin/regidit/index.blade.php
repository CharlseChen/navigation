@extends('admin/public/layout')

@section('title')
用户管理
@endsection

@section('content')
<section class="content-header">
    <h1>
        用户列表
        <small>显示当前系统的所有注册用户</small>
    </h1>
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
                                <form name="searchForm" action="{{ route('admin.regidit.index') }}" method="GET">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="word" style="float:left;" placeholder="用户名" value="{{ $filter['word'] or '' }}"/>

                                    </div>
                                    <div class="col-xs-1"> <button type="submit" style="float:left;"class="btn btn-primary ">搜索</button></div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table class="table table-striped">
                                <tr>
                                    <th>姓名</th>
                                    <th>公司</th>
                                    <th>职位</th>
                                    <th>电话</th>
                                    <th>报名时间</th>
                                </tr>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->company }}</td>
                                    <td>{{ $user->postion }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ date('Y-m-d H:i:s',$user->date) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
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
    set_active_menu('manage_user', "{{ route('admin.regidit.index') }}");
</script>
@endsection