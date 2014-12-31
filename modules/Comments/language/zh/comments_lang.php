<?php

/**
 * Admin Panel Translations
 */

//=> Panel Translations
$lang['module_comments_title']                  = '评论模块';
$lang['module_comments_about']                  = '管理你的评论';

$lang['module_comments_error_writing_config_file'] 	= 'modules/Comments/config/config.php 不可写 !';

//=> Permission Translations
$lang['module_comments_permission_warning']         = 'WARNING !';
$lang['module_comments_permission_access']          = '你没有权限使用该模块';
$lang['module_comments_permission_create']          = '对不起,你没有权限发表评论...';
$lang['module_comments_permission_edit']            = '对不起,你没有权限编辑评论...';
$lang['module_comments_permission_delete']          = '对不起,你没有权限删除评论...';
$lang['module_comments_permission_view']            = '对不起,你没有权限查看评论...';
$lang['module_comments_permission_save']            = '对不起,你没有权限保存评论...';
$lang['module_comments_permission_status']          = '对不起,你没有权限改变评论的状态...';
$lang['module_comments_comments_not_allowed']       = '<strong>Warning!</strong>对不起,该文章不可以评论...';
$lang['module_comments_comments_expired']           = '<strong>Warning!</strong>对不起,该文章的评论已被关闭...';

//=> Title Translations
$lang['module_comments_title_comments_form']        = '评论';
$lang['module_comments_title_settings']         = '设置';
$lang['module_comments_title_root']             = '根';
$lang['module_comments_title_comments_for_selected_article']    = '评论文章 - %s';
$lang['module_comments_title_total_comments']       = '一共 %s 篇评论';
$lang['module_comments_title_comments']             = '评论 : %s';
$lang['module_comments_title_manage_comments']      = '管理评论';
$lang['module_comments_title_comment_management']   = '评论管理';
$lang['module_comments_title_website']              = '网站';
$lang['module_comments_title_comment']              = '评论';
$lang['module_comments_title_ip']                   = 'IP地址';
$lang['module_comments_title_pending_comments']     = '待处理评论';
$lang['module_comments_title_published_comments']   = '已发布的评论';
$lang['module_comments_title_window_edit_comment']  = '编辑评论';
$lang['module_comments_title_window_new_comment']   = '写新评论';
$lang['module_comments_title_window_preview_comment']   = '预览评论';


//=> About Translations
$lang['module_comments_about_setting']          = '你可以在这个地方管理评论';

//=> Tuş Çevirileri
$lang['module_comments_button_root']            = '根';
$lang['module_comments_button_settings']        = '设置';
$lang['module_comments_button_back_to_article'] = '返回到文章';
$lang['module_comments_button_new_comments']    = '写新评论';
$lang['module_comments_button_save_date']       = '保存日期';

//=> Help Translations
$lang['module_comments_help_if_checked_comments_will_allowed'] = '勾选它,这篇文章就能被评论了^_^';
$lang['module_comments_help_if_checked_comments_will_auto_valide']  = '勾选它,就能自动验证评论者';
$lang['module_comments_help_comment_expire']                        = '如果你设置乐它,过了这个时间就不能评论,so cool!';
$lang['module_comments_help_click_here_for_manage_comments']    = '点击这里管理评论';
$lang['module_comments_help_click_here_for_go_back_to_article'] = '点击这里回到文章';

//=> Notification Translations
$lang['module_comments_notification_cant_get_article_id']       = '不能获取文章ID';
$lang['module_comments_notification_comment_status_changed']    = '评论状态改变成功...';
$lang['module_comments_notification_comment_status_nchanged']   = '评论状态不能被改变!';
$lang['module_comments_notification_comment_deleted']           = '评论删除成功...';
$lang['module_comments_notification_comment_ndeleted']          = '评论不能被删除!';
$lang['module_comments_notification_delete_question']           = '真的要删除所选择的评论吗?';
$lang['module_comments_notification_comment_saved']             = '评论保存成功...';
$lang['module_comments_notification_comment_nsaved']            = '评论不能保存!';

//=> Label Translations
$lang['module_comments_label_id_article_comment']   = '评论ID';
$lang['module_comments_label_id_article']           = '文章ID';
$lang['module_comments_label_author']               = '作者';
$lang['module_comments_label_email']                = '电邮';
$lang['module_comments_label_site']                 = '网站';
$lang['module_comments_label_content']              = '内容';
$lang['module_comments_label_ip']                   = 'IP';
$lang['module_comments_label_status']               = '状态';
$lang['module_comments_label_created']              = '创建于';
$lang['module_comments_label_updated']              = '更新于';
$lang['module_comments_label_admin']                = '管理员';
$lang['module_comments_label_allow_comments']   = '允许评论';
$lang['module_comments_label_auto_validate_comments']   = '自动验证';
$lang['module_comments_label_comment_expire']           = '过期日期';
$lang['module_comments_label_published']            = '发表于';
$lang['module_comments_label_pending']              = '待回复';
$lang['module_comments_label_total']                = '总数';
$lang['module_comments_label_total_comments']   = '共 <span class="badge">%s</span> 篇评论.';
$lang['module_comments_label_no_date_provided'] = '无日期提供.';
$lang['module_comments_label_time_ago']         = '前';
$lang['module_comments_label_from_now']         = '自现在';
$lang['module_comments_label_time_ago_plural']  = 's';
$lang['module_comments_label_just_now']         = '现在';
$lang['module_comments_label_second']           = '秒';
$lang['module_comments_label_minute']           = '分';
$lang['module_comments_label_hour']             = '小时';
$lang['module_comments_label_day']              = '天';
$lang['module_comments_label_week']             = '周';
$lang['module_comments_label_month']            = '月';
$lang['module_comments_label_year']             = '年';

//=> Form Translations
$lang['module_comments_mail_admin_subject']                 = '有人在你的网站上发表的评论';
$lang['module_comments_mail_user_subject']                  = '感谢你的评论.';
$lang['module_comments_form_thanks']                        = '谢谢, %s';
$lang['module_comments_form_error_title']                   = '有错误 !';
$lang['module_comments_form_error_message']                 = '请填写必填字段.';
$lang['module_comments_form_success_title']                 = '你的评论已成功发出 !';
$lang['module_comments_form_success_message']               = '感谢你的评论,审核过后将可见 !';
//=> Form => Yönetici e-posta çevirileri
$lang['module_comments_form_admin_administrator']           = '<b>网站管理员</b>';
$lang['module_comments_form_admin_mail_subject']            = '有一条新评论';
$lang['module_comments_form_admin_subject']                 = '%s , 你有一条评论!';
$lang['module_comments_form_admin_dear_site_administrator'] = '管理员大大';
$lang['module_comments_form_admin_have_new_message']        = '你的网站有人发表评论了!';
$lang['module_comments_form_admin_message']                 = '名字是<b>%s</b>的作者在你的网站发表了评论,它的邮箱是<b>%s</b>, <b>%s</b>来自于你的网站.';
//=> Form => Kullanıcı e-posta çevirileri
$lang['module_comments_form_user_subject']                  = '感谢你在我们的网站上留下评论.';
$lang['module_comments_form_user_dear']                     = '%s';
$lang['module_comments_form_user_message']                  = '我们收到你的评论,审核以后,我们就发布它.';
$lang['module_comments_settings_title']			= '设置';
$lang['module_comments_settings_text']			= '设置会保存到 <var>/modules/Comments/config/config.php</var>文件里';
$lang['module_comments_setting_true_false']     = 'True/False 选项';
$lang['module_comments_setting_string'] 		= '字符串选项';
$lang['module_comments_database_title'] 		= '数据库设置';
$lang['module_comments_button_add'] 			= '添加评论';
$lang['module_comments_author'] 				= '作者';
$lang['module_comments_email'] 					= '电邮';
$lang['module_comments_content'] 				= '内容';
$lang['module_comments_label_Online'] 			= '在线';
$lang['module_comments_label_Offline'] 			= '待处理';
$lang['module_comments_title_edit_comment']     = '编辑';
$lang['module_comments_fr_title_comments'] 		= '评论';
$lang['module_comments_article'] 				= '文章ID';
$lang['module_comments_site'] 					= '网站';
$lang['module_comments_author'] 				= '作者';
$lang['module_comments_updated'] 				= '更新于';
$lang['module_comments_created'] 				= '创建于';
$lang['module_comments_ip'] 					= 'IP';
$lang['module_comments_label_no_mod_admin']     = '不来自管理后台';
$lang['module_comments_label_mod_admin'] 		= '来自于管理后台';
$lang['module_comments_label_comment'] 			= '评论';
$lang['module_comments_label_submit_comment']   = '发表你的评论';

//admin panel
$lang['module_comments_options_title'] 			= '评论';
$lang['module_comments_no_comment'] 			= '无评论';
$lang['module_comments_comment_allowed']		= '允许评论';
$lang['module_comments_comment_allowed_help']	= '勾选它,就能评论';
$lang['module_comments_options_subtitle'] 		= '文章的评论';

//frontoffice
$lang['module_comments_count_0'] 				= '留下你的评论';
$lang['module_comments_count_1'] 				= '1 条评论';
$lang['module_comments_count_x'] 				= '%s 条评论';
$lang['module_comments_count_no'] 				= '不可评论';