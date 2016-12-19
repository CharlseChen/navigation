@extends('admin/public/layout')
<link href="{{ asset('/static/js/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/webuploader/webuploader.css')}}" rel="stylesheet">
<link href="{{ asset('/static/js/summernote/summernote.css')}}" rel="stylesheet">
@section('title')
网站列表管理
@endsection

@section('content')
<section class="content-header">
    <h1>
        文章管理
        <small>创建编辑</small>
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
            <div class="box box-default">
                <form role="form" name="userForm" method="POST" action="{{ route('admin.article.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="editor_token"value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('art_title')) has-error @endif">
                            <label>文章标题</label>
                            <input type="text" name="art_title" class="form-control " required oninvalid="setCustomValidity('必须填写网站名称!');"  oninput="setCustomValidity('')" placeholder="请输入网站名称" value="{{old('art_title')}}">
                            @if ($errors->has('art_title')) <p class="help-block">{{ $errors->first('art_title') }}</p> @endif
                        </div>
                        <div class="form-group @if ($errors->has('art_intro')) has-error @endif">
                            <label>文章简介</label>
                            <textarea name="art_intro" id="desc_editor" class="form-control" placeholder="请输入文章简介" style="height:300px;">{{old('art_intro')}}</textarea>                       
                        </div>
                        <div class="form-group @if ($errors->has('art_content')) has-error @endif">
                            <label>文章内容</label>
                            <textarea name="art_content" id="desc_editor2" class="form-control" placeholder="请输入文章内容" style="height:300px;">{{old('art_content')}}</textarea>                       
                        </div>
                        <div class="form-group">
                            <label>文章出处</label>
                            <div>
                                <input type="radio" name="art_from" id="orign" value="1" checked>原创
                                <input type="radio" name="art_from" id="reprint" value="2">转载 
                            </div>
                            <div class="author">
                                *作者<input type="text" class="form-control" name='author' value="" placeholder="请输入作者姓名"/>
                            </div>
                            <div class="reprint_info">
                                *来源网站名:<input class="form-control" type="text" name="copy_name" placeholder="请输入网站名" value=""/>
                                *来源网站地址(请输入完整的链接地址:http://www.baidu.com):<input class="form-control" type="text" name="copy_url" placeholder="请输入文章链接地址" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">所属分类</label>
                            <select class="form-control" name="cate_id">
                                @foreach($list as $v)<option value="{{$v['cate_id']}}">| @for($i=$v['Count'];$i>0;$i--)--@endfor{{$v['cate_name'].'('.$v['Count'].'级目录)'}}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group @if ($errors->has('art_rank')) has-error @endif">
                            <label>文章所在分类排序数</label>                           
                            <input type="text" name="art_rank" class="form-control " placeholder="请输入网站排序(数字越小排名越靠前)" value="{{old('art_rank')}}">
                            @if ($errors->has('art_rank')) <p class="help-block">{{ $errors->first('art_rank') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label>文章链接样式选择</label>
                            <div>
                                <label><input type="radio" name="art_mark_type"  checked="true" value="0">无样式</label>
                                @foreach($mark_css as $k=> $va)

                                <label class='{{$va['class_name']}}'>
                                    <input type="radio" name="art_mark_type" id="optionsRadios2" value="{{$va['id']}}">
                                           {{$va['class_name']}}
                                </label>

                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select class="form-control" name="art_status">
                                <option value="1"> 正常</option>
                                <option value="0"> 关闭</option>
                            </select>
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

<script src="{{ asset('/static/js/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('/static/js/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('/static/js/webuploader/webuploader.min.js') }}"></script>
<script src="{{ asset('/static/js/summernote/lang/summernote-zh-CN.js') }}"></script>
<script type="text/javascript">

// 添加全局站点信息
$(document).ready(function () {
    set_active_menu('article_sort', "{{ route('admin.article.index') }}");
    $('#desc_editor').summernote({
        lang: 'zh-CN',
        height: 300,
        onImageUpload: function (files, editor, welEditable) {
            upload_editor_image(files[0], "desc_editor", $("#editor_token").val());
        }
    });
    $('#desc_editor2').summernote({
        lang: 'zh-CN',
        height: 300,
        onImageUpload: function (files, editor, welEditable) {
            upload_editor_image(files[0], "desc_editor2", $("#editor_token").val());
        }
    });
    var art_from = $('input[name="art_from"]:checked').val();
    if (art_from == '1') {
        $('.reprint_info').hide();
    } else {
        $('.author').hide();
    }
    $('input[name="art_from"]').change(function () {
        var art = $(this).val();
        if (art == '2') {
            $('.author').hide();
            $('.reprint_info').show();
            $.ajax({
                url: "{{route('admin.article.getChoice')}}",
                data: {
                    _token: '{{csrf_token()}}'
                },
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data !== null && data !== '') {
                        var html = "常用来源选择:";
                        var copy_name = $("input[name='copy_name']");
                        $.each(data, function (index, item) {
                            html += '<input type="radio" value="' + item.web_name + '"  name="radio_name">' + item.web_name;
                        });
                        if ($('input[name="radio_name"]').length <= 0)
                            copy_name.after(html + '<br>');
                    }

                }
            });
        } else {
            $('.reprint_info').hide();
            $('.author').show();
        }
    });

});
</script>
@endsection