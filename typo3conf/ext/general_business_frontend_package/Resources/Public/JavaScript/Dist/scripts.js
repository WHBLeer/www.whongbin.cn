/*!
 * general business frontend package v1.0.0 (https://www.whongbin.com)
 * Copyright 2017-2019 三里林
 * Licensed under the GPL-2.0-or-later license
 */
console.log('%c 活着感到快乐，世界就属于你。 %c The world is his who enjoys it.', 'color: #fadfa3; background: #030307; padding:5px', 'background: #fadfa3; padding:5px');


function gotoTop(minHeight) {
    $("#gotoTop").click(function() {
        $("html,body").animate({
            scrollTop: "0px"
        },
        "slow")
    });
    minHeight ? minHeight = minHeight: minHeight = 600;
    $(window).scroll(function() {
        var s = $(window).scrollTop();
        if (s > minHeight) {
            $("#gotoTop").fadeIn(500)
        } else {
            $("#gotoTop").fadeOut(500)
        }
    })
}
gotoTop();
function addFavorite() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！")
    } else {
        if (ua.indexOf("msie 8") > -1) {
            window.external.AddToFavoritesBar(url, title)
        } else {
            if (document.all) {
                try {
                    window.external.addFavorite(url, title)
                } catch(e) {
                    alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!")
                }
            } else {
                if (window.sidebar) {
                    window.sidebar.addPanel(title, url, "")
                } else {
                    alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!")
                }
            }
        }
    }
};
(function() {
    var bp = document.createElement("script");
    var curProtocol = window.location.protocol.split(":")[0];
    if (curProtocol === "https") {
        bp.src = "https://zz.bdstatic.com/linksubmit/push.js"
    } else {
        bp.src = "http://push.zhanzhang.baidu.com/push.js"
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s)
})();