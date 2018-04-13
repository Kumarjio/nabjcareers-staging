<?php

require_once("orm/ObjectDetails.php");

class SJB_OpenInvoiceDetails extends SJB_ObjectDetails
{
    public static function getDetails()
    {
        return array
                (
		        array
		        (
			        'id'		=> 'user_sid',
			        'caption'	=> 'User sid',
			        'type'		=> 'int',
			        'is_required'=> true,
			        'is_system'	=> true,
		        ),
		        array
		        (
			        'id'		=> 'payment_sid',
			        'caption'	=> 'Payment sid',
			        'type'		=> 'int',
			        'is_required'=> true,
			        'is_system'	=> true,
		        ),
		        array
                (
                        'id'		=> 'amount',
                        'caption'	=> 'Amount outstanding',
                        'type'		=> 'float',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array
                (
                        'id'		=> 'creation_date',
                        'caption'	=> 'Date',
                        'type'		=> 'date',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array(
	                    'id'        => 'is_opened',
	                    'caption'	=> 'Is opened',
	                    'type'		=> 'boolean',
	                    'length'	=> '1',
		                'is_required'=> true,
		                'is_system'	=> true,
                )
        );
    }
}
