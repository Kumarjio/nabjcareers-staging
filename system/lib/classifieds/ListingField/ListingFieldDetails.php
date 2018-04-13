<?php

require_once("orm/ObjectDetails.php");
require_once("orm/ObjectProperty.php");
require_once("orm/types/TypesManager.php");

class SJB_ListingFieldDetails extends SJB_ObjectDetails
{

    function SJB_ListingFieldDetails( $listing_field_info, $pages_list = array() )
    {
        $details_info = SJB_ListingFieldDetails::getDetails( $listing_field_info, $pages_list );
        
    	foreach ($details_info as $index => $property_info) {
			$sort_array[$index] = isset($property_info['order'])?$property_info['order']:1000;
		}
    	$sort_array = SJB_HelperFunctions::array_sort($sort_array);

        foreach ($sort_array as $index => $value) {
			$sorted_details_info[$index] = $details_info[$index];
		}
		
        foreach ( $sorted_details_info as $detail_info )
        {
            if ( isset( $listing_field_info[$detail_info['id']] ) )
                $detail_info['value'] = $listing_field_info[$detail_info['id']];
            else
                $detail_info['value'] = isset( $detail_info['value'] ) ? $detail_info['value'] : '';

            $this->properties[$detail_info['id']] = new SJB_ObjectProperty( $detail_info );
        }
    }

    public static function getDetails( $listing_field_info, $pages_list = array() )
    {

        $common_details_info = array(
            array(
                'id' => 'id',
                'caption' => 'ID',
                'type' => 'unique_string',
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => true,
                'is_system' => true,
            	'order' => 1,
            ),
            array(
                'id' => 'caption',
                'caption' => 'Caption',
                'type' => 'string',
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => true,
                'is_system' => false,
            	'order' => 2,
            ),
            array(
                'id' => 'type',
                'caption' => 'Type',
                'type' => 'list',
                'list_values' => array(
                    array(
                        'id' => 'list',
                        'caption' => 'List',
                    ),
                    array(
                        'id' => 'multilist',
                        'caption' => 'MultiList',
                    ),
                    array(
                        'id' => 'string',
                        'caption' => 'String',
                    ),
                    array(
                        'id' => 'text',
                        'caption' => 'Text',
                    ),
                    array(
                        'id' => 'integer',
                        'caption' => 'Integer',
                    ),
                    array(
                        'id' => 'float',
                        'caption' => 'Float',
                    ),
                    array(
                        'id' => 'boolean',
                        'caption' => 'Boolean',
                    ),
                    array(
                        'id' => 'date',
                        'caption' => 'Date',
                    ),
                    array(
                        'id' => 'geo',
                        'caption' => 'Geographical',
                    ),
                    array(
                        'id' => 'file',
                        'caption' => 'File',
                    ),
                    array(
                        'id' => 'video',
                        'caption' => 'Video',
                    ),
                    array(
                        'id' => 'tree',
                        'caption' => 'Tree',
                    ),
                    array(
                        'id' => 'youtube',
                        'caption' => 'YouTube',
                    ),
                    array(
                        'id' => 'monetary',
                        'caption' => 'Monetary',
                    ),
                    array(
                        'id' => 'complex',
                        'caption' => 'Complex',
                    ),
                ),
                'length' => '',
                'is_required' => true,
                'is_system' => false,
                'order' => 3,
            ),
            array(
                'id' => 'is_required',
                'caption' => 'Required',
                'type' => 'boolean',
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => false,
                'is_system' => false,
            	'order' => 4,
            ),
//            array(
//                'id' => 'instructions',
//                'caption' => 'Infill Instructions',
//                'type' => 'text',
//                'length' => '',
//                'table_name' => 'listing_fields',
//                'is_required' => false,
//                'is_system' => false,
//            	'order' => 100,
//            ),
        );

        if ($pages_list) {
        	 $posting_page = array(
		            array(
		                'id' => 'posting_page',
		                'caption' => 'Posting Page',
		            	'list_values' => $pages_list,
		                'type' => 'list',
		                'length' => '20',
		                'is_required' => true,
		                'is_system' => true,
		            	'order' => 5,
		            ));
		       $common_details_info = array_merge( $common_details_info, $posting_page );
        }
        $field_type = isset( $listing_field_info['type'] ) ? $listing_field_info['type'] : null;
        $extra_details_info = SJB_ListingFieldDetails::getDetailsByFieldType( $field_type );
		return $details_info = array_merge( $common_details_info, $extra_details_info );
        
//        return array_merge( $details_info, self::getInfillInstructions());
    }

    function getDetailsByFieldType( $field_type )
    {
        return SJB_TypesManager::getExtraDetailsByFieldType( $field_type );
    }

	/**
	 * get Infill instructions field
	 * @return array
	 */
	function getInfillInstructions( $value = '' )
	{
		return array(
					'id' => 'instructions',
					'caption' => 'Infill Instructions',
					'type' => 'text',
					'length' => '',
					'table_name' => 'listing_fields',
					'is_required' => false,
					'is_system' => false,
					'order' => 100,
					'value' => $value,
		);
	}

}

