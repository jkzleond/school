<ion:partial view="header" />
<!-------------------------正文左边部分开始------------------------------------------>
<div id="sub-main">
    <ion:partial view="page_header" />
        <!-------------------------列表页左边部分开始------------------------------------------>
    <div id="sub-left">
        <div class="sub_list">
            <ion:articles tag="ul" recursion="true" pagination="22">
                <li><a href="<ion:article:url />"><span>[<ion:article:date format="Y-m-d" />]</span><ion:article:title /></a></li>
            </ion:articles>
        </div>
        <ion:articles:count expression=".gt(22)" recursion="true">
        <div class="page">
            <span>22条/页&nbsp;共<ion:page:articles:count recursion="true"/>条&nbsp;</span>
            <ion:articles:pagination recursion="true" pagination="22" />
            <span><input id="page_input" type='input' name='page'/>&nbsp;<input type='button' value='跳转' id="page_btn"/></span>
        </div>
        </ion:articles:count>
    </div>
    <!-------------------------列表页右边部分开始------------------------------------------>
    <ion:partial view="page_right" />
</div>
<script type="text/javascript">
    //page location
    (function(doc, win){
        var page_btn = doc.getElementById('page_btn');
         page_btn && page_btn.addEventListener('click', function(){
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
            page = (page-1)*22;
            win.location.href = path + '/page/' + page;
        });
    })(document, window);
</script>
<ion:partial view="footer" />
