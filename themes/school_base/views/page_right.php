<div id="sub-right">

    <div class="sub_rightnav">
        <ion:page id="school-intro">
            <h1 class="title-sub-right"><span><ion:title /></span></h1>
            <dl class="sub_2menu">
                <ion:pages parent="school-intro" display_hidden="true">
                    <ion:page>
                        <dt>
                            <a href="<ion:url />"><ion:title /></a>
                            <ion:articles limit="3">
                                <dd><a href="<ion:article:url />"><ion:article:title /></a></dd>
                            </ion:articles>
                        </dt>
                    </ion:page>
                </ion:pages>
            </dl>
        </ion:page>
    </div>
    <!-----------------------------列表页右边热点信息部分开始----------------------------------------->
    <div style="margin-top:12px"><a href="#"><img src="<ion:theme_url />assets/images/an-01.gif" width="296" height="66" /></a></div>
    <div style="margin-top:12px"><a href="#"><a href="#"><img src="<ion:theme_url />assets/images/an-03.gif" width="296" height="66" /></a></a></div>

    <div class="sub_hot">
        <h1 class="title-sub-right"><span>热点信息</span></h1>
        <ion:articles all="true" type="hot" tag="ul" limit="9" class="ul_01">
            <li><a href="<ion:article:url />"><ion:article:title /></a></li>
        </ion:articles>
    </div>

</div>