<?php

require_once("classifieds/SearchEngine/Searcher.php");
require_once("payment/Payment/PaymentInfoSearcher.php");

require_once("payment/Payment/PaymentManager.php");

class SJB_PaymentSearcher extends SJB_Searcher
{
	var $infoSearcher = null;
	function SJB_PaymentSearcher($limit = false, $sorting_field = false, $sorting_order = false, $inner_join = false)
	{
		$this->infoSearcher = new SJB_PaymentInfoSearcher($limit, $sorting_field, $sorting_order, $inner_join);
		parent::SJB_Searcher($this->infoSearcher, new SJB_PaymentManager);
	}
	
	function getAffectedRows() {
		return $this->infoSearcher->affectedRows;
	}
	
	function getTotalPrice() {
		return $this->infoSearcher->totalPrice;
	}
}
