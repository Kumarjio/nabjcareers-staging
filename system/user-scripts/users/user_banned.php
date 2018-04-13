<?php

$tp = SJB_System::getTemplateProcessor();
$tp->assign("adminEmail", SJB_System::getSettingByName('notification_email'));
$tp->display("user_banned.tpl");
