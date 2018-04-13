<?php

require_once("classifieds/SearchEngine/CriteriaSaver.php");
require_once("payment/Payment/PaymentManager.php");

class SJB_PaymentCriteriaSaver extends SJB_CriteriaSaver
{
	function SJB_PaymentCriteriaSaver()
	{
		parent::SJB_CriteriaSaver('PaymentSearcher', new SJB_PaymentManager);
	}
}
