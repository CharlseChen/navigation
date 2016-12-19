@extends('game.public.layout')

@section('css')
    <link href="{{ asset('css/game/style4.css') }}?version={{config('game.version')}}Release{{config('game.release')}}" rel="stylesheet">
@endsection


@section('title')
{{$gameInfo->name}}
@endsection

@section('content')
<div id="loading">
    <div class="shu-bg">
        <img src="{{ asset('img/car.png')}}">
        <div class="loading-txt">loading...</div>
    </div>
</div>
<div class="sec">
    <img src="{{ asset('img/bg-1.jpg') }}">
    <div class="big-tit"><img src="{{ asset('img/big-tit.png') }}"></div>
    <div class="start" data-v="0"></div>
</div>
<div class="sec">
    <img src="{{ asset('img/bg-2.jpg')}}">
    <div class="absolute100"><img src="{{ asset('img/big-cho.png') }}"></div>
    <div class="choice choice-1" data-to=".cho1"></div>
    <div class="choice choice-2" data-to=".cho2"></div>
    <div class="choice choice-3" data-to=".cho3"></div>
</div>
<div class="sec cho1 gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                你接到了一个神秘任务，请速度前往敌后抗日根据地开展工作，请问你会选择去哪？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="1">陕甘宁抗日根据地</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="2">晋冀豫抗日根据地</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="3">东北抗日联军</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="4">日本本土</a>
            </div>
        </div>
    </div>
</div>
<div class="sec gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                到了根据地，你被任命为部队的政委，请问接下来的你工作如何展开？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="1">正面撸，带队冲锋</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="4">给士兵进行思想动员工作</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="2">管理好部队后勤补给</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="3">和人民群众搞好关系</a>
            </div>
        </div>
    </div>
</div>
<div class="sec gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                面对敌人的疯狂进攻，请给部队提供一些战斗的建议？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">以村庄为单位进行地道战</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="2">组织一批间谍窃取敌人情报</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="1">联系超级英雄准备手撕鬼子</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="3">呼唤国军一起协同作战</a>
            </div>
        </div>
    </div>
</div>
<div class="sec gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                敌人的进攻暂时被抵挡住了，但是你被俘虏了，面对接下来的拷问，你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">严刑拷打也绝不屈服</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="3">别打我，我什么都说</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="2">高官厚禄，我会考虑一下</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="1">美色引诱我才肯招</a>
            </div>
        </div>
    </div>
</div>
<div class="sec gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                你的部队赶来救你，陷入敌人重围，请问你会怎么做？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="2">战斗力爆棚，拿起重机枪扫射突围</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="4">让兄弟们先撤，自己独自殿后</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="1">抛下所有人，自己先逃命 </a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="3">寻找神秘地道脱险</a>
            </div>
        </div>
    </div>
</div>
<div class="sec gongjun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                被解救出来后，你痛定思痛，决定苦练好一门武艺，请问你想学
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">金刚不坏体，手撕鬼子</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">自动闪避所有子弹</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">自带穿越视角，人品光环</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">3000公里远程狙击</a>
            </div>
        </div>
    </div>
</div>
<div class="sec end"></div>
<div class="sec guojun cho2">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                蒋委员长命令你守住阵地7天，等待友军支援，你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">保证按时完成任务</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="3">马马虎虎坚持5天</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="2">管他几天，我又不是中央军</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="1">随时准备逃跑</a>
            </div>
        </div>
    </div>
</div>
<div class="sec guojun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                刚来到阵地，就碰到日军的进攻，这个时候需要你组织一波冲锋，你会喊：
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">兄弟们，跟着我冲</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="2">弟兄们，给我冲啊</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="3">为了委员长，为了党国，和他们拼了</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="1">脸都吓绿了，喊不出来</a>
            </div>
        </div>
    </div>
</div>
<div class="sec guojun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                经过一昼夜的鏖战，终于打退日军的进攻，请问你会怎么做
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">整顿战场，预防敌人第二波进攻</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="2">吓死宝宝了，喝杯39年的拉菲压压惊</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="1">赶紧回城里搂着四姨太庆祝一下</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="3">先打个电报邀功</a>
            </div>
        </div>
    </div>
</div>
<div class="sec guojun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                你艰难的守住了7天阵地，但是传说中的友军却迟迟不到，这时你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="4">坚守阵地，并催促友军快来</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="2">放弃阵地，保存自己实力</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="1">一怒之下投降日军</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="3">国军果然靠不住，不如投靠共军</a>
            </div>
        </div>
    </div>
</div>
<div class="sec guojun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                就在你犹豫的时候，这时友军的电话告诉你，他们不想增援你，你会怎么回应？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="2">哀求：看在党国的份上，拉兄弟一把</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="3">大骂：你们这群误国误党的傻X</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="4">大笑：老子就从来没有指望你们这群坑</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="1">不知道说什么了</a>
            </div>
        </div>
    </div>
</div>
<div class="sec guojun">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                最后，万幸日本人撤退了，你历经八十一难获得了胜利，请问你要何种嘉奖？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">国军最高荣誉“飞虎旗”</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">给我升官啊委员长</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">黄金黄金，法币我不要</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">请安排我去当台湾省长</a>
            </div>
        </div>
    </div>
</div>
<div class="sec end"></div>
<div class="sec ri cho3">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                马上就要出征了，请问你选择出征地区？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">留守日本</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">入侵中国</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">征服朝鲜</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">单挑美国</a>
            </div>
        </div>
    </div>
</div>
<div class="sec ri">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                在你出征前，天皇允许你许下一个心愿，你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">最后一晚，我需要安(A)慰(V) </a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">成为英勇的神风敢死队一员</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">赐刀一把，武士道精神不灭</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">打啥啊，我要求世界和平</a>
            </div>
        </div>
    </div>
</div>
<div class="sec ri">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                你已经踏上血淋林的战场上，面对手无缚鸡之力的百姓和士兵，你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">违反军令，放过他们</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">放过百姓，士兵留下</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">统统杀光（你还有没有人性）</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">男的杀光，女的留下</a>
            </div>
        </div>
    </div>
</div>
<div class="sec ri">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                突然一天，你收到了家乡被原子弹轰炸的消息，你的心里?
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">这TMD是天谴么</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">卧槽，我要和美国人拼了</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">还是投降吧，不然死更多人</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">庆幸还好我不在</a>
            </div>
        </div>
    </div>
</div>
<div class="sec ri">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                听到天皇下达投降的命令，这时，你会怎么做？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">陷入深深的绝望和反思</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">一怒拔刀，切腹自尽</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">率先扔下武器投降</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">继续战斗，直到战死</a>
            </div>
        </div>
    </div>
</div>
<div class="sec ri">
    <div class="question-shell">
        <div class="question-box">
            <div class="question-title">
                回到满目疮痍的家乡，以前很多的朋友，亲人都见不到了，你终于明白战争的残酷，饱受良心的谴责，你会？
            </div>
            <div class="question-options">
                <a class="options-item options-item1 do" href="javascript:void(0)" data-v="0">给战争里无辜的人们下跪道歉</a>
                <a class="options-item options-item2 do" href="javascript:void(0)" data-v="0">拒不认错（打死你）</a>
                <a class="options-item options-item3 do" href="javascript:void(0)" data-v="0">铭记战争的痛苦，变身和平人士</a>
                <a class="options-item options-item4 do" href="javascript:void(0)" data-v="0">退居山林</a>
            </div>
        </div>
    </div>
</div>
<div class="sec end"></div>
<div class="result">
    <div class="result-box">
        <div class="score-area">
            <div class="score-shell">
                <div class="score"><img src="{{ asset('img/max90.png') }}"></div>
                <div class="stars"><img src="{{ asset('img/90star.png')}}"></div>
                <div class="pingyu-box clearfix">
                    <div class="touxiang">
                        <img src="{{ asset('img/load.gif')}}">
                    </div>
                    <div class="pingyu"></div>
                </div>
            </div>
            <!--<div class="score"></div>-->
        </div>
        <div class="sun"></div>
    </div>
    <div class="two-btn">
        <a href="{{route('game.index.start',['filter'=>$game,'pid'=>$pid,'restart'=>1])}}" class="btn btn1"></a>
        <a class="btn btn2" href="javascript:void(0)"></a>
    </div>
    <div class="paihang">
        <img src="{{ asset('img/paihangbang.png')}}" class="phb">
        <ul class="top-list">
            <li class="top1 item clearfix">
                <span class="top-icon dline">1</span><img src="{{ asset('img/load.gif')}}" class="toux-item dline"><div class="dline dname">很屌的名字哦哦哦哦哦</div><div class="dline dzhanli">战力值:100</div>
            </li>
        </ul>
        <div class="saoma">
            <img src="{{ asset('img/erma.jpg')}}">
            <p>扫描关注『军事黑科技』,回复"GL"获取攻略</p >
        </div>
    </div>
    
    <div class="share">
        <img src="{{ asset('img/share.gif')}}" class="img-100">
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var submitGame = '{{route('game.index.end',['filter'=>$game,'pid'=>$pid])}}';
var submitGame_token = '{{ csrf_token()  }}';
@if($restartData)
	var restart = 1;
	var integral ={{$restartData['integral']}};
@else
	var restart = 0;
	var integral = 0;
@endif
</script>
<script src="{{ asset('js/game/base4.min.js' )}}?version={{config('game.version')}}Release{{config('game.release')}}"></script>
<script type="text/javascript" charset="utf-8">

wx.ready(function () {
    
    wx.onMenuShareAppMessage({
        title: '{{$gameInfo->share_title}}', // 分享标题
        desc: '{{$gameInfo->share_desc}}', // 分享描述
        link: '{{route('game.index.start',['filter'=>$game,'pid'=>$wechatOauth->id])}}', // 分享链接
        imgUrl: '{{$shareImg}}', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        trigger: function (res) {
            //alert('用户点击分享到朋友圈');
        },
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });

    wx.onMenuShareTimeline({
        title: '{{$gameInfo->share_title}}', // 分享标题
        link: '{{route('game.index.start',['filter'=>$game,'pid'=>$wechatOauth->id])}}', // 分享链接
        imgUrl: '{{$shareImg}}', // 分享图标
        trigger: function (res) {
            //alert('用户点击分享到朋友圈');
        },
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });
})
@endsection
