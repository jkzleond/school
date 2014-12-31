<ion:partial view="header" />
<!-------------------------正文左边部分开始------------------------------------------>
<div id="sub-main">
    <ion:partial view="page_header" />
        <!-------------------------列表页左边部分开始------------------------------------------>
    <div id="sub-left">
        <ion:articles limit="1">
            <h1 style="font-size:30px;font-weight: bold;color:#333">我要留言</h1>
            <hr/>
            <div class="comments-form">

                <ion:form:comment:validation:success is="true">
                    <div class="alert alert-success">
                        <ion:lang key="module_comments_form_success_title" tag="h4" />
                        <ion:lang key="module_comments_form_success_message" tag="p" />
                    </div>
                </ion:form:comment:validation:success>

                <ion:form:comment:validation:error is="true" >
                    <div class="alert alert-danger">
                        <ion:lang key="module_comments_form_error_title" tag="h4" />
                        <ion:lang key="module_comments_form_error_message" tag="p" />
                        <p>
                            <ion:form:comment:validation:error delimeter="p" />
                        </p>
                    </div>
                </ion:form:comment:validation:error>

                <form class="form-horizontal" id="comment-reply" role="form" action="#comment-reply" method="post">

                    <input type="hidden" name="form" value="comment" />
                    <input type="hidden" name="id_article" value="<ion:article:get key='id_article' />" />

                    <fieldset>


                        <ion:user>
                            <ion:logged is="true">
                                <!-- Input::Hidden : Author -->
                                <input type="hidden" name="author" value="<ion:user:firstname /> <ion:user:lastname />" />
                                <!-- Input::Hidden : Email -->
                                <input type="hidden" name="email" value="<ion:user:email />" />

                                <!-- Input : Author -->
                                <div class="form-group">
                                    <label for="author" class="col-lg-3 control-label"><ion:lang key="module_comments_label_author" /></label>
                                    <div class="col-lg-8 pt7">
                                        <ion:user:firstname /><ion:user:lastname />
                                    </div>
                                </div>

                                <!-- Input : Email -->
                                <div class="form-group">
                                    <label for="email" class="col-lg-3 control-label"><ion:lang key="module_comments_label_email" /></label>
                                    <div class="col-lg-8 pt7">
                                        <ion:user:email />
                                    </div>
                                </div>
                            </ion:logged>
                            <ion:logged is="false">
                                <!-- Input : Author -->
                                <div class="form-group<ion:form:comment:error:author is='true'> has-error</ion:form:comment:error:author>">
                                    <label for="author" class="col-lg-3 control-label"><ion:lang key="module_comments_label_author" /></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="author" name="author" placeholder="<ion:lang key="module_comments_label_author" />" value="<ion:form:comment:field:author />" />
                                        <ion:form:comment:error:author tag="span" class="help-block" />
                                    </div>
                                </div>

                                <!-- Input : Email -->
                                <div class="form-group<ion:form:comment:error:email is='true'> has-error</ion:form:comment:error:email>">
                                    <label for="email" class="col-lg-3 control-label"><ion:lang key="module_comments_label_email" /></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="<ion:lang key="module_comments_label_email" />" value="<ion:form:comment:field:email />" />
                                        <ion:form:comment:error:email tag="span" class="help-block" />
                                    </div>
                                </div>
                            </ion:logged>
                        </ion:user>

                        <!-- Input : Site -->
                        <div class="form-group<ion:form:comment:error:site is='true'> has-error</ion:form:comment:error:site>">
                            <label for="site" class="col-lg-3 control-label"><ion:lang key="module_comments_label_site" /></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="site" name="site" placeholder="<ion:lang key="module_comments_label_site" />" value="<ion:form:comment:field:site />" />
                                <ion:form:comment:error:site tag="span" class="help-block" />
                            </div>
                        </div>

                        <!-- Input : Content -->
                        <div class="form-group<ion:form:comment:error:content is='true'> has-error</ion:form:comment:error:content>">
                            <label for="content" class="col-lg-3 control-label"><ion:lang key="module_comments_label_content" /></label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="content" name="content" rows="7" placeholder="<ion:lang key="module_comments_label_content" />"><ion:form:comment:field:content /></textarea>
                                <ion:form:comment:error:content tag="span" class="help-block" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <label for="submit" class="col-lg-3 control-label"></label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-default">发表</button>
                            </div>
                        </div>

                    </fieldset>

                </form>

            </div>

            <ion:comments>
                <div class="comments">

                    <div clas="comments-header">
                        <ion:can role="manage">
                            <label class="label label-success"><ion:lang key="module_comments_label_published" /></label> <span class="label label-success"><ion:count /></span>
                            <label class="label label-danger"><ion:lang key="module_comments_label_pending" /></label> <span class="label label-danger"><ion:count field="pending" /></span>
                            <label class="label label-info"><ion:lang key="module_comments_label_total" /></label> <span class="label label-info"><ion:count field="all" /></span>
                        </ion:can>
                        <ion:can role="manage" is="false">
                            <h2>留言(<ion:count />)</h2>
                        </ion:can>
                    </div>

                    <ion:list order_by="created DESC">
                        <div class="comment">
                            <div class="inner">
                                <div class="<ion:status expression='status==0'>alert alert-danger</ion:status>">
                                    <div class="comment-header">
                                        <span class="title"><ion:author />说: </span>
                                        <ion:admin expression="==1"><span><i class="glyphicon glyphicon-star"></i> <ion:lang key="module_comments_label_admin" /></span></ion:admin>

                                    </div>
                                    <div class="comment-content">
                                        <ion:content />
                                    </div>
                                    <div class="comment-footer">
                                        <span class="comment-date"><ion:created format="Y年m月d日 H:i:s" /></span>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </ion:list>
                </div>
            </ion:comments>

        </ion:articles>
    </div>
    <!-------------------------列表页右边部分开始------------------------------------------>
    <ion:partial view="page_right" />
</div>
<!--<script type="text/javascript">
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
            page = (page-1)*22;
            win.location.href = path + '/page/' + page;
        });
    })(document, window);
</script>-->
<ion:partial view="footer" />
