<?php

require_once("orm/ObjectManager.php");
require_once("UserProfileFieldDBManager.php");
require_once("UserProfileField.php");
require_once("UserProfileFieldTreeManager.php");

class SJB_UserProfileFieldManager extends SJB_ObjectManager
{
	var $fields_info = array();

	function getFieldsInfoByUserGroupSID($user_group_sid)
	{
        if (isset($GLOBALS["UserProfileFieldManagerCache"][$user_group_sid]))
			return $GLOBALS["UserProfileFieldManagerCache"][$user_group_sid];
			
		$this->fields_info[$user_group_sid] = SJB_UserProfileFieldDBManager::getFieldsInfoByUserGroupSID($user_group_sid);
		$GLOBALS["UserProfileFieldManagerCache"][$user_group_sid] = $this->fields_info[$user_group_sid];
		return $this->fields_info[$user_group_sid];
	}
	
	function getFieldInfoBySID($user_profile_field_sid)
	{
		return SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($user_profile_field_sid);
	}
	
	function saveUserProfileField($user_profile_field)
	{
		$result = SJB_UserProfileFieldDBManager::saveUserProfileField($user_profile_field);
		if ($result && ($user_profile_field->field_type == 'list' || $user_profile_field->field_type == 'multilist' || $user_profile_field->field_type == 'tree')) {
			$i18n = SJB_ObjectMother::createI18N();
			$domainsData = $i18n->getDomainsData();
			$fieldId = $user_profile_field->details->properties['id']->value;
			if (!array_search($fieldId, $domainsData)) { // create new domain for listing field
				$i18n->addDomain('Property_'.$fieldId);				
			}
		}
		return $result;		
	}

	function deleteUserProfileFieldBySID($user_profile_field_sid)
	{
		return SJB_UserProfileFieldDBManager::deleteUserProfileFieldInfo($user_profile_field_sid);
	}

    function getUserProfileFieldIDBySID($user_profile_field_sid)
    {
		$user_profile_field_info = SJB_UserProfileFieldManager::getFieldInfoBySID($user_profile_field_sid);

		if (empty($user_profile_field_info))
			return null;
		return $user_profile_field_info['id'];
	}

    function getFieldBySID($user_profile_field_sid)
    {
		$user_profile_field_info = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($user_profile_field_sid);

		if (empty($user_profile_field_info)) {
			return null;
		}
		$user_profile_field = new SJB_UserProfileField($user_profile_field_info);
		$user_profile_field->setUserGroupSID($user_profile_field_info['user_group_sid']);
		return $user_profile_field;
	}
	
	function moveUpFieldBySID($field_sid)
	{
		SJB_UserProfileFieldDBManager::moveUpFieldBySID($field_sid);
	}
	
	function moveDownFieldBySID($field_sid)
	{
		SJB_UserProfileFieldDBManager::moveDownFieldBySID($field_sid);	
	}
	
	function changeUserPropertyIDs($user_group_sid, $user_profile_field_old_id, $user_profile_field_new_id)
	{
		return SJB_DB::query("UPDATE users_properties SET id = ?s WHERE id = ?s AND object_sid IN (SELECT sid FROM users WHERE user_group_sid = ?n)",
						$user_profile_field_new_id, $user_profile_field_old_id, $user_group_sid);
	}
	
	function getTreeValuesByParentSID($field_sid, $parent_sid)
	{
		return SJB_UserProfileFieldTreeManager::getTreeValuesByParentSID($field_sid, $parent_sid);
	}
	
	function addTreeItemToBeginByParentSID($field_sid, $parent_sid, $tree_item_value)
	{
		return SJB_UserProfileFieldTreeManager::addTreeItemToBeginByParentSID($field_sid, $parent_sid, $tree_item_value);
	}
	
	function addTreeItemToEndByParentSID($field_sid, $parent_sid, $tree_item_value)
	{
		return SJB_UserProfileFieldTreeManager::addTreeItemToEndByParentSID($field_sid, $parent_sid, $tree_item_value);
	}
	
	function addTreeItemAfterByParentSID($field_sid, $parent_sid, $tree_item_value, $after_tree_item_sid)
	{
		return SJB_UserProfileFieldTreeManager::addTreeItemAfterByParentSID($field_sid, $parent_sid, $tree_item_value, $after_tree_item_sid);
	}
	
	function deleteTreeItemBySID($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::deleteTreeItemBySID($item_sid);
	}
	
	function moveUpTreeItem($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::moveUpTreeItem($item_sid);
	}
	
	function moveDownTreeItem($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::moveDownTreeItem($item_sid);
	}
	
	function getTreeItemInfoBySID($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::getTreeItemInfoBySID($item_sid);
	}
	
	function updateTreeItemBySID($item_sid, $tree_item_value)
	{
		return SJB_UserProfileFieldTreeManager::updateTreeItemBySID($item_sid, $tree_item_value);
	}
	
	function getTreeNodePath($node_sid)
	{
		return SJB_UserProfileFieldTreeManager::getTreeNodePath($node_sid);
	}
	
	function getTreeParentSID($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::getParentSID($item_sid);
	}
	
	function moveTreeItemToBeginBySID($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::moveItemToBeginBySID($item_sid);
	}
	
	function moveTreeItemToEndBySID($item_sid)
	{
		return SJB_UserProfileFieldTreeManager::moveItemToEndBySID($item_sid);
	}
	
	function moveTreeItemAfterBySID($item_sid, $after_tree_item_sid)
	{
		return SJB_UserProfileFieldTreeManager::moveItemAfterBySID($item_sid, $after_tree_item_sid);
	}
	
	function getAllFieldsInfo()
	{	
		return  SJB_UserProfileFieldDBManager::getAllFieldsInfo();
	}
	
	function getFieldsInfoByType($type) {
		$type_fields = SJB_DB::query("SELECT `field`.*, users.`value` as id  FROM `user_profile_fields` as `field`
								  LEFT JOIN `user_profile_fields_properties` as `property` ON `field`.`sid`=`property`.`object_sid` 
								  LEFT JOIN `user_profile_fields_properties` as `users` ON `field`.`sid`=`users`.`object_sid` 
								  WHERE `property`.`id`='type' AND `property`.`value`=?s AND `users`.`id`='id'", 
								  $type);
		return $type_fields;
	}
}

