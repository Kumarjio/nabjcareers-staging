<?php

require_once('orm/ObjectDetails.php');
require_once('orm/ObjectProperty.php');
require_once('orm/types/TypesManager.php');

class SJB_UserProfileFieldDetails extends SJB_ObjectDetails
{
    function SJB_UserProfileFieldDetails( $user_profile_field_info )
    {
        $details_info = SJB_UserProfileFieldDetails::getDetails( $user_profile_field_info );
        foreach ( $details_info as $detail_info ) {
            if ( isset( $user_profile_field_info[$detail_info['id']] ) ) {
                $detail_info['value'] = $user_profile_field_info[$detail_info['id']];
            }
            else {
                $detail_info['value'] = isset( $detail_info['value'] ) ? $detail_info['value'] : '';
            }
            $this->properties[$detail_info['id']] = new SJB_ObjectProperty( $detail_info );
        }
    }

    public static function getDetails( $user_profile_field_info )
    {
        $common_details_info = array(
            array(
                'id' => 'id',
                'caption' => 'ID',
                'type' => 'id_string',
                'length' => '20',
                'table_name' => 'user_profile_fields',
                'is_required' => true,
                'is_system' => false,
            ),
            array(
                'id' => 'caption',
                'caption' => 'Caption',
                'type' => 'string',
                'length' => '20',
                'is_required' => true,
                'is_system' => false,
            ),
            array(
                'id' => 'type',
                'caption' => 'Type',
                'type' => 'list',
                'list_values' => array(
                    array(
                        'id' => 'string',
                        'caption' => 'String',
                    ),
                    array(
                        'id' => 'text',
                        'caption' => 'Text',
                    ),
                    array(
                        'id' => 'list',
                        'caption' => 'List',
                    ),
					array(
						'id' => 'multilist',
						'caption' => 'MultiList',
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
                        'id' => 'picture',
                        'caption' => 'Picture',
                    ),
                    array(
                        'id' => 'logo',
                        'caption' => 'Logo',
                    ),
                    array(
                        'id' => 'email',
                        'caption' => 'Email',
                    ),
                    array(
                        'id' => 'tree',
                        'caption' => 'Tree',
                    ),
                    array(
                        'id' => 'video',
                        'caption' => 'Video',
                    ),
                ),
                'length' => '',
                'is_required' => true,
                'is_system' => false,
            ),
            array(
                'id' => 'is_required',
                'caption' => 'Required',
                'type' => 'boolean',
                'length' => '',
                'is_required' => false,
                'is_system' => false,
            ),
        );

        $field_type = isset( $user_profile_field_info['type'] ) ? $user_profile_field_info['type'] : null;
        $extra_details_info = SJB_UserProfileFieldDetails::getDetailsByFieldType( $field_type );
        return array_merge( $common_details_info, $extra_details_info );
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
					'table_name' => 'user_profile_fields',
					'is_required' => false,
					'is_system' => false,
					'order' => 100,
					'value' => $value,
		);
	}

}

