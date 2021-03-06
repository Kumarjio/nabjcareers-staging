<?php
require_once("orm/Object.php");
require_once("orm/ObjectDetails.php");
require_once("orm/ObjectDBManager.php");

class SJB_AlphabetManager extends SJB_Object
{
	
	var $alphabetSID;
	var $order;
	
	function SJB_AlphabetManager($alphabet_info, $ABSid = 0)
	{
		$this->db_table_name = 'alphabet';
		$this->details = new SJB_AlphabetDetails($alphabet_info);
		$this->field_type = isset($alphabet_info['type']) ? $alphabet_info['type'] : null;
		$this->order = isset($alphabet_info['order']) ? $alphabet_info['order'] : null;
	}
	
	function getAlphabetInfo()
	{
		return SJB_DB::query("SELECT * FROM alphabet ORDER BY `order`");
	}
	
	function getADInfoBySID($ABSid)
	{
		return SJB_ObjectDBManager::getObjectInfo("alphabet", $ABSid);
	}
	
	function saveAlphabet($alphabet)
	{
		SJB_ObjectDBManager::saveObject('alphabet', $alphabet);
		if ($alphabet->sid)
			return true;
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM alphabet");
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		return SJB_DB::query("UPDATE alphabet SET `order` = ?n WHERE sid = ?n", ++$max_order, $alphabet->getSID());
	}
	
	function getOrderAB()
	{
		return $this->order;
	}
	
	function moveUpABBySID($ABSsid)
	{
		$ABInfo = SJB_DB::query("SELECT * FROM alphabet WHERE  sid = ?n", $ABSsid);
		if (empty($ABInfo)) return false;
		$ABInfo = array_pop($ABInfo);
		$current_order = $ABInfo['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM alphabet WHERE  `order` < ?n", $current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0)
		    return false;
		SJB_DB::query("UPDATE alphabet SET `order` = ?n WHERE `order` = ?n", $current_order, $up_order);
		SJB_DB::query("UPDATE alphabet SET `order` = ?n WHERE sid = ?n", $up_order, $ABSsid);
		return true;
	}
	
	function moveDownABdBySID($ABSsid)
	{
		$ABInfo = SJB_DB::query("SELECT * FROM alphabet WHERE  sid = ?n", $ABSsid);
		if (empty($ABInfo))
		    return false;
		$ABInfo = array_pop($ABInfo);
		$current_order = $ABInfo['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM alphabet WHERE  `order` > ?n", $current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0)
		    return false;
		SJB_DB::query("UPDATE alphabet SET `order` = ?n WHERE `order` = ?n", $current_order, $less_order);
		SJB_DB::query("UPDATE alphabet SET `order` = ?n WHERE sid = ?n", $less_order, $ABSsid);
		return true;
	}
	
	function deleteAlphabetBySID($ABSsid)
	{
		return SJB_ObjectDBManager::deleteObjectInfoFromDB("alphabet", $ABSsid);
	}
	
	function getAlphabetsForDisplay()
	{
		return  SJB_DB::query("SELECT * FROM `alphabet` WHERE `active`=1 ORDER BY `order`");
	}
}

class SJB_AlphabetDetails extends SJB_ObjectDetails
{
	
	function SJB_AlphabetDetails($alphabet_info)
	{
		$details_info = SJB_AlphabetDetails::getDetails($alphabet_info);
		foreach ($details_info as $detail_info) {
			if (isset($alphabet_info[$detail_info['id']])) {
				$detail_info['value'] = $alphabet_info[$detail_info['id']];
			} else 
				$detail_info['value'] = isset($detail_info['value']) ? $detail_info['value'] : '';
			$this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
		}
		
	}
	
	public static function getDetails()
	{
		return array(
				array
				(
					'id'		=> 'name',
					'caption'	=> 'Alphabet Name', 
					'type'		=> 'string',
					'length'	=> '20',
                    'table_name'=> 'alphabet',
					'is_required'=> true,
					'is_system'	=> true,
				),
				array
				(
					'id'		=> 'value',
					'caption'	=> 'Enter alphabet letters without any delimiters', 
					'type'		=> 'string',
					'length'	=> '255',
                    'table_name'=> 'alphabet',
					'is_required'=> true,
					'is_system'	=> true,
				),
				array
				(
					'id'		=> 'active',
					'caption'	=> 'Active ', 
					'type'		=> 'boolean',
                    'table_name'=> 'alphabet',
					'is_required'=> false,
					'is_system'	=> true,
				)
		 );		
	}
}
