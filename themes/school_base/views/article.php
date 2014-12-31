<ion:partial view="header" />
<!-------------------------正文左边部分开始------------------------------------------>
<div id="sub-main">
    <ion:partial view="page_header" />
    <!-------------------------列表页左边部分开始------------------------------------------>
    <div id="sub-left">
        <ion:article>
        <div class="sub_news">
                <h1><ion:title /></h1>
                <div class="view_info"><span>文章作者：<ion:writer:name /></span><span>信息来源：XXXXXXX</span><span>添加日期：<ion:date format="Y-m-d" /></span><span>浏览次数：<ion:view />次</span></div>


            <div class="news_view">
                <ion:content />
            </div>
            <div class="news_close">
                <p><a href="#" target="_blank">保存页面</a><a href="javascrīpt:window.print()" target="_self">打印页面</a><a href="#" target="_blank" onclick="windows.opener=null;windows.close();">关闭页面</a></p>
            </div>
            <div class="clear"></div>
            <!-----------------------------分享部分开始----------------------------------------->
            <div class="bshare-custom"><A id=bshare-shareto class=bshare-more title=分享到 href="http://www.bShare.cn/">分享到</A><A class=bshare-qzone title=分享到QQ空间>QQ空间</A><A class=bshare-sinaminiblog title=分享到新浪微博>新浪微博</A><A class=bshare-renren title=分享到人人网>人人网</A><A class=bshare-qqmb title=分享到腾讯微博>腾讯微博</A><A class=bshare-douban title=分享到豆瓣>豆瓣</A><A class="bshare-more bshare-more-icon more-style-addthis" title=更多平台></A><SPAN class="BSHARE_COUNT bshare-share-count">0</SPAN></div>
            <SCRIPT type=text/javascript charset=utf-8 src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></SCRIPT>
            <SCRIPT type=text/javascript charset=utf-8 src="http://static.bshare.cn/b/bshareC0.js"></SCRIPT>
        </div>
        <!-----------------------------分享部分结束----------------------------------------->
        <div id="view_bottom">
            <div class="left_up">
                <ion:prev>
                    <p><span>上一篇</span><a href="<ion:url />"><ion:title /></a></p>
                </ion:prev>
                <ion:next>
                    <p><span>下一篇</span><a href="<ion:url />"><ion:title /></a></p>
                </ion:next>
            </div>
            <div class="right_about">
                <p><span>相关信息</span></p>
                <ion:assoc limit="5" tag="ul">
                    <li><a href="<ion:article:url />"><ion:article:title /></a></li>
                </ion:assoc>
            </div>
        </div>
        </ion:article>
    </div>
    <!-------------------------列表页右边部分开始------------------------------------------>
    <ion:partial view="page_right" />
</div>
<script type="text/javascript">
    //page location
    (function(doc, win){
        var page_btn = doc.getElementById('page_btn');
        page_btn.addEventListener('click', function(){
            var page_input = doc.getElementById('page_input');
            var page = page_input.value;
            page = page.replace(/\D*/, '');
            page = page || '1';
            var path = win.location.pathname;
            var index = path.lastIndexOf('/page/');
            if(index !== -1){
                path = path.slice(0, index);
            }
            path = path.replace(/(.*)\/$/, '$1');
            win.location.href = path + '/page/' + page;
        });
    })(document, window);
</script>
<ion:partial view="footer" />