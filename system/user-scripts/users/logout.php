<?php

require_once("users/Authorization.php");
SJB_Authorization::logout();
SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"));

