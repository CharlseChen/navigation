function getDate() {
    var e, i = new Date, n = i.getDate(), t = i.getMonth() + 1, a = i.getFullYear();
    return e = a + "-" + checkNum(t) + "-" + checkNum(n)
}
function checkNum(e) {
    return 10 > e && (e = "0" + e), e
}
function getHost() {
    var e = "null", i = window.location.href, n = /.*\:\/\/([^\/]*).*/, t = i.match(n);
    return"undefined" != typeof t && null != t && (e = t[1]), e
}
function getTopHost() {
    var e = window.location.href;
    return e.replace(/http:\/\/.*?([^\.]+\.(com\.cn|org\.cn|net\.cn|[^\.]+))\/.+/, "$1").split("/")[0]
}
function __uri(e) {
    return e.replace("../", "")
}
function is_weixn() {
    return!1
}
function is_weixn2() {
    var e = navigator.userAgent.toLowerCase();
    return"micromessenger" == e.match(/MicroMessenger/i) ? !0 : !1
}
function is_weibo() {
    var e = navigator.userAgent.toLowerCase();
    return"weibo" == e.match(/WeiBo/i) ? !0 : !1
}
function is_qq() {
    var e = navigator.userAgent.toLowerCase();
    return"qq/" == e.match(/QQ\//i) ? !0 : !1
}
function Env() {
    function e(e) {
        return e.test(i)
    }
    var i = navigator.userAgent.toLowerCase();
    return{mobile: e(/applewebkit.*mobile.*/), isWindows: e(/windows|win32/), isMac: e(/macintosh|mac os x/)}
}
function sortorder(e) {
    for (var i, n, t = e.length; t; i = parseInt(Math.random() * t), n = e[--t], e[t] = e[i], e[i] = n)
        ;
    return e
}
function deleteAllCookie() {
    for (var e = document.cookie.split(";"), i = 0; i < e.length; i++) {
        var n = e[i].split("=");
        n[0].indexOf("packet_accid") > -1 || n[0].indexOf("packet_img") > -1 || n[0].indexOf("packet_id") > -1 || (document.cookie = n[0] + "=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/; domain=" + oDomain)
    }
}
function getpara() {
    var e = document.URL, i = "";
    if (e.lastIndexOf("?") > 0) {
        i = e.substring(e.lastIndexOf("?") + 1, e.length);
        var n = i.split("&");
        i = "";
        for (var t = 0; t < n.length; t++) {
            var a = n[t].split("=")[0], o = n[t].split("=")[1];
            "name" == a && (sName = decodeURIComponent(o)), "id" == a && (sId = decodeURIComponent(o), $.cookie("packet_accid", sId, {expires: 1, path: "/", domain: oDomain})), "date" == a && (sDate = decodeURIComponent(o)), "year" == a && (sYear = decodeURIComponent(o)), "place" == a && (sPlace = decodeURIComponent(o)), "bs" == a && (sBs = decodeURIComponent(o)), "score" == a && (sScore = decodeURIComponent(o)), "sex" == a && (sSex = decodeURIComponent(o)), "img" == a && "" != o && "undefined" != o && (sImg = decodeURIComponent(o), $.cookie("packet_img", sImg, {expires: 1, path: "/", domain: oDomain})), "num" == a && (sNum = decodeURIComponent(o), $.cookie("packet_id", sNum, {expires: 1, path: "/", domain: oDomain})), "level" == a && (sLevel = decodeURIComponent(o)), "food" == a && (sFood = decodeURIComponent(o)), "frid" == a && (sFrid = decodeURIComponent(o)), "api" == a && (nowapi = decodeURIComponent(o)), "logflag" == a && (logflag = decodeURIComponent(o))
        }
    }
}
function createArray(e, i, n) {
    var t = [];
    for (t.push(n); t.length < i + 1; ) {
        for (var a = parseInt(Math.random() * e), o = !1, s = 0; s < t.length; s++)
            if (t[s] == a) {
                o = !0;
                break
            }
        o || (t[t.length] = a)
    }
    return t.shift(), t
}
function include_js(e) {
    var i = document.createElement("script");
    i.type = "text/javascript", i.src = e;
    var n = document.getElementsByTagName("head")[0];
    n.appendChild(i)
}
function include_css(e) {
    var i = document.createElement("link");
    i.rel = "stylesheet", i.type = "text/css", i.href = e;
    var n = document.getElementsByTagName("head")[0];
    n.appendChild(i)
}
function randomString(e) {
    e = e || 32;
    var n = "ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678", t = n.length, a = "";
    for (i = 0; e > i; i++)
        a += n.charAt(Math.floor(Math.random() * t));
    return a
}
function tipshow(e) {
    $("#tiptxt").html(e), $("#tiping").fadeIn(), setTimeout(function () {
        $("#tiping").fadeOut()
    }, 2e3)
}
function seturl(e) {
    var i = "";
    i = 10 > e ? "act0" + e : "act" + e, e > 20 && (i = "act20");
    for (var n in recommendJSON)
        recommendJSON[n].turnurl = i
}
function getvisitnum() {
    var e = '{"key":"visits"}';
    $.jsonp({
        url: getviewapi, data: {req: e}, callback: "success", success: function (e) {
            var i = Number(e.num);
            console.log(i), console.log(e), seturl(Number(e.typ))
        }, error: function (e, i) {
            console.log(i)
        }})
}
function getNowNum(e) {
    var i = nowurl.split("?")[0].split("?")[0].split("/"), n = i[i.length - 2];
    void 0 != e && (n = e);
    for (var t = recommendJSON.initialnum; t < recommendJSON.count; t++)
        if (n == recommendJSON[t].main)
            return thistitle = recommendJSON[t].main, t
}
function getMainName() {
    var e = nowurl.split("?")[0].split("?")[0].split("/"), i = e[e.length - 2];
    return i
}
function getFoodCount(e, i) {
    var n = "";
    1 == i || 2 == i ? n = '{"key":"' + e + '","typ":"main"}' : 5 == i && (n = '{"key":"' + e + '","typ":"result"}'), $.jsonp({url: getcountapi, data: {req: n}, callback: "success", success: function (e) {
            var n = Number(recommendJSON[currentNum].num);
            console.log(n), console.log(e), 1 == i && ($(".participation-status .count").text(3 * Number(e.num) + n), descTxt = 3 * Number(e.num) + n + "人已参加该测试"), 2 == i && ($(".participation-status .count").text(3 * Number(e.num) + n), dealResult(e, 2)), 3 == i && $("#prase-result span.count").html(Number(e.num) + Math.ceil(n / 10) > 1e5 ? "10万+" : Number(e.num) + Math.ceil(n / 10)), 5 == i && dealResult(e, 5)
        }, error: function (e, i) {
            console.log(i)
        }})
}
function isIE() {
    if (window.ActiveXObject || "ActiveXObject"in window) {
        var e = (document.getElementsByTagName("body")[0].offsetWidth - document.getElementById("loadADs").offsetWidth) / 2;
        $("#loadADs").css("left", e + "px"), $(window).resize(function () {
            var e = (document.getElementsByTagName("body")[0].offsetWidth - document.getElementById("loadADs").offsetWidth) / 2;
            $("#loadADs").css("left", e + "px")
        })
    }
}
function allCount() {
    var e = navigator.userAgent.toLowerCase();
    _hmt.push("micromessenger" == e.match(/MicroMessenger/i) ? ["_trackEvent", "platform", "open", "weixin"] : "weibo" == e.match(/WeiBo/i) ? ["_trackEvent", "platform", "open", "weibo"] : "qq/" == e.match(/QQ\//i) ? ["_trackEvent", "platform", "open", "qq"] : ["_trackEvent", "platform", "open", "others"])
}
function UpdateReaded() {
    if (0 == adsReadedJSON.count)
        return void $(window).unbind("scroll", UpdateReaded);
    for (var e = 0; e < adsReadedJSON.count; e++)
        adsReadedJSON[e].second = 0, clearInterval(adsReadedJSON[e].timer), addReadedElement(adsReadedJSON[e].name, e)
}
function addReadedElement(e, i) {
    if (0 != $(e).length) {
        var n = $(e).offset().top, t = $(e).innerHeight(), a = $(window).scrollTop() + $(window).height();
        e = e.substring(1, e.length), a >= n + t && $(window).scrollTop() < n - 1 && (adsReadedJSON[i].timer = setInterval("OnlineStayTime('" + e + "', '" + i + "')", 1e3))
    }
}
function OnlineStayTime(e, i) {
    if (adsReadedJSON[i].second++, console.log("adsName:" + e), adsReadedJSON[i].second > 2 && (console.log("已触发2s update"), clearInterval(adsReadedJSON[i].timer), 0 == adsReadedJSON[i].status)) {
        if ("footer" == e)
            for (var n = adsReadedJSON[i].tag, t = 0; t < n.length; t++)
                _hmt.push(["_trackEvent", "Footer", "cnf-view", "cnfv-" + n[t]]);
        else
            console.log(adsReadedJSON[i].tag), _hmt.push(["_trackEvent", "Recommend", "cnr-view", "cnrv-" + adsReadedJSON[i].tag]);
        adsReadedJSON[i].status = !0, console.log(adsReadedJSON[i])
    }
}
function addAsdHtml() {
    var e = "<a id=\"asd1\" onclick=\"_hmt.push(['_trackEvent', 'Recommend', 'cnr-click', 'cnrc-nienieapp']);\" href=\"http://t.cn/RUPhvip?bepro=" + thistitle + '" class="related-item"><div class="img"><img src="../main/images/asd/ndsq.png" alt=""><span class="rank-badge">1</span></div><div class="desc">捏捏 - 脑洞大开的社交平台</div></a>', i = e;
    return fixedad > 0 ? i : ""
}
function getRandomRecommend(e) {
    if (recommendJSON.count < e)
        return $("#recommend").hide(), void $(".quiz-list").hide();
    var i = gethotnum(e);
    console.log(i);
    var n = addAsdHtml(), t = createRedHtml(recommendJSON, i);
    $(".quiz-list").html("").append(n + t)
}
function createRedHtml(e, i) {
    for (var n = "", t = "", a = 0; a < i.length; a++) {
        var o = a + 1 + fixedad, s = e[i[a]].main;
        t = '<a id="related-' + s + "\" class=\"related-item\" onclick=\"_hmt.push(['_trackEvent', 'Recommend', 'cnr-click', 'cnrc-" + s + '\']);" href="../' + s + "/index.html?adid=nieio&ad=" + o + "&bepro=" + thistitle + '"><div class="img"><img alt="" src="' + cndsubstr + "../" + s + "/images/" + s + '.png"><span class="rank-badge">' + o + '</span></div><div class="desc">' + e[i[a]].title + "</div></a>", n += t
    }
    return n
}
function gethotjson() {
    var e = 0;
    hotArr = [];
    for (var i in recommendJSON)
        "count" != i && 1 == recommendJSON[i].red && (hotrecommendJSON[i] = recommendJSON[i], hotArr.push(i), e++);
    hotrecommendJSON.count = e
}
function gethotnum(e) {
    for (var i = [], n = 0; e > n; n++)
        hotArr[n] == currentNum ? e++ : i.push(hotArr[n]);
    return i
}
function getAnotherNum(e, i) {
    var n = [];
    for (n.push(currentNum); n.length < i + 1; ) {
        for (var t = parseInt(Math.random() * e), a = !1, o = 0; o < n.length; o++)
            if (n[o] == t) {
                a = !0;
                break
            }
        a || (n[n.length] = t)
    }
    return n.shift(), n
}
function getTwoAds(e, i) {
    for (var n = []; n.length < i; ) {
        for (var t = parseInt(Math.random() * e), a = !1, o = 0; o < n.length; o++)
            if (n[o] == t) {
                a = !0;
                break
            }
        a || (n[n.length] = t)
    }
    return n
}
function addfooter() {
    var e, i = footerJSON.count, n = 2, t = getTwoAds(i, n);
    footerArr = [footerJSON[t[0]].tag, footerJSON[t[1]].tag], e = nowurl.indexOf("band2015") > -1 || nowurl.indexOf("color2015") > -1 ? "<li><a onclick=\"_hmt.push(['_trackEvent', 'Footer', 'cnf-click', 'cnfc-nndbz']);\" href=\"http://www.acfun.tv/v/ac2177899?adid=band2015-index&ad=2\">「捏捏大爆炸」租房子能和美女\"生\"孩子？</a></li>" : '<li><a href="' + footerJSON[t[1]].link + "\" onclick=\"_hmt.push(['_trackEvent', 'Footer', 'cnf-click', 'cnfc-" + footerArr[1] + "']);\">" + footerJSON[t[1]].txt + "</a></li>";
    var a = new Date, o = '<div class="container"><ul><li><a href="' + footerJSON[t[0]].link + "\" onclick=\"_hmt.push(['_trackEvent', 'Footer', 'cnf-click', 'cnfc-" + footerArr[0] + "']);\" >" + footerJSON[t[0]].txt + "</a></li>" + e + '</ul><div class="copyright"><a class="cpya" href="http://nienie.im/">&copy; ' + (a.getYear() + 1900) + ' 捏捏</a> | <a href="' + prstr + 'main/aboutservice.html">隐私条款</a> | <a href="' + prstr + 'main/about.html">关于我们</a> </div></div>';
    $(".footer").html("").append(o)
}
function loadADs() {
    var e = adsJSON.count, i = 2, n = getTwoAds(e, i);
    loadArr = [adsJSON[n[0]].tag, adsJSON[n[1]].tag];
    var t = '<div id="loadADs"><div id="loadADsMain"><div class="header" id="adHeader"><div class="compact"> <a class="brand" href="../index.html"><img src="../main/images/logo.png"></a> <div class="weixin float1"> <a href="http://mp.weixin.qq.com/s?__biz=MzI2NDAyODI3OA==&amp;mid=207313148&amp;idx=1&amp;sn=6e2912e2a981be45e56eb330840f6ca0#rd" target="_blank"> <img width="80" border="0" title="天天微漫画-捏捏." alt="天天微漫画-捏捏" src="http://cn.nie.io/main/images/v_focus_nienie.png"> </a> </div> </div> </div><p><img width="48" height="48" class="result-loading" src="' + cndsubstr + '../main/images/spin.png" alt=""></p><p id="loadingword">正在计算结果中...</p><p >添加微信公众号，一手新鲜测试抢先体验！<br />Wechat ID：nie_io</p><p class="loadad"><a target="_blank" onclick="_hmt.push([\'_trackEvent\', \'Loading\', \'cnl-click\', \'cnlc-' + loadArr[0] + '\']);" href="' + adsJSON[n[0]].link + '"><img alt="' + adsJSON[n[0]].txt + '" src="' + cndsubstr + "../main/images/asd/" + adsJSON[n[0]].img + '" width="100%" class="load-asd1"></a><a target="_blank" onclick="_hmt.push([\'_trackEvent\', \'Loading\', \'cnl-click\', \'cnlc-' + loadArr[1] + '\']);" href="' + adsJSON[n[1]].link + '"><img alt="' + adsJSON[n[1]].txt + '" src="' + cndsubstr + "../main/images/asd/" + adsJSON[n[1]].img + '" width="100%" class="load-asd2"></a></p></div></div>';
    $("#loading").html("").append(t), isIE()
}
function startLoadAds() {
    loadADs(), setTimeout(function () {
        $("#loading").fadeOut(200), $("#resultPage").fadeIn(200), addfix()
    }, 2e3)
}
function addfix() {
    if (-1 != nowurl.indexOf("/result.html") && void 0 != recommendJSON[currentNum] && "" != recommendJSON[currentNum].psw) {
        var e = '<div id="actfix"><a href="http://mp.weixin.qq.com/s?__biz=MzI2NDAyODI3OA==&mid=400233771&idx=1&sn=79ddde1ee740098128e040cd15840b15#rd" target="_blank" onclick="_hmt.push([\'_trackEvent\', \'footeract\', \'footeract-click\', \'footeract-3570\']);"><div class="actword">活动密码：' + recommendJSON[currentNum].psw + "</div></a></div>";
        $("body").append(e), setTimeout(function () {
            $("#actfix").fadeOut(200)
        }, 5e3)
    }
}
function creatsharethings() {
    var e = currentNum;
    titleTxt = $(document).attr("title");
    var i = nowurl;
    -1 == i.indexOf("?") && (i += "?"), sgUrl = i + "&nn=share_weixin", descTxt = "NIE.IO 超有趣的娱乐自媒体品牌", imgUrl = recommendJSON[e] ? preurl + "/" + recommendJSON[e].main + "/images/s/fico/sico.png" : preurl + "/main/images/nnys.png", console.log("index:" + titleTxt), console.log("index:" + descTxt), console.log("index:" + imgUrl), console.log("index:" + sgUrl), urlweibo = "http://service.weibo.com/share/share.php?url=" + encodeURIComponent(i + "&nn=share_weibo") + "&title=" + titleTxt + "&pic=" + imgUrl + "&appkey=2611781654&ralateUid=5655640783&source=捏捏运势&sourceUrl=http://www.nienie.im&content=utf8&searchPic=true", urlqzone = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + encodeURIComponent(i + "&nn=share_zone") + "&summary=" + titleTxt + "&pics=" + imgUrl + "&site=APP捏捏", urlrenren = "http://widget.renren.com/dialog/share?resourceUrl=http://cn.nie.io&srcUrl=" + encodeURIComponent(i + "&nn=share_renren") + "&title=" + titleTxt + "&description=" + descTxt + "&pic=" + imgUrl, urldouban = "http://shuo.douban.com/!service/share?image=" + imgUrl + "&href=" + encodeURIComponent(i + "&nn=share_douban") + "&name=" + titleTxt + "&text=" + descTxt, urlqqwb = "http://v.t.qq.com/share/share.php?c=share&title=" + titleTxt + "&url=" + encodeURIComponent(i + "&nn=share_qqweibo") + "&appkey=413d5d99865efb51bd7689741af0e13e&pic=" + imgUrl, urllinkedin = "http://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(i + "&nn=share_linkedin") + "&title=" + titleTxt, urltwitter = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(i + "&nn=share_twitter") + "&text=" + titleTxt + "&hashtags=捏捏运势", urlfacebook = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(i + "&nn=share_facebook") + "&picture=" + imgUrl, urlgoogleplus = "https://plus.google.com/share?url=" + encodeURIComponent(i + "&nn=share_gooleplus"), change(titleTxt, sgUrl, descTxt, imgUrl)
}
function diyshareurls(e) {
    var i = $.cookie("openid");
    "" != i && null != i && e.indexOf("bs=1") > -1 && (e = e.replace("bs=1", "frid=" + i + "&bs=1")), titleTxt = titleTxt.replace("%", "%25"), urlweibo = "http://service.weibo.com/share/share.php?url=" + encodeURIComponent(e + "&nn=share_weibo") + "&title=" + titleTxt + "&pic=" + imgUrl + "&appkey=2611781654&ralateUid=5655640783&source=捏捏运势&sourceUrl=http://www.nienie.im&content=utf8&searchPic=true", urlqzone = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + encodeURIComponent(e + "&nn=share_zone") + "&summary=" + titleTxt + "&pics=" + imgUrl + "&site=APP捏捏", urlrenren = "http://widget.renren.com/dialog/share?resourceUrl=http://cn.nie.io&srcUrl=" + encodeURIComponent(e + "&nn=share_renren") + "&title=" + titleTxt + "&description=" + descTxt + "&pic=" + imgUrl, urldouban = "http://shuo.douban.com/!service/share?image=" + imgUrl + "&href=" + encodeURIComponent(e + "&nn=share_douban") + "&name=" + titleTxt + "&text=" + descTxt, urlqqwb = "http://v.t.qq.com/share/share.php?c=share&title=" + titleTxt + "&url=" + encodeURIComponent(e + "&nn=share_qqweibo") + "&appkey=413d5d99865efb51bd7689741af0e13e&pic=" + imgUrl, urllinkedin = "http://www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(e + "&nn=share_linkedin") + "&title=" + titleTxt, urltwitter = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(e + "&nn=share_twitter") + "&text=" + titleTxt + "&hashtags=捏捏运势", urlfacebook = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(e + "&nn=share_facebook") + "&picture=" + imgUrl, urlgoogleplus = "https://plus.google.com/share?url=" + encodeURIComponent(e + "&nn=share_gooleplus")
}
function addshare() {
    var e = ["weibo", "qzone", "renren", "douban", "tweibo", "linkedin", "twitter", "facebook", "google"], i = '<!--分享--><div id="share"><img id="shraeimg" src="../main/images/icons/shareimg.png"><div class="sharediv"><div class="share-close"><img width="100%" src="../main/images/login/nie-login-close.png"/></div><div class="share-title"><div class="share-ts"><span>分享</span></div></div><div class="shareicon"><div id="shareweibo" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[0] + '\']);"><img src="../main/images/icons/weibo.png" /><div class="sharetxts">新浪微博</div></div></div><div class="shareicon"><div id="shareqzone" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[1] + '\']);"><img src="../main/images/icons/qzone.png" /><div class="sharetxts">QQ空间</div></div></div><div class="shareicon"><div id="sharerenren" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[2] + '\']);"><img src="../main/images/icons/renren.png" /><div class="sharetxts">人人网</div></div></div><div class="clear"></div><div class="shareicon"><div id="sharedouban" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[3] + '\']);"><img src="../main/images/icons/douban.png" /><div class="sharetxts">豆瓣</div></div></div><div class="shareicon"><div id="shareqqwb" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[4] + '\']);"><img src="../main/images/icons/qqwb.png" /><div class="sharetxts">腾讯微博</div></div></div><div class="shareicon"><div id="sharelinkedin" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[5] + '\']);"><img src="../main/images/icons/linkedin.png" /><div class="sharetxts">LinkedIn</div></div></div><div class="clear"></div><div class="shareicon"><div id="sharetwitter" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[6] + '\']);"><img src="../main/images/icons/twitter.png" /><div class="sharetxts">Twitter</div></div></div><div class="shareicon"><div id="sharefacebook" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[7] + '\']);"><img src="../main/images/icons/facebook.png" /><div class="sharetxts">Facebook</div></div></div><div class="shareicon"><div id="sharegoogleplus" class="shareway" onclick="toshare(this.id);_hmt.push([\'_trackEvent\', \'Share\', \'cns-share\', \'cns-' + e[8] + '\']);"><img src="../main/images/icons/googleplus.png" /><div class="sharetxts">Google+</div></div></div><div class="clear" style="height:10px;"></div></div></div>';
    $("body").append(i), $(".share-close").click(function () {
        $("#share").hide()
    }), $("#share").click(function (e) {
        ("share" == e.target.id || "shraeimg" == e.target.id) && $("#share").hide()
    }), window.onload = function () {}
}
function checkvpn() {
    $.jsonp({url: "http://graph.facebook.com/", data: {id: "http://nie.io", callback: "callback"}, callback: "callback", success: function (e) {
            console.log("22:" + e), shareenabled("twitter"), shareenabled("facebook"), shareenabled("googleplus")
        }, error: function (e, i) {
            console.log("11:" + i), shareenabled("twitter"), shareenabled("facebook"), shareenabled("googleplus")
        }})
}
function sharedisabled(e) {
    $("#share" + e + " img").attr("src", "../main/images/icons/" + e + "-grey.png")
}
function shareenabled(e) {
    $("#share" + e + " img").attr("src", "../main/images/icons/" + e + ".png")
}
function toshare(val) {
    -1 == $("#" + val + " img").attr("src").indexOf("grey") && (_hmt.push(["_trackEvent", "activity", "share", val]), window.location.href = eval(val.replace("share", "url")))
}
function shares() {
    is_weixn() ? $("#shraeimg").show() : $("#shraeimg").hide(), $("#share").show();
    var e = ($(window).height() - $("#shraeimg").height() - $(".sharediv").height()) / 2;
    5 > e ? e = "5px" : e += "px", $(".sharediv").css("bottom", e), $(window).resize(function () {
        var e = ($(window).height() - $("#shraeimg").height() - $(".sharediv").height()) / 2;
        5 > e ? e = "5px" : e += "px", $(".sharediv").css("bottom", e)
    }), $("#share").animate({opacity: "1"}, 500)
}
function sharesnone() {
    $("#share").animate({opacity: "0"}, 500), $("#share").hide()
}
function nonceStr() {
    return nonceStr = Math.random().toString(36).substr(2, 15)
}
function timestamp() {
    return timestamp = parseInt((new Date).getTime() / 1e3) + ""
}
function calcSignature(e, i, n, t) {
    var a = "jsapi_ticket=" + e + "&noncestr=" + i + "&timestamp=" + n + "&url=" + t;
    return shaObj = new jsSHA(a, "TEXT"), shaObj.getHash("SHA-1", "HEX")
}
function change(e, i) {
    var n = $.cookie("openid");
    "" != n && null != n && void 0 != i && i.indexOf("bs=1") > -1 && (sgUrl = i.replace("bs=1", "frid=" + n + "&bs=1")), titleTxt = e.replace("%", "%25"), is_weixn() && sendAjax()
}
function define_wx_share() {}
function sendAjax() {
    var e;
    e = "http://" + getHost() + shareticket, $.ajax({type: "POST", url: e, data: {id: shareapp[ticketran]}, success: function (e) {
            "string" == typeof e && (e = JSON.parse(e)), 0 == e.result && (ticket = e.ticket, signature = calcSignature(ticket, nonceStr, timestamp, window.location.href), define_wx_share(titleTxt, sgUrl, descTxt, imgUrl))
        }, error: function () {}})
}
function checkLoginStatus() {
    var e = $.cookie("account_id"), i = $.cookie("nieio_nick_name");
    null != i && "" != i && (onlineStatus = 1), null != e && "" != e && (onlineStatus = 1 != onlineStatus ? 2 : 3)
}
function addFriendList() {
    var e = $.cookie("account_id"), i = $.cookie("openid");
    if (console.log("onlineStatus:" + onlineStatus), void 0 == sFrid || "" == sFrid ? sFrid = $.cookie("frid") : ($("#retry2").attr("onclick", "javascript:location.href='" + newurl + "index.html?frid=" + sFrid + "&adid=metoo'"), $.cookie("frid", sFrid, {path: "/", domain: oDomain})), console.log("sFrid:" + sFrid), (2 == onlineStatus || 3 == onlineStatus) && i != sFrid && null != sFrid && "" != sFrid) {
        var n = "http://" + getHost() + "/php/friend.php";
        $.post(n, {account_id: e, frid: sFrid}, function (e) {
            console.log(e), "string" == typeof e && (e = JSON.parse(e)), "0" == e.result && $.cookie("frid", null, {path: "/", domain: oDomain})
        })
    }
}
function skip_to_wx() {
    deleteCookie();
    var e = "wx56ce2d9f02b99033", i = "http://h5.nie.io/apiweb/wechat.html", n = window.location.href.split("?")[0], t = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" + e + "&redirect_uri=" + i + "&response_type=code&scope=snsapi_userinfo&state=" + encodeURIComponent(n) + "#wechat_redirect";
    window.location.href = t
}
function skip_to_qq() {
    deleteCookie();
    var e = "101187094", i = "http://h5.nie.io/apiweb/qq.html", n = window.location.href, t = "https://graph.qq.com/oauth2.0/authorize?client_id=" + e + "&redirect_uri=" + i + "&scope=get_user_info&response_type=token&state=" + encodeURIComponent(n);
    window.location.href = t
}
function skip_to_wb() {
    deleteCookie();
    var e = "2611781654", i = "http://h5.nie.io/apiweb/weibo.html", n = window.location.href, t = "https://api.weibo.com/oauth2/authorize?client_id=" + e + "&redirect_uri=" + i + "&response_type=code&state=" + encodeURIComponent(n);
    window.location.href = t
}
function deleteCookie() {
    $.cookie("nieio_avatar", null, {path: "/", domain: oDomain}), $.cookie("nieio_nick_name", null, {path: "/", domain: oDomain}), $.cookie("nieio_sex", null, {path: "/", domain: oDomain}), $.cookie("nieio_age") && $.cookie("nieio_age", null, {path: "/", domain: oDomain}), $.cookie("openid") && $.cookie("openid", null, {path: "/", domain: oDomain}), $.cookie("access_token") && ($.cookie("access_token", null, {path: "/", domain: oDomain}), $.cookie("account_id", null, {path: "/", domain: oDomain}))
}
function getJsonCookie() {
    $.jsonp({url: "http://h5.nie.io/php/getcs.php", data: {}, callback: "nienie", success: function (e) {
            if ("true" == nowapi ? $.cookie("loginFlag", logflag, {expires: 7, path: "/", domain: oDomain}) : $.cookie("loginFlag") || $.cookie("loginFlag", e.loginFlag, {expires: 1, path: "/", domain: oDomain}), void 0 != e.access_token && "" != e.access_token && null != e.access_token)
                loginNieio(e.access_token, e.openid, e.account_id);
            else if (console.log("获取信息失败，请重新登录"), (is_weixn() || is_qq() || is_weibo()) && !debugboo && indexboo && -1 == nowurl.indexOf("api=")) {
                if (is_weixn())
                    return void skip_to_wx();
                if (is_qq())
                    return void skip_to_qq();
                if (is_weibo())
                    return void skip_to_wb()
            } else
                tiplog()
        }, error: function (e, i) {
            console.log(i)
        }})
}
function deleleJsonCookie() {
    $.jsonp({url: "http://h5.nie.io/php/delcs.php", data: {}, callback: "nienie", success: function (e) {
            console.log(e + "删除成功")
        }, error: function (e, i) {
            console.log(i)
        }})
}
function loginNieio(e, i, n) {
    var t = {access_token: e, account_id: n};
    $("#login").html("...");
    var a = "http://" + getHost() + "/php/user.php";
    $.post(a, t, function (e) {
        "string" == typeof e && (e = JSON.parse(e)), console.log(e), "0" == e.result ? ($.cookie("nieio_avatar", e.avatar, {expires: 1, path: "/", domain: oDomain}), $.cookie("nieio_nick_name", e.name, {expires: 1, path: "/", domain: oDomain}), $.cookie("nieio_sex", e.sex, {expires: 1, path: "/", domain: oDomain}), $.cookie("openid") || $.cookie("openid", i, {expires: 1, path: "/", domain: oDomain}), $.cookie("account_id") || $.cookie("account_id", n, {expires: 1, path: "/", domain: oDomain}), e.age > 0 && $.cookie("nieio_age", e.age, {expires: 1, path: "/", domain: oDomain}), userMsg()) : (deleteCookie(), deleteAllCookie(), tiplog())
    }).error(function () {
        tiplog()
    })
}
function tiplog() {
    indexboo && ($("#login").html("登录"), $("#login").show(), $("#user-info").hide())
}
function loginDialog() {
    var e = '<div id="loginDialog"> <div class="loginMain"> <div class="loginDiv"> <div class="LG-close">关闭</div> <div class="LG-title"><div class="LG-ts"><span>可以用以下方式登录</span></div></div> <p class="login-txt login-wb">微博登录</p> <p class="login-txt lgtxt1 login-qq">QQ登录</p> </div> </div></div>';
    $("body").append(e), $(".login-qq").bind("click", function () {
        skip_to_qq()
    }), $(".login-wb").bind("click", function () {
        skip_to_wb()
    }), $(".LG-close").bind("click", function () {
        $("#loginDialog").hide()
    })
}
function loginoutDialog() {
    var e = '<div id="loginoutDialog"> <div class="LGoutMain"> <div class="LGoutDiv fr"> <div class="LGArrow"></div> <div class="LGmsg clearfix"> <dl> <dt><img id="LGAvatar" src="" alt="头像"/></dt> <dd id="LGName">vincent</dd> </dl> </div> <div class="login-exit"><button>退出</button></div> </div> </div></div>';
    $("body").append(e)
}
function fastLGDialog() {
    var e = '<div id="fastLogin"> <div id="fast-close" class="fast-close"><a href="javascript: ;">关闭</a></div> <div id="fastMain"> <div class="fastGz"> <dl> <dt class="codeImg"></dt> <dd> <p> 扫描左侧二维码，关注</p> <p>NIE.IO官方微信公众账号</p> </dd> </dl> </div> <div class="fastLG"> <p>快捷登录</p> <a href="javascript: ;" class="LGWB fLGBtn">新浪微博登录</a> <a href="javascript: ;" class="LGQQ fLGBtn">qq登录</a> </div> </div></div>';
    currentNum > 0 && $("body").append(e), $("#fast-close").bind("click", function () {
        $("#fastLogin").fadeOut()
    }), $(".LGWB").bind("click", function () {
        skip_to_wb()
    }), $(".LGQQ ").bind("click", function () {
        skip_to_qq()
    })
}
function registerExit() {
    $(".login-exit").bind("click", function () {
        deletePlayedView(), deleteAllCookie(), $("#loginoutDialog").hide(), tiplog(), $("#insert-name") && $("#insert-name").attr("value", ""), $("#insert-name2") && $("#insert-name2").attr("value", ""), deleleJsonCookie()
    })
}
function registerHide() {
    $("#loginDialog").click(function (e) {
        ("loginDialog" == e.target.id || "loginMain" == e.target.className) && $("#loginDialog").hide()
    }), $("#loginoutDialog").click(function (e) {
        ("loginoutDialog" == e.target.id || "LGoutMain" == e.target.className) && $("#loginoutDialog").hide()
    })
}
function userMsg() {
    $("#fastLogin").hide(), $("#login").hide(), $("#LGAvatar").attr("src", $.cookie("nieio_avatar")), $("#LGName").html($.cookie("nieio_nick_name")), $("#user-info").show().css({background: "url(" + $.cookie("nieio_avatar") + ") no-repeat center center / cover"}), $("#header").append("<img src='" + $.cookie("nieio_avatar") + "' alt='头像' style='display:none' id='usrAvatar' />"), $("#insert-name") && $("#insert-name").attr("value", $.cookie("nieio_nick_name")), "男" == $.cookie("nieio_sex") ? $("#sexTxt").attr("value", 1) : $("#sexTxt").attr("value", 0), $("#nameBox") && $("#nameBox").show(), $("#submit") && $("#submit").show(), $("#submit2") && $("#submit2").hide(), logafter(), indexboo && $("#play-login-click")[0] && -1 == nowurl.indexOf("nie.io") && (getPlayedData(), $("#play-login-click").hide()), indexboo && nowurl.indexOf("index.html") > -1 && currentNum > 0 && (addPlayedData(), getLikesPlayed())
}
function logafter() {}
function addPlayedData() {
    if (indexboo && "" != prstr) {
        var e = $.cookie("account_id");
        null != e && "" != e && $.post("http://" + getHost() + "/php/play.php", {source: nowlan, handle: "playing", name: mainName, id: currentNum, account_id: e}, function (e) {
            console.log(e)
        })
    }
}
function getPlayedData() {
    var e = $.cookie("account_id");
    null != e && "" != e ? $.ajax({type: "POST", url: "http://" + getHost() + "/php/play.php", data: {source: nowlan, handle: "played", id: currentNum, account_id: e}, dataType: "json", success: function (e) {
            console.log(e), "string" == typeof e && (e = JSON.parse(e)), 0 == e.result && echoPlayedView(e), getLikesData()
        }}) : deletePlayedView()
}
function echoPlayedView(e) {
    var i = e.game;
    for (var n in i) {
        var t = n.replace("%0A", ""), a = i[t].user, o = i[t].num, s = "", r = o > 3 ? "...等" : "";
        for (var c in a)
            s += '<img src="' + a[c].avatar + '"/>';
        indexboo && "" == prstr && $("#" + t).find(".count").before('<div class="played-game">' + s + "<span>" + r + "<b>" + o + "</b>位好友也在玩</span></div>"), indexboo && "" != prstr && (t != mainName || echoplayed || (echoplayed = !0, $("#main").find(".top").after('<div class="played-index">' + s + "<span>" + r + "<b>" + o + "</b>位好友也在玩</span></div>")), $("#related-" + t).append('<div class="played-reco">' + s + "<span>" + r + "<b>" + o + "</b>位好友也在玩</span></div>"))
    }
}
function deletePlayedView() {
    $(".quiz-list a").find(".played-game").remove(), $(".quiz-list a").find(".played-reco").remove(), $("#main").find(".played-index").remove(), $("#main").find(".likes").remove(), $(".quiz-item:first-child").find(".count").before('<div class="play-index-login"><a id="play-login-click" href="javascript:;" title="登录查看好友关系" ><img src="main/images/login.png"/></a></div>'), $(".related-item:first-child").append('<div class="play-reco-login"><a id="play-login-click" href="javascript:;" title="登录查看好友关系"><img src="../main/images/login.png"/></a></div>'), $("#play-login-click").click(function () {
        $("#login").click()
    })
}
function getLikesData() {
    var e = $.cookie("account_id");
    if (null != e && "" != e) {
        var i = $("#main").find(".played-index");
        0 == i.length && ($("#main").find(".top").after('<div class="played-index"></div>'), i = $("#main").find(".played-index")), $.ajax({type: "POST", url: "http://" + getHost() + "/php/likes.php", data: {source: nowlan, handle: "search", name: mainName, account_id: e}, dataType: "json", success: function (n) {
                console.log(n), "string" == typeof n && (n = JSON.parse(n)), i.append(0 == n.result ? 1 == n.has ? '<div class="liked-link" title="已经赞过了"></div>' : '<div class="like-link" title="赞一下"></div>' : '<div class="like-link" title="赞一下"></div>'), addLikeListener(mainName, e)
            }})
    }
}
function addLikeListener(e, i) {
    var n = $("#main").find(".liked-link");
    n.click(function () {
        alert("你已经赞过了")
    });
    var t = $("#main").find(".like-link");
    t.click(function () {
        $.ajax({type: "POST", url: "http://" + getHost() + "/php/likes.php", data: {source: nowlan, handle: "add", name: e, id: currentNum, account_id: i}, dataType: "json", success: function (e) {
                if (console.log(e), "string" == typeof e && (e = JSON.parse(e)), 0 == e.result) {
                    t.remove();
                    var i = $("#main").find(".played-index");
                    i.append('<div class="liked-link" title="已经赞过了"></div>'), n = $("#main").find(".liked-link"), n.click(function () {
                        alert("你已经赞过了")
                    })
                } else
                    alert("点赞发生错误，请稍后再试")
            }})
    })
}
function getLikesPlayed() {
    var e = $.cookie("account_id");
    null != e && "" != e && $.ajax({type: "POST", url: "http://" + getHost() + "/php/likes.php", data: {source: nowlan, handle: "glp", account_id: e}, dataType: "json", success: function (e) {
            "string" == typeof e && (e = JSON.parse(e)), 0 == e.result && echoLikesView(e)
        }})
}
function echoLikesView(e) {
    var i = new Array;
    for (var n in e.likes)
        i.push(e.likes[n]);
    i = sortorder(i);
    var t = '<div class="likes"><div class="likes-title"><span>好友动态</span><i></i></div>';
    t += '<div class="likes-data"><ul>';
    for (var a = 0; a < i.length; a++) {
        var o = i[a];
        for (var s in o) {
            var r = o[s].id;
            t += "game" == o[s].type ? '<li><span class="likes-name">' + s + '</span><span> 玩过 </span><a href="../' + recommendJSON[r].main + '/index.html">' + recommendJSON[r].title + "</a></li>" : '<li><span class="likes-name">' + s + '</span><span> 赞过 </span><a href="../' + recommendJSON[r].main + '/index.html">' + recommendJSON[r].title + "</a></li>"
        }
    }
    t += "</ul></div>", t += '<div class="likes-more"><a id="likes-arrow" href="javascript:;" title="更多数据" onclick="showLikesData(0,' + i.length + ');"></a><span id="likes-no-more" style="display: none">......</span></div></div>', $("#main").find(".participation-status").after(t), showLikesData(0, i.length)
}
function showLikesData(e, i) {
    if (i > e + 3) {
        for (var n = e + 3, t = e; n > t; t++)
            $(".likes-data li:eq(" + t + ")").fadeIn(500);
        $("#likes-arrow").attr("onclick", "showLikesData(" + n + "," + i + ")")
    } else {
        for (var t = e; i > t; t++)
            $(".likes-data li:eq(" + t + ")").fadeIn(500);
        $("#likes-arrow").attr("onclick", "showLikesData(" + i + "," + i + ")"), $("#likes-arrow").hide(), $("#likes-no-more").show()
    }
}
var echoplayed = !1;