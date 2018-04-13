<?php
// $Id: admin_gettext_po_test.php 770 2009-03-13 12:36:35Z nwy $

require_once 'admin_gettext_test_base.php';

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = &new TestOfAdminContainerGettextPO();
    $test->run(new HtmlReporter());
}
?>