<?php
/**
 * Description of TreeHelper
 *
 * @author still
 */
class SJB_TreeHelper
{
	/**
	 * describes what type of TreeHelper is used
	 * 'user' | 'listing'
	 * @var string
	 */
	private $_type;

	/**
	 *
	 * @var object SJB_UserProfileFieldTreeManager | SJB_ListingFieldTreeManager
	 */
	private $_treeManager;

	/**
	 * field SID
	 * old "id"
	 * @var int
	 */
	private $_fieldSID;
	private $_checked = array();
	private $_search;

	/**
	 * old "name"
	 * @var string
	 */
	private $_fieldName;

	/*
	 * Tree Properties
	 */
	private $_sortByAlphabet = false;
	private $_displayAsSelectBoxes = false;


	private $_treeValues = array();
	private $_translatedCaptions = array();

	/*
	 * values are needed as global for
	 * "get_tree_recurse_fixed" function
	 */
	 private static $__counter;
	 private static $__items_in_column;
	 private static $__columns_count;

	/**
	 *
	 * @param string $type  'user' | 'listing'
	 */
	function __construct($type)
	{
		$this->_type = $type;
		switch ($this->_type) {
			case 'user':
				require_once ("users/UserProfileField/UserProfileFieldTreeManager.php");
				$this->_treeManager = new SJB_UserProfileFieldTreeManager();
				break;

			case 'listing':
				require_once ("classifieds/ListingField/ListingFieldTreeManager.php");
				$this->_treeManager = new SJB_ListingFieldTreeManager();
				break;

			default:
				break;
		}
	}

	public function init()
	{
		$this->_fieldSID = SJB_Request::getInt('id');
		$this->_fieldName = SJB_Request::getString('name');
		$this->_search = SJB_Request::getString('search');
		$this->_checked = (isset($_GET['check']) ? explode(',', $_GET['check']) : array());
		$this->_sortByAlphabet = $this->defineTreeProperty('sort_by_alphabet', $this->_fieldSID);
		$this->_displayAsSelectBoxes = $this->defineTreeProperty('display_as_select_boxes', $this->_fieldSID);
	}

	public function getDisplayAsSelectBoxes()
	{
		$parentSID = SJB_Request::getInt('parentSID');
		$this->_treeValues = $this->_treeManager->getTreeItemsByParentSIDAndFieldSID($this->_fieldSID, $parentSID);
		if (!empty($this->_treeValues)) {
			$level = $this->_treeValues[$parentSID][0]['level'];
			$aLevel = $this->_treeManager->getTreePropertyByNameAndTreeSID('level_' . $level, $this->_fieldSID);
			$levelCaption = $aLevel['value'];
		}
		else {
			return false;
		}

		// TRANSLATE & Order BY Alphabet
		$this->translateAndMakeOrderTreeValues();
		$this->_treeValues = array_shift($this->_treeValues);
		$tp = SJB_System::getTemplateProcessor();
		$tp->assign('tree_values', $this->_treeValues);
		$tp->assign('levelName', $levelCaption);
		$tp->assign('level', $level);
		$tp->assign('has_child', true);
		$tp->assign('fieldSID', $this->_fieldSID);
		$tp->assign('name', $this->_fieldName);
		$tp->assign('checked', $this->_checked);
		$tp->display('../miscellaneous/tree_display_as_select.tpl');
	}

	public function getDisplayAsTree()
	{
		$this->_treeValues = $this->_treeManager->getTreeValuesBySID($this->_fieldSID);
		$this->translateAndMakeOrderTreeValues();

		self::$__counter = 0;
		$count_tree_valies = count($this->_treeValues);

		if ($count_tree_valies > 20) {
			// break tree-view in 2 columns
			self::$__columns_count = 2;
			self::$__items_in_column = ceil($count_tree_valies / self::$__columns_count);
		}
		else {
			self::$__items_in_column = $count_tree_valies;
			self::$__columns_count = 1;
		}

		$tree = self::get_tree_recurse_fixed($this->_fieldName, $this->_fieldSID, $this->_treeValues, $this->_checked, 0, $this->_search);
		$tree .= "</tr></table>";
		echo $tree;
	}

	/**
	 *
	 * @param string $sProperty
	 * @param int $fieldSID
	 * @return boolean
	 */
	public function defineTreeProperty($sProperty, $fieldSID)
	{
		$aProperty = $this->_treeManager->getTreePropertyByNameAndTreeSID($sProperty, $fieldSID);
		return (!empty($aProperty['value']) && $aProperty['value']) ? true : false;
	}

	/**
	 *
	 * @param int $fieldSID
	 * @return array
	 */
	public function getTreeValuesBySID($fieldSID)
	{
		return $this->_treeManager->getTreeValuesBySID($this->_fieldSID);
	}

	public static function haveSelectedChildren($id, $checked, $tree_values)
	{
		$co = 0;
		foreach ($checked as $one) {
			foreach ($tree_values[$id] as $item) {
				if ($one == $item['sid'])
					$co++;
			}
		}
		if ($co == count($tree_values[$id]))
			return ' checked';
		if ($co > 0)
			return ' half_checked';
		return '';
	}

	
	public function translateAndMakeOrderTreeValues()
	{
		$i18n = SJB_I18N::getInstance();
		$domain = 'Property_' . $this->_fieldName;
		foreach ($this->_treeValues as $key => $val) {
			foreach ($val as $s_key => $s_val) {
				$trans = $i18n->gettext($domain, $s_val['caption'], 'default');
				$this->_treeValues[$key][$s_key]['caption'] = $trans;
				$this->_translatedCaptions[$key][] = $trans;
			}
		}

		if ($this->_sortByAlphabet)
			$this->sortTreeItemsByAlphabetOrder();
	}

	public function sortTreeItemsByAlphabetOrder()
	{
		foreach ($this->_treeValues as $key => $val) {
			$captions_lower = array_map('strtolower', $this->_translatedCaptions[$key]);
			array_multisort($captions_lower, SORT_ASC, SORT_STRING, $this->_treeValues[$key]);
		}
	}

	public function get_sortByAlphabet()
	{
		return $this->_sortByAlphabet;
	}

	public function get_displayAsSelectBoxes()
	{
		return $this->_displayAsSelectBoxes;
	}

	public function get_treeValues()
	{
		return $this->_treeValues;
	}

	public static function get_tree_recurse_fixed($name, $id, $tree_value, $checked, $parent = 0, $search = false, $level = 0)
	{
		$td_open = false;

		$html = '';
		// если в массиве существует ключ переданного в параметрах родителя
		if (array_key_exists($parent, $tree_value)) {
			// если текущий родитель - не родитель всего дерева, то прописываем ему id с номером узла.
			// в противном случае - это родитель дерева.
			if ($level > 0)
				$html .= "\n<ul style='display: none;' id='tree_ul_{$parent}'>";
			else
				$html .= "\n<ul class='tree' id='tree_{$name}'> ";

			foreach ($tree_value[$parent] as $key => $elem) { // для каждого дочернего элемента пишем html-код
				$sub = false;
				$ch = '';
				$sid = $elem['sid'];
				// если текущий элемент - один из родителей, то проверим его на наличие дочерних
				if (array_key_exists($sid, $tree_value)) {
					$sub = true;
					$ch = self::haveSelectedChildren($sid, $checked, $tree_value);
				}

				$check = '';

				if (in_array($sid, $checked))
					$check = 'checked="checked"';

				if ($level == 0 && $parent == 0) {
					if (self::$__counter == 0 || self::$__counter >= self::$__items_in_column) {
						$html .= "<ul style=\"width:50%; display: block; float: left;\">";
						self::$__counter = 0;
						$td_open = true;
					}
					self::$__counter++;
				}
				$html .= self::get_tree_element_html($name, $sid, $parent, $level, $sub, $check, $ch, $search, $elem['caption']);
				$html .= self::get_tree_recurse_fixed($name, $id, $tree_value, $checked, $sid, $search, $level + 1);
				$html .= "\n</li>";

				if ($level == 0 && $parent == 0 && $td_open == true && self::$__counter >= self::$__items_in_column) {
					$html .= "</ul>";
					isset(self::$__columns_count) ? self::$__columns_count++ : self::$__columns_count = 1;
				}
			}

			$html .= "\n</ul>";
		}

		return $html;
	}

	public static function get_tree_element_html($name, $sid, $parent, $level, $sub, $check, $ch, $search, $caption)
	{
		return "<li id='tree_li_{$sid}'>
		<div class='arrow" . ($sub ? " collapsed' onclick=\"tree_expand_{$name}({$sid})\" id='tree_arrow_{$sid}'" : "'") . "></div>
		<div class='checkbox" . (!empty($check) ? " checked" : $ch) . "' onclick=\"tree_check_{$name}({$sid}, {$parent}, {$level})\"></div>
		<label>" . htmlentities($caption, ENT_QUOTES, "UTF-8") . "</label>
		<input type='checkbox' id='tree_check_{$sid}' name='{$name}" . ($search ? '[tree]' : '') . "[]' value='{$sid}' {$check} style='display: none;' />";
	}
	
}
