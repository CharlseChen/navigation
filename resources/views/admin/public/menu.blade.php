<ul class="sidebar-menu" id="root_menu">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a {!! get_menu_view('admin.index.index') !!}><i class="fa fa-dashboard"></i> <span>网站基本信息</span></a></li>
<!--    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>网站分类管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="websort">
            <li><a {!! get_menu_view('admin.websort.index',['cate_mod'=>'webdir']) !!}><i class="fa fa-circle-o"></i>分类树管理</a></li>
        </ul>
        <ul class="treeview-menu" id="website">
            <li><a {!! get_menu_view('admin.website.index') !!}><i class="fa fa-circle-o"></i>网站列表管理</a></li>
        </ul>
        <ul class="treeview-menu" id="link_style">
            <li><a {!! get_menu_view('admin.style.index') !!}><i class="fa fa-circle-o"></i>网站链接样式管理 </a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>文章分类管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="artsort">
            <li><a {!! get_menu_view('admin.websort.index',['cate_mod'=>'article']) !!}><i class="fa fa-circle-o"></i>文章分类列表</a></li>
        </ul>
        <ul class="treeview-menu" id="article_sort">
            <li><a {!! get_menu_view('admin.article.index') !!}><i class="fa fa-circle-o"></i>文章列表</a></li>
        </ul>
    </li>
    <li><a {!! get_menu_view('admin.wx.index') !!}><i class="fa fa-comments-o"></i> <span>微信公众号管理</span></a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>供求信息</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="trade_sort">
            <li><a {!! get_menu_view('admin.trade.district') !!}><i class="fa fa-circle-o"></i>分类管理</a></li>
        </ul>
        <ul class="treeview-menu" id="demand">
            <li><a {!! get_menu_view('admin.demand.index') !!}><i class="fa fa-circle-o"></i>供需信息管理</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-comments-o"></i> <span>用户反馈管理</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" id="feedback">
            <li><a {!! get_menu_view('admin.feedback.index') !!}><i class="fa fa-circle-o"></i>用户反馈</a></li>
        </ul>
        <ul class="treeview-menu" id="demand">
            <li><a {!! get_menu_view('admin.demand.index') !!}><i class="fa fa-circle-o"></i>常见问题</a></li>
        </ul>
    </li>
</ul>
