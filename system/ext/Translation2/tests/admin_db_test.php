<?php
// $Id: admin_db_test.php 770 2009-03-13 12:36:35Z nwy $

require_once 'admin_db_test_base.php';

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = &new TestOfAdminContainerDB();
    $test->run(new HtmlReporter());
}
?>
