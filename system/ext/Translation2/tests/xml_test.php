<?php
// $Id: xml_test.php 770 2009-03-13 12:36:35Z nwy $

require_once 'db_test.php';

class TestOfContainerXML extends TestOfContainerDB {
    function TestOfContainerXML($name='Test of Container XML') {
        $this->UnitTestCase($name);
    }
    function setUp() {
        $driver = 'XML';
        $options = array(
            'filename'         => 'i18n.xml',
            'save_on_shutdown' => true,
        );
        $this->tr =& Translation2::factory($driver, $options);
    }
}
?>