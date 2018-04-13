<?php

require_once("orm/ObjectDetails.php");

class SJB_PaymentDetails extends SJB_ObjectDetails
{
    public static function getDetails()
    {
        return array
                (
                array
                (
                        'id'		=> 'user_sid',
                        'caption'	=> 'User SID',
                        'type'		=> 'string',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array
                (
                        'id'		=> 'name',
                        'caption'	=> 'Name',
                        'type'		=> 'text',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array
                (
                        'id'		=> 'product_info',
                        'caption'	=> 'Product Info',
                        'type'		=> 'text',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                        'filter'	=> false,
                ),
                array
                (
                        'id'		=> 'price',
                        'caption'	=> 'Price',
                        'type'		=> 'string',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
		        array
		        (
			        'id'		=> 'credit',
			        'caption'	=> 'Credit',
			        'type'		=> 'string',
			        'length'	=> '20',
			        'table_name'=> 'payments',
			        'is_required'=> true,
			        'is_system'	=> true,
		        ),
                array
                (
                        'id'		=> 'creation_date',
                        'caption'	=> 'Date',
                        'type'		=> 'date',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array
                (
                        'id'		=> 'success_page_url',
                        'caption'	=> 'success_page_url',
                        'type'		=> 'text',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),

                array
                (
                        'id'		=> 'status',
                        'caption'	=> 'status',
                        'type'		=> 'list',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                        'list_values' => array(
                                array(
                                        'id' 		=> 'Pending',
                                        'caption' 	=> 'Pending',
                                ),
                                array(
                                        'id' 		=> 'Failed',
                                        'caption' 	=> 'Failed',
                                ),
                                array(
                                        'id'		=> 'Completed',
                                        'caption' 	=> 'Completed',
                                ),
                        		
                        		/* 21-05-2017 filter for unpaid invoices in admin*/
		                        		array(
		                        				'id'		=> 'Unpaid',
		                        				'caption' 	=> 'Unpaid',
		                        		),
	                        		array(
	                        				'id'		=> 'Paid',
	                        				'caption' 	=> 'Paid',
	                        		),
                        		/* END 21-05-2017 filter for unpaid invoices in admin*/
                        		
                        ),
                ),
                array
                (
                        'id'		=> 'callback_data',
                        'caption'	=> 'callback_data',
                        'type'		=> 'text',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array
                (
                        'id'		=> 'verification_response',
                        'caption'	=> 'verification_response',
                        'type'		=> 'text',
                        'length'	=> '20',
                        'table_name'=> 'payments',
                        'is_required'=> true,
                        'is_system'	=> true,
                ),
                array(
                    'id'        => 'subuser_sid',
                    'caption'	=> 'Subuser sid',
                    'type'	=> 'integer',
                    'is_system' => true,
                ),
                array(
                    'id'        => 'is_recurring',
                    'caption'	=> 'Is Recurring',
                    'type'		=> 'boolean',
                    'is_system' => true,
                )
        );
    }

    public function addSubuserProperty( $sid = 0 )
    {
        $this->addProperty(
                array(
                'id'		=> 'subuser_sid',
                'type'		=> 'integer',
                'is_system' => true,
                'caption'	=> 'Subuser sid',
                'value'		=> $sid,
                )
        );
    }
}
