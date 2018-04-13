<?php


require_once "payment/PaymentGateway/PaymentGateway.php";

require_once "CashPaymentDetails.php";

class SJB_CashPayment extends SJB_PaymentGateway
{
    function SJB_CashPayment($gateway_info = null)
	{
		parent::SJB_PaymentGateway($gateway_info);

		$this->details = new SJB_CashPaymentDetails($gateway_info);
	}

    function getUrl()
    {
		return SJB_System::getSystemSettings('SITE_URL').'/cash-payment-page/';
	}

    function buildTransactionForm($payment)
    {
		if ($payment->isValid())
		{
			$cash_payment_url = $this->getUrl();

			$form_fields = $this->getFormFields($payment);

			$properties = $this->details->getProperties();

			$gateway_caption = $properties['caption']->getValue();

            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value)
            {
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $cash_payment_url;
           	$gateway['caption']			= $gateway_caption;

			return $gateway;
		}
		else
			return null;
	}

	function getFormFields($payment)
	{
		$properties = $this->details->getProperties();

        $product_info = $payment->getProductInfo();

		$id = $properties['id']->getValue();

		$form_fields = array
			(
				'payment_id'	=> $payment->getSID(),
				'item_name' 	=> $product_info['name'],
				'amount' 		=> $product_info['price'],
				'template' 		=> strtolower($id),
			);

		return $form_fields;
	}
    
    function getTemplate() {return strtolower($this->getPropertyValue('id')) . ".tpl";}
}

