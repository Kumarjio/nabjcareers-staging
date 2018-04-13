<?php

require_once("classifieds/SearchEngine/Searcher.php");
require_once("payment/OpenInvoice/OpenInvoiceInfoSearcher.php");

require_once("payment/OpenInvoice/OpenInvoiceManager.php");

class SJB_OpenInvoiceSearcher extends SJB_Searcher
{
	var $infoSearcher = null;
	function SJB_OpenInvoiceSearcher($limit = false, $sorting_field = false, $sorting_order = false, $inner_join = false)
	{
		$this->infoSearcher = new SJB_OpenInvoiceInfoSearcher($limit, $sorting_field, $sorting_order, $inner_join);
		parent::SJB_Searcher($this->infoSearcher, new SJB_OpenInvoiceManager);
	}
	
	function getAffectedRows() {
		return $this->infoSearcher->affectedRows;
	}

	function getTotalPrice() {
		return $this->infoSearcher->totalPrice;
	}
}
