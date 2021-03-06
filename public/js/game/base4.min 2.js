/**
 * Created by jsbfec on 16/6/15.
 */
$(document).ready(function(){
    var $result=$(".result");
    var $score=$(".score");
    var $star=$(".stars");
    var sec1=$(".sec:eq(0)");
    var $loading = $("#loading");
    var $win = $(window);
    var wh = $win.height();
    var v=0;//分数
    var choiceJ;//保存出生选择
    var timer = null;
    var zIndex=999;
    var fenshu;
    var $py=$(".pingyu");
    var clickEvent = "ontouchstart" in document.documentElement ? "touchstart" : "click";
    if(restart!=1){
        sec1.css({
            "zIndex":zIndex
        }).fadeIn(500);
        --zIndex;
    //var mt=6*wh/100;//三军按钮修正位置
    //var opH=wh/10;//

//game start
    $(".start").on(clickEvent, function () {
        var $p=$(this).parents(".sec");
        var $n=$(this).parents(".sec").next();
        $p.addClass("animated bounceOutUp");
        $n.css({
            "zIndex":zIndex
        }).addClass("animated");
        --zIndex;
    });

    var cho=$(".choice");
//选择出生
    cho.on(clickEvent, function () {
        var $this = $(this);
        $this.unbind().siblings().unbind();
        var dTo = $this.attr("data-to");
        var $p = $this.parents(".sec");
        var $d = $(dTo);
        choiceJ = dTo;
        $p.addClass("animated bounceOutUp");
        $d.css({
            "zIndex":zIndex
        }).addClass("animated");
        --zIndex;
    });
//答题
    $(".do").on(clickEvent, function () {
        $this=$(this);
        $this.unbind().siblings().unbind();
        var $p=$this.parents(".sec");
        var $n=$this.parents(".sec").next();
        var nv=$n.hasClass("end");
        var v2=parseInt($this.attr("data-v"));
        v=v + v2;
        if(!nv){
            console.log(v);
            $p.addClass("animated bounceOutUp");
            $n.css({
                "zIndex":zIndex
            }).addClass("animated");
            --zIndex;
        }else {
            $("body").addClass("result-bg");
            fenshu=v*5;
            checkScore(fenshu)
            pushData(fenshu,"");
            console.log(v+"game over");
            $result.show();
            $p.addClass("animated bounceOutUp");
            $result.css({
                "zIndex":zIndex
            }).addClass("bounceIn animated");
            --zIndex;
        }
    });
    }else {
        $("body").addClass("result-bg");
        checkScore(integral);
        $result.show();
    }
    //checkScore
    function checkScore(v){

        if (v==0){
            $score.html("<img src='img/max0.png'>");
            $star.html("<img src='img/59star.png'>");
            $py.html("战斗力渣    当你选择日军的时候,你就已经是渣渣了");
        }else if ( v < 60 && v>0 ) {
                $score.html("<img src='img/max0.png'>");
                $star.html("<img src='img/59star.png'>");
                $py.html("新兵蛋子，请多看几部抗日神剧，我们再一起讨论吧。");
            } else if ( v < 70 && v >=60 ){
                $score.html("<img src='img/max60.png'>");
                $star.html("<img src='img/60star.png'>");
                $py.html("呃，你的战斗力刚刚合格，希望在战场上不要误伤队友。");
            } else if ( v < 80 && v >=70 ){
                $score.html("<img src='img/max70.png'>");
                $star.html("<img src='img/70star.png'>");
                $py.html("你是出色的战士，减少冲动，这样才能更好的赢得战斗。");
            }else if ( v < 90 && v >=80 ){
                $score.html("<img src='img/max80.png'>");
                $star.html("<img src='img/80star.png'>");
                $py.html("你是优秀的战士，客观冷静，是不可多得的伙伴。");
            }else if (v < 100&&v >=90 ){
                $score.html("<img src='img/max90.png'>");
                $star.html("<img src='img/90star.png'>");
                $py.html("以一敌百，勇武奋进，是一场战斗的中流砥柱。");
            }
            else if (v ==100 ){
                $score.html("<img src='img/max100.png'>");
                $star.html("<img src='img/100star.png'>");
                $py.html("你的战斗力爆棚，勇敢自信；是值得大家信赖的领袖。");
            }

    }
    //发送分数 拉取排行榜
    function pushData(v,sid) {
        $.ajax({
            type:"POST",
            url:"data/test.json",
            data: {intergral:v,pid:sid},
            dataType:"json",
            success:function (data) {
                var html="";
                var len=data.data.friRank.length;
                for (var i,i=0;i<len;i++){
                    switch (i){
                        case 0:
                            html += '<li class="top1 item clearfix"><span class="top-icon dline">'
                                +
                                '</span><img src="img/toux.jpg" class="toux-item dline">' +
                                '<div class="dline dname">'+data.data.friRank[i].name+'</div><div class="dline dzhanli">战力值:' +
                                data.data.friRank[i].intergral+'</div></li>';
                            break;
                        case 1:
                            html += '<li class="top2 item clearfix"><span class="top-icon dline">'
                                +
                                '</span><img src="img/toux.jpg" class="toux-item dline">' +
                                '<div class="dline dname">'+data.data.friRank[i].name+'</div><div class="dline dzhanli">战力值:'+data.data.friRank[i].intergral+'</div></li>';
                            break;
                        case 2:
                            html += '<li class="top3 item clearfix"><span class="top-icon dline">'
                                +
                                '</span><img src="img/toux.jpg" class="toux-item dline">' +
                                '<div class="dline dname">'+data.data.friRank[i].name+'</div><div class="dline dzhanli">战力值:'+data.data.friRank[i].intergral+'</div></li>';
                            break;
                        default:
                            html += '<li class="item clearfix"><span class="top-other dline">'
                                +(i+1)+
                                '</span><img src="img/toux.jpg" class="toux-item dline">' +
                                '<div class="dline dname">'+data.data.friRank[i].name+'</div><div class="dline dzhanli">战力值:'+data.data.friRank[i].intergral+'</div></li>';
                    }
                }
                $(".top-list").html(html);
            }
        })
    }

    //分享
    $(".btn2").on(clickEvent,function(){
       $(".share").fadeIn(500);
    })
    $(".share").on(clickEvent,function () {
        $(this).fadeOut(500);
    })
    //loading隐藏
    $win.load(function () {
        timer = setTimeout(function () {
            $loading.fadeOut(500);
        }, 1000);
        loadimg();
    });
    function loadimg(){
        new Image().src="img/max0.png";
        new Image().src="img/max60.png";
        new Image().src="img/max70.png";
        new Image().src="img/max80.png";
        new Image().src="img/max90.png";
        new Image().src="img/max100.png";
        new Image().src="img/59star.png";
        new Image().src="img/60star.png";
        new Image().src="img/70star.png";
        new Image().src="img/80star.png";
        new Image().src="img/90star.png";
        new Image().src="img/100star.png";
        new Image().src="img/sun.png";
        new Image().src="img/score-bg.png";
        new Image().src="img/result-bg.jpg";
    }
});
