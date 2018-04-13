<?php
// $Id: simple_include.php 770 2009-03-13 12:36:35Z nwy $
if (!defined('SIMPLE_TEST')) {
    define('SIMPLE_TEST', 'simpletest/');
}

require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');
require_once(SIMPLE_TEST . 'mock_objects.php');
?>
