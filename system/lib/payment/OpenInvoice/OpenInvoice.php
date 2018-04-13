<?php

require_once('orm/Object.php');
require_once ('OpenInvoiceDetails.php');

class SJB_OpenInvoice extends SJB_Object
{
	function SJB_OpenInvoice($open_invoice_info = array())
	{
		$this->db_table_name = 'open_invoices';
		$this->details = new SJB_OpenInvoiceDetails($open_invoice_info);
	}
}

