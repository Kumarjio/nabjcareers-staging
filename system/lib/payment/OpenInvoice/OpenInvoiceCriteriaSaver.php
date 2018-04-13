<?php

require_once("classifieds/SearchEngine/CriteriaSaver.php");
require_once("payment/OpenInvoice/OpenInvoiceManager.php");

class SJB_OpenInvoiceCriteriaSaver extends SJB_CriteriaSaver
{
	function SJB_OpenInvoiceCriteriaSaver()
	{
		parent::SJB_CriteriaSaver('OpenInvoiceSearcher', new SJB_OpenInvoiceManager);
	}
}
