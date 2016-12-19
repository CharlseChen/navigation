@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <div class="list">
        <h3 >分类树总览</h3>
        <div class="box box-default">           
            <div style="margin: 10px auto 10px 50px; ">
                @if(empty($list))暂时尚未添加分类信息@else 
                @foreach($list as $v)<div class="item"><div style="display: inline-block;text-indent:{{$v['Count']*20}}px;cursor:pointer;" class="node" cate_id="{{$v['cate_id']}}" cate_name="{{$v['cate_name']}}" active="">| -- {{$v['cate_name'].'('.$v['Count'].'级目录)'}}</div><div id="update_btn" style="display: inline"></div><div id='top' style="display:inline" cate_sort='{{$v['cate_sort']}}'></div></div>@endforeach
                @endif
            </div>
        </div>
    </div>
</section>
<div style="margin:10px auto auto 15px;">
    <h3>新增分类节点</h3> 
    <div class="box box-default">
        <div style="margin: 10px auto 10px 50px; ">
            <form role="form" name="new" method="POST" action="{{ route('admin.websort.store') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cate_mod" value="{{$cate_mod}}">
                <label>请选择添加目录层级</label>
                <select id='level' class="form-control" name="level" style="margin-top:10px" >
                    @for($i=0,$j=0;$i<=$max_level;$i++)
                    <option value="{{++$j}}">{{$j}}级目录</option>
                    @endfor
                </select>
                <div class="select_parent">
                    <label style="margin-top: 10px">请选择您需要的添加目录节点的父节点</label>
                    <select class="form-control" id='mount_node' name='parent_node'  style="margin-top:10px" ></select>
                </div>
                <input style="margin-top:10px" class="form-control" required oninvalid="setCustomValidity('必须填写新增节点名称!');"  oninput="setCustomValidity('')" type="text" name='cate_name' placeholder="请输入新增目录名称">
                <input style="margin-top:10px" class="form-control"  type="text" name='cate_sort' placeholder="请输入目录排序数,数值越小排列越靠前">
                <div class="box-footer" style="margin-top:10px">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="margin:10px auto auto 15px;">
    <h3>删除分类节点</h3> 
    <div class="box box-default">
        <div style="margin: 10px auto 10px 50px; ">
            <form role="form" name="delete" method="POST" action="{{ route('admin.websort.destroy') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cate_mod" value="{{$cate_mod}}">
                <input type="hidden" name="delete_ids" value=''>
                <label>请单击上方节点树中节点,选取要删除的节点(<font style="color:red">注:删除节点为父节点,其子节点也将被删除</font>):</label><span id="delete_names"></span>
                <div class="box-footer" style="margin-top:10px">
                    <button type="submit" class="btn btn-primary">删除</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">节点名称修改</h4>
            </div>
            <form role="form" name="update" method="POST" action="{{ route('admin.websort.update') }}" >
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name='cate_id'  id='cate_id' value=''>
                    <input type="text" name='cate_name' id="cate_name"placeholder="">
                    <input type="hidden" name='cate_mod' value="{{$cate_mod}}">
                </div>

            </form> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="document.forms[2].submit();">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">节点位置修改</h4>
            </div>
            <form role="form" name="sort" method="POST" action='{{ route('admin.websort.sortdir',['cate_mod'=>$cate_mod]) }}' >
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name='cate_id'  id='cate_id2' value=''>
                    <b>请输入目录排序数,数值越小排列越靠前</b>
                    <input type="text" name='cate_sort' id="cate_sort2" placeholder="">
                </div>

            </form> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="document.forms[3].submit();">保存</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function () {
        var cate_mod = $('input[name="cate_mod"]').val();
        //激活菜单
        if (cate_mod == 'webdir') {
            set_active_menu('websort', "{{ route('admin.websort.index',['cate_mod'=>'webdir']) }}");
        }else {
            set_active_menu('artsort', "{{ route('admin.websort.index',['cate_mod'=>'article']) }}");
        }

        //二级联动菜单
        function updateSelect(level, token) {
            $('.select_parent').show();
            $.ajax({
                url: "{{route('admin.websort.content',['cate_mod'=>" + cate_mod + "])}}",
                data: {
                    type: cate_mod,
                    level: level,
                    _token: token
                },
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    var html = " ";
                    $.each(data, function (index, item) {
                        html += '<option value="' + item.cate_id + '">' + item.cate_name + "</option>";
                    });
                    $('#mount_node').empty();
                    $('#mount_node').append(html);
                }
            });
        }
        var level = $('#level').val();
        var token = $('input[name="_token"]').val();
        if (level == 1) {
            $('.select_parent').hide();
        } else {
            updateSelect(level, token);
        }
        $('#level').change(function () {
            var level = $(this).val();
            if (level !== 1) {
                updateSelect(level, token);
            }
        });
        //删除时选取节点
        $('.item').hover(function () {
            var item = $(this).children(':first');
            item.css('color', '#FF8C00');
            item.next().html('<button type="button" class="btn btn-link update_btn">更改名称</button>')
            var text = '排序修改';
            item.next().next().html('<button type="button" class="btn btn-link top_btn">' + text + '</button>');
            item.click(function () {
                item.attr('active') === '1' ? item.attr('active', '0') && item.css('color',                 '') : item.attr('active', '1') && item.css('color', '#FF8C00');
                $(document).ready(function () {
                    var cate_id = "";
                    var cate_name = "";
                    $("[active='1']").each(function () {
                        cate_name += $(this).attr('cate_name') + "   ";
                        cate_id += $(this).attr('cate_id') + "   ";
                    });
                    $('#delete_names').html(cate_name);
                    $('[name="delete_ids"]').val(cate_id);
                });
            });
            $(document).ready(function () {
                $('.update_btn').click(function () {
                    var cate_id = $(this).parent().prev().attr('cate_id');
                    var cate_name = $(this).parent().prev().attr('cate_name');
                    $('#cate_id').val(cate_id);
                    $('#cate_name').attr('placeholder', cate_name);
                    $("#myModal").modal('show');
                });
                $('.top_btn').click(function () {
                    var cate_id = $(this).parent().prev().prev().attr('cate_id');
                    var cate_sort = $(this).parent().attr('cate_sort');
                    $('#cate_id2').val(cate_id);
                    $('#cate_sort2').attr('placeholder', '' + cate_sort);
                    $("#myModal2").modal('show');
                });
            });
        }, function () {
            if ($(this).children(':first').attr('active') !== '1') {
                $(this).children(':first').css('color', '');
                $(this).children(':first').next().html('');
                $(this).children(':first').next().next().html('');
            }
        });
    });
</script>
@endsection