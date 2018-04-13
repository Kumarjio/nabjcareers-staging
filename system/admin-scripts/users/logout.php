<?php
session_unset();

SJB_Admin::admin_log_out();

SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"));

