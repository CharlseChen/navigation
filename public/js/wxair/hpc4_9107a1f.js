function setWxShare(){var o=window.location.href,t=o.substr(0,o.indexOf("index.html"))+"index.html?bs=1";sgUrl=t+"&nn=share_weixin",descTxt="飞行员证书生成器",imgUrl=o.substr(0,o.indexOf("index.html"))+"images/s/fico/sico.png",titleTxt="飞行员证书生成器",console.log(titleTxt),console.log(descTxt),console.log(imgUrl),console.log(sgUrl),console.log("title:"+$(document).attr("title")),diyshareurls(t),is_weixn()&&1==NowSwitch&&(sgUrl=NowWxshare),change(titleTxt,sgUrl,descTxt,imgUrl)}function MathRand(){for(var o="",t=0;10>t;t++)o+=Math.floor(10*Math.random());return o}function getScrollTop(){var o=0;return document.documentElement&&document.documentElement.scrollTop?o=document.documentElement.scrollTop:document.body&&(o=document.body.scrollTop),o}function check(o){for(var t=1;5>t;t++)$("#textchoice"+t).removeClass("mover");$("#textchoice"+o).addClass("mover"),nowpng=o}var NowId="-10",NowStr="wx_hpc",NowSwitch,NowWxshare,NowTurnurl,chooseli=1;indexshare=!1;var nowpng=2;$(function(){NowSwitch=recommendJSON[NowId].switch,NowWxshare=recommendJSON[NowId].wxurl,NowTurnurl="http://"+recommendJSON[NowId].turnurl,$("#submit").click(function(){var o=$("#insert-name2").val();if(""==o)return void alert("请输入您的姓名");var t;1==nowpng?t=Math.round(29*Math.random())+1:2==nowpng?t=Math.round(35*Math.random())+1:3==nowpng?t=Math.round(11*Math.random())+1:4==nowpng&&(t=Math.round(11*Math.random())+1);var e=(Math.round(11*Math.random())+1,"http://"+getHost()+"/php/watermark/airlin.php?str="+o+"&num="+MathRand());$("#newpic").attr("src",e),$("#newpic").css("background","url(images/water3.png)"),$("#newpic").css("background-size","cover"),$(".rich_media_inner").hide(),$(".rich_media_bg").show()}),$(window).height()>$(".ggggg").height()+$(".ggggg").offset().top?$(".title").css("height",$(window).height()):$(".title").css("height",$(".ggggg").height()+$(".ggggg").offset().top)});