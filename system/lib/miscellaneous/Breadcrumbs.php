<?php

class SJB_Breadcrumbs
{
	var $breadcrumbsTable	= 'breadcrumbs_structure';
	
	// get breadcrumbs for user
	function getBreadcrumbs()
	{
		$structure = SJB_DB::query("SELECT * FROM $this->breadcrumbsTable ORDER BY parent_id ASC");

		$currentPage = $GLOBALS['uri'];
		$breadcrumbs = array();
		
		$arr = explode("/", $currentPage);
		foreach ($arr as $key=>$val) {
			if ($val == '')
				unset($arr[$key]);
		}
		
		// recursive walk in structure from current page to root
		function getCrumbs($keyName, $needle, $array, &$breadcrumbs) {			
			foreach ($array as $elem) {
				// look for current $elem of breadcrumbs in current page uri
				if ( $needle == $elem[$keyName] ) {
					$breadcrumbs[] = $elem;
					if($elem['parent_id'] != 0) {
						getCrumbs('id', $elem['parent_id'], $array, $breadcrumbs);
					}
				}
			}
			return $breadcrumbs;
		}
			
		while (count($arr)) {
			$currentPage = "/";
			foreach ($arr as $val) {
				if ($val != '')
					$currentPage .= "{$val}/";
			}
			$breadcrumbs = getCrumbs('uri', $currentPage, $structure, $breadcrumbs);
			$breadcrumbs = array_reverse($breadcrumbs);
			if (count($breadcrumbs)) {
				break;
			}
			array_pop($arr);
		}
		
		return $breadcrumbs;
	}
	
	// получаем и сортируем всю структуру по иерархии элементов
	function makeStructure()
	{
		$structure = SJB_DB::query("SELECT * FROM $this->breadcrumbsTable ORDER BY parent_id ASC");
		$end_structure = array();
		$this->createOrder($structure, $end_structure);
		
		return $end_structure;
	}
	
	// рекурсивная функция сортировки всей структуры bread crumbs по иерархии
	function createOrder($array, &$resultArray, $parent_id = '', $sublevel = '')
	{
		if($parent_id == '') {
			$parent_id = 0;
			$sublevel = 0;
		} else {
			$sublevel++;
		}
		foreach ( $array as $elem ) {
			if($elem['parent_id'] == $parent_id) {
				$resultArray[] = array_merge($elem, array('sublevel' => $sublevel) );
				$id = $elem['id'];
				$this->createOrder($array, $resultArray, $id, $sublevel);
			}
		}
	}
	
	function getElement($id)
	{
		return array_pop( SJB_DB::query("SELECT * FROM $this->breadcrumbsTable WHERE id=?n", $id) );
	}
	
	function deleteElement($id)
	{
		$struct = $this->makeStructure();
		// обходим всю структуру и удаляем все дочерние элементы узла c id=$id
		$this->delete($id, $struct);
		// удаляем сам узел
		$result = SJB_DB::query("DELETE FROM $this->breadcrumbsTable WHERE `id`=?n", $id);
	}
	
	// по parent_id удаляем дочерние элементы узла
	function delete($parent_id, &$struct)
	{
		foreach ($struct as $key=>$elem) {
			if ($elem['parent_id'] == $parent_id) {
				$this->delete($elem['id'], $struct);
				array_splice($struct, $key, 1);
				$result = SJB_DB::query("DELETE FROM $this->breadcrumbsTable WHERE `id`=?n LIMIT 1", $elem['id']);
			}
		}
	}
	
	function addElement( $item_name, $item_uri, $parent_id )
	{
		$result = SJB_DB::query("INSERT INTO $this->breadcrumbsTable SET `name`=?s, `uri`=?s, `parent_id`=?n", $item_name, $item_uri, $parent_id);
	}
	
	function updateElement( $item_name, $item_uri, $element_id )
	{
		$result = SJB_DB::query("UPDATE $this->breadcrumbsTable SET `name`=?s, `uri`=?s WHERE `id`=?n", $item_name, $item_uri, $element_id);
	}
}
