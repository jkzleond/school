<ion:partial view="header" />
<!-------------------------正文左边部分开始------------------------------------------>
<div id="sub-main">
    <ion:partial view="page_header" />
    <!-------------------------列表页左边部分开始------------------------------------------>
    <div id="sub-left">
        <ion:articles limit="1">
            <ion:article>
                <div class="sub_news">
                    <h1><ion:subtitle /></h1>
                    <div class="news_view">
                        <ion:content />
                    </div>
                </div>
                <div class="clear"></div>
                <!-----------------------------分享部分开始----------------------------------------->
            </ion:article>
        </ion:articles>
    </div>
<!-------------------------列表页右边部分开始------------------------------------------>
    <ion:partial view="page_right" />
</div>
<ion:partial view="footer" />