<ion:partial view="header" xmlns:ion="http://www.w3.org/1999/html"/>
<!-------------------------上部开始------------------------------------------>
<div id="main">
<div id="date_soso"><div class="date">今天日期:<ion:today format="Y年m月d日" />&nbsp;&nbsp;&nbsp;<ion:today:week_day format="D" />&nbsp;&nbsp;&nbsp;现在时间:<ion:today format="H:i" /></div>
<div class="soso" style="width:368px;">
    <form style="margin:0px; border:0px; padding:0px; width:368px; height:28px;" method="post" action="<ion:page:url id='search' />">
        <input style="height:24px;" class="soso_text" type="text" name="realm" value="" placeholder="<ion:lang key='module_search_form' />" />
        <input style="float:right; font-family:微软雅黑;" class="soso_submit" type="submit" value="开始搜索" />
    </form>
</div>
<div style="margin-bottom: 2px;" class="clear"></div>
<!-------------------------正文左边部分开始------------------------------------------>
<div id="main-left">
<!-------------------------学校新闻部分开始------------------------------------------>
<div class="news">
    <ion:page id="school-news">
    <p class="title_news"><span><ion:subtitle /></span><a class="news_more" href="<ion:url />">MORE</a></p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <!-------------------------------------新闻幻灯片------------------------------->
                <div class="news_left">
                    <div class="msn-focus">
                        <div class="bd">
                            <ion:articles type="top" tag="ul">
                                <ion:article>
                                    <li style="display: none;">
                                        <a href="<ion:url />">
                                            <ion:medias limit="1">
                                                <img src="<ion:media:src />" alt="<ion:media:alt />"/>
                                            </ion:medias>
                                        </a>
                                        <p><i></i><a href="<ion:url />"><ion:title /></a></p>
                                    </li>
                                </ion:article>
                            </ion:articles>
                            <a class="prev" href="javascript:void(0)"></a><a class="next" href="javascript:void(0)"></a>
                        </div>
                    </div>
                    <script type="text/javascript">jQuery(".msn-focus .bd").hover(function(){ jQuery(this).addClass("bdOn") },function(){ jQuery(this).removeClass("bdOn") });jQuery(".msn-focus").slide({ mainCell:".bd ul",delayTime:500,triggerTime:0,autoPlay:true });</script>
                </div>
                <!-------------------------------------新闻幻灯片结束------------------------------->
            </td>
            <td width="20">&nbsp;</td>
            <td>
                <div class="news_right">
                    <ion:articles limit="9" tag="ul" class="ul_02">
                        <li>
                            <ion:article>
                                <a href="<ion:url />">
                                    <span>[<ion:date format="Y-m-d" />]</span>
                                    <ion:title />
                                </a>
                            </ion:article>
                        </li>
                    </ion:articles>
                </div>
            </td>
        </tr>
    </table>
    </ion:page>
</div>
<!-------------------------学校新闻部分结束------------------------------------------>
<div id="left-banner">
    <ion:articles all="true" limit="1" type="banner-left" tag="div" class="left-banner-left">
        <a href="<ion:article:url />"><ion:article:title /></a>
    </ion:articles>
    <ion:articles all="true" limit="1" type="banner-right" tag="div" class="left-banner-right">
        <a href="<ion:article:url />"><ion:article:title /></a>
    </ion:articles>
</div>
<div class="clear"></div>
<!--------------左边第三行开始-------------------------->
<div class="two_left">
    <div class="two_left_01">
        <ion:page id="cee-achievement-history">
            <p class="title-01"><span><ion:title /></span><a href="<ion:url />">MORE</a></p>
            <div class="clear"></div>
            <ion:articles limit="9" tag="ul" class="ul_05">
                <ion:article>
                    <li><a href="<ion:url />"><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
    <div class="two_left_02">
        <ion:page id="edu-news">
            <p class="title_04"><span><ion:title /></span><a href="<ion:url />">MORE</a></p>
            <div class="clear"></div>
            <ion:articles limit="9" tag="ul" class="ul_06">
                <ion:article>
                    <li><a href="<ion:url />"><span>[<ion:date format="Y-m-d" />]</span><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
</div>

<div class="clear"></div>

<div class="teacher-img">
    <ion:page id="famous-teacher">
    <div class="title_news"><span><ion:subtitle /></span><a class="news_more" href="<ion:url />">MORE</a></div>
    <div class="rollBox">
        <div class="LeftBotton" onMouseDown="ISL_GoUp()" onMouseUp="ISL_StopUp()" onMouseOut="ISL_StopUp()"></div>
        <div class="Cont" id="ISL_Cont">
            <div class="ScrCont">
                <div id="List1">
                    <!-- 图片列表 begin -->
                    <ion:articles limit="7" type="famous">
                        <ion:article>
                            <ion:medias type="picture" limit="1">
                                <div class="pic">
                                    <a href="<ion:article:url />"><img src="<ion:media:src />" alt="<ion:media:alt />" width="146" height="120" /></a>

                                    <p><a href="<ion:article:url />"><ion:article:title /></a></p>
                                </div>
                            </ion:medias>
                        </ion:article>
                    </ion:articles>
                    <!-- 图片列表 end -->
                </div>
                <div id="List2"></div>
            </div>
        </div>
        <div class="RightBotton" onMouseDown="ISL_GoDown()" onMouseUp="ISL_StopDown()" onMouseOut="ISL_StopDown()"></div>
    </div>

    <script language="javascript" type="text/javascript">
        <!--//--><![CDATA[//><!--
        //图片滚动列表 mengjia 070816
        var Speed =2; //速度(毫秒)
        var Space = 5; //每次移动(px)
        var PageWidth = 500; //翻页宽度
        var fill = 0; //整体移位
        var MoveLock = false;
        var MoveTimeObj;
        var Comp = 0;
        var AutoPlayObj = null;
        GetObj("List2").innerHTML = GetObj("List1").innerHTML;
        GetObj('ISL_Cont').scrollLeft = fill;
        GetObj("ISL_Cont").onmouseover = function(){clearInterval(AutoPlayObj);}
        GetObj("ISL_Cont").onmouseout = function(){AutoPlay();}
        AutoPlay();
        function GetObj(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")')}else{return eval('document.all.'+objName)}}
        function AutoPlay(){ //自动滚动
            clearInterval(AutoPlayObj);
            AutoPlayObj = setInterval('ISL_GoDown();ISL_StopDown();',4000); //间隔时间
        }
        function ISL_GoUp(){ //上翻开始
            if(MoveLock) return;
            clearInterval(AutoPlayObj);
            MoveLock = true;
            MoveTimeObj = setInterval('ISL_ScrUp();',Speed);
        }
        function ISL_StopUp(){ //上翻停止
            clearInterval(MoveTimeObj);
            if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0){
                Comp = fill - (GetObj('ISL_Cont').scrollLeft % PageWidth);
                CompScr();
            }else{
                MoveLock = false;
            }
            AutoPlay();
        }
        function ISL_ScrUp(){ //上翻动作
            if(GetObj('ISL_Cont').scrollLeft <= 0){GetObj('ISL_Cont').scrollLeft = GetObj('ISL_Cont').scrollLeft + GetObj('List1').offsetWidth}
            GetObj('ISL_Cont').scrollLeft -= Space ;
        }
        function ISL_GoDown(){ //下翻
            clearInterval(MoveTimeObj);
            if(MoveLock) return;
            clearInterval(AutoPlayObj);
            MoveLock = true;
            ISL_ScrDown();
            MoveTimeObj = setInterval('ISL_ScrDown()',Speed);
        }
        function ISL_StopDown(){ //下翻停止
            clearInterval(MoveTimeObj);
            if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0 ){
                Comp = PageWidth - GetObj('ISL_Cont').scrollLeft % PageWidth + fill;
                CompScr();
            }else{
                MoveLock = false;
            }
            AutoPlay();
        }
        function ISL_ScrDown(){ //下翻动作
            if(GetObj('ISL_Cont').scrollLeft >= GetObj('List1').scrollWidth){GetObj('ISL_Cont').scrollLeft = GetObj('ISL_Cont').scrollLeft - GetObj('List1').scrollWidth;}
            GetObj('ISL_Cont').scrollLeft += Space ;
        }
        function CompScr(){
            var num;
            if(Comp == 0){MoveLock = false;return;}
            if(Comp < 0){ //上翻
                if(Comp < -Space){
                    Comp += Space;
                    num = Space;
                }else{
                    num = -Comp;
                    Comp = 0;
                }
                GetObj('ISL_Cont').scrollLeft -= num;
                setTimeout('CompScr()',Speed);
            }else{ //下翻
                if(Comp > Space){
                    Comp -= Space;
                    num = Space;
                }else{
                    num = Comp;
                    Comp = 0;
                }
                GetObj('ISL_Cont').scrollLeft += num;
                setTimeout('CompScr()',Speed);
            }
        }
        //--><!]]>
    </script>


    </ion:page>
</div>


<!--------------左边第三行开始-------------------------->
<div class="two_left">
    <div class="two_left_01">
        <ion:page id="school-video">
            <p class="title-01"><span><ion:title /></span><a href="<ion:url />">MORE</a></p>
            <div class="clear"></div>
            <ion:articles limit="9" tag="ul" class="ul_05">
                <ion:article>
                    <li><a href="<ion:url />"><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
    <div class="two_left_02">
        <ion:page id="teaching-research">
            <p class="title_04"><span><ion:title /></span><a href="<ion:url />">MORE</a></p>
            <div class="clear"></div>
            <ion:articles limit="9" tag="ul" class="ul_06" recursion="true">
                <ion:article>
                    <li><a href="<ion:url />"><span>[<ion:date format="Y-m-d" />]</span><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
</div>
</div>



<!-------------------------右边部分开始------------------------------------------>
<div id="main-right">
    <div class="notice">
        <ion:page id="announce">
            <div class="title-notice"><span><ion:title /></span><a class="notice_more" href="<ion:url />">MORE</a></div>
            <div class="clear"></div>
            <ion:articles limit="9" tag="ul" class="ul_01">
                <ion:article>
                    <li><a href="<ion:url />"><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
    <div class="master">
        <ion:page id="president-note">
            <div class="title-notice"><span><ion:title /></span><a class="notice_more" href="<ion:url />">MORE</a></div>
            <table width="0" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <div class="master-img"><img src="<ion:theme_url />assets/images/master-01.jpg" width="130" height="158" /></div>
                    </td>
                    <td width="15">&nbsp;</td>
                    <td>
                        <div class="master-text">
                            <ion:articles limit="1">
                                <ion:article:content />
                            </ion:articles>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="master-mail">校长邮箱:<a href='mailto:dean_YNSF@163.com'>deanYNSF@163.com</a></div>
        </ion:page>
    </div>
    <div style="margin-top:12px"><a href="<ion:page:url id='message' />"><img src="<ion:theme_url />assets/images/an-01.gif" width="296" height="66" /></a></div>
    <div style="margin-top:12px"><a href="<ion:page:url id='cjcx' />"><img src="<ion:theme_url />assets/images/an-03.gif" width="296" height="66" /></a></div>
    <div style="margin-top:12px"><a href="<ion:page:url id='school-video' />"><img src="<ion:theme_url />assets/images/an-02.gif" width="296" height="66" /></a></div>
    <div class="main-an">
        <ion:page id="res-center">
            <div class="title-notice"><span><ion:title /></span><a class="notice_more" href="<ion:url />">MORE</a></div>
        </ion:page>
        <ion:pages parent="res-center" display_hidden="true" tag="ul">
            <ion:page>
                <li><a style="background-color: <ion:element:color:items:value:value />;" href="<ion:url />"><ion:title /></a></li>
            </ion:page>
        </ion:pages>
    </div>
</div>
</div>
<!-------------------------上部开始结束------------------------------------------>
<div class="clear"></div>
<!-------------------------横向滚动图片部分开始------------------------------------------>
<div id="hxgd-img">
    <ion:page id="school-img">
    <p class="title-05"><span><ion:title /></span><a style="margin-left:990px" href="<ion:url />">MORE</a></p>
    <div class="clear"></div>
    <div class="rollphotos">
        <div class="blk_29">
            <div class="LeftBotton" id="LeftArr"></div>
            <div class="Cont" id="ISL_Cont_1">
                <ion:articles limit="1">
                    <ion:article>
                        <ion:medias type="picture" limit="5">
                            <div class="box"><a href="<ion:media:src />"><img src="<ion:media:src />" alt="<ion:media:alt />"/></a><a href="<ion:media:src />"><ion:media:title /></a></div>
                        </ion:medias>
                    </ion:article>
                </ion:articles>
            </div>
            <DIV class=RightBotton id=RightArr></div></div>
        <script language=javascript type=text/javascript>
            var scrollPic_02 = new ScrollPic();
            scrollPic_02.scrollContId   = "ISL_Cont_1";
            scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
            scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
            scrollPic_02.frameWidth     = 1130;//显示框宽度
            scrollPic_02.pageWidth      = 228; //翻页宽度
            scrollPic_02.speed          = 10; //移动速度(毫秒,越小越快)
            scrollPic_02.space          = 20; //每次移动像素(单位px,越大越快)
            scrollPic_02.autoPlay       = true; //自动播放
            scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)
            scrollPic_02.initialize(); //初始化

        </script>
    </div>
    </ion:page>
</div>
<div class="clear"></div>
<!--------------------------滚动图片 end------------------------------------->


<div class="links">
    <div class="links-left"><img src="<ion:theme_url />assets/images/link-left.gif" width="43" height="100" /></div>
    <div class="links-right">
        <ion:page id="links">
            <ion:articles tag="ul">
                <ion:article>
                    <li><a href="<ion:url />"><ion:title /></a></li>
                </ion:article>
            </ion:articles>
        </ion:page>
    </div>
</div>
<ion:partial view="footer" />

