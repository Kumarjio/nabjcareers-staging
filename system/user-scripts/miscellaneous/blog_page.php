<?php

$tp = SJB_System::getTemplateProcessor();
$content = '';
SJB_Event::dispatch('DisplayBlogContent', $content, true);
$tp->assign('content', $content);
$tp->display('blog_page.tpl');