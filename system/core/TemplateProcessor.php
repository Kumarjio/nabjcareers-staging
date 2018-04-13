<?php

require_once (SJB_System::getSystemSettings ('SMARTY_PATH'));
require_once 'ObjectMother.php';
require_once 'main/admin.php';

/**
 * TemplateProcessor - Template processing
 * @package SystemClasses
 * @subpackage TemplateProcessor
 */
class SJB_TemplateProcessor extends Smarty
{
	var $module_name;
	
	/**
	 * 
	 * @var SJB_TemplateSupplier
	 */
	var $templateSupplier;

	/**
	 * Constructor explains our requirements to Smarty
	 *
	 * @param object SJB_TemplatProcessor $templatesupplier  instatance of SJB_TemplateSupplier class
	 * @return Smarty
	 */
	function SJB_TemplateProcessor($templatesupplier)
    {
		$this->htmlTagConverter = SJB_ObjectMother::createHTMLTagConverterInArray();
       	$this->compile_dir = SJB_System::getSystemSettings('COMPILED_TEMPLATES_DIR')
        			. SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') . '/'
        			.$templatesupplier->getTheme();
		$this->compile_check = true;
        
		
		/**
		 * Check for 'cache_control_file.cache' in compile dir. If exists - clear compile dir.
		 * Then if 'highlight_templates' mode is ON, and user is 'admin' - create 'cache_control_file'.
		 */
		$cacheControlFile = $this->compile_dir.'/cache_control_file.cache';
		if (file_exists($cacheControlFile)) {
			$this->clear_all_cache();
			$this->clear_compiled_tpl();
		}
		
		if (SJB_Settings::getSettingByName('highlight_templates') == 1 && SJB_Request::getVar('admin_mode', false, 'COOKIE') ) {
			$fp = fopen($cacheControlFile, 'w');
			fclose($fp);
		}
		
		$this->module_name = $templatesupplier->getModuleName();
		
		/////////////////////////	
       	$this->register_function('module', array(&$this, 'module'));
       	$this->register_function('hidden_form_fields', array(&$this, 'hidden_form_fields'));
       	$this->register_function('url', array(&$this, 'get_module_function_url'));
		/////////////////////////

		$this->register_block('title', array(&$this, '_tpl_title') );
		$this->register_block('keywords', array(&$this, '_tpl_keywords') );
		$this->register_block('description', array(&$this, '_tpl_description') );
		$this->register_block('breadcrumbs', array(&$this, '_tpl_breadcrumbs') );

		$this->register_prefilter(array(&$this, '_replace_translation_alias'));
		$this->register_block('tr', array(&$this, 'translate'));
        $templatesupplier->registerResources($this);
        $this->templateSupplier = $templatesupplier;

       	$this -> registerGlobalVariables();
	}

	function getSystemAccessType()
	{
		return $this->templateSupplier->getSystemAccessType();
	}
	
	function setSystemAccessType($at)
	{
		$this->templateSupplier->setSystemAccessType($at);
	}
	
	function _tpl_title($params, $content)
	{
		if (empty($content))
			return false;
		$title = SJB_System::getPageTitle();
		SJB_System::setPageTitle($title . ' ' .$content);
	}
	
	function _tpl_keywords($params, $content)
	{
		if (empty($content))
			return false;
		$keywords = SJB_System::getPageKeywords();
		SJB_System::setPageKeywords($keywords . ' ' .$content);
	}

	function _tpl_description($params, $content)
	{
		if (empty($content))
			return false;
		$description = SJB_System::getPageDescription();
		SJB_System::setPageDescription($description . ' ' .$content);
	}

	function _tpl_breadcrumbs($params, $content)
	{
		SJB_System::setGlobalTemplateVariable('ADMIN_BREADCRUMBS', $content, false);
	}

	function hidden_form_fields($params)
	{
		$result = "\n";
		foreach($params as $key => $value)
			$result .= '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'">'."\n";
		return $result;
	}

	/**
	 * This is callback function that called by Smarty to complete following
	 * expressions {module name="module_name" function="function name"}
	 *
	 * @param array $params Array of parameters
	 */
	function xload_module($params)
	{
		$name = isset($params['name']) ? $params['name'] : '';
		$function = isset($params['function']) ? $params['function'] : '';
		unset($params['name']);
		unset($params['function']);
		return SJB_System::executeFunction($name, $function, $params);
	}

	function module($params)
	{
		$name = isset($params['name']) ? $params['name'] : '';
		$function = isset($params['function']) ? $params['function'] : '';
		unset($params['name']);
		unset($params['function']);

		if ( empty($name) || empty($function) )
			return '<!-- Either module or function is not specified in call to {module ..} -->';

		return SJB_System::executeFunction($name, $function, $params);
	}

	function image()
	{
		return null; // $this -> print_image_path(array());
	}

	function print_image_path()
	{
		return null; // $this -> print_image_path(array());
	}

	/**
	 * Getting url of module function
	 *
	 * @param array $params  Array of parameters
	 */
	function get_module_function_url($params)
	{
		if (count($params) == 0)
			return SJB_System::getSystemSettings('SITE_URL');
		$module = isset($params['module']) ? $params['module'] : '';
		$function = isset($params['function']) ? $params['function'] : '';
		$uri = false;//PageConfig :: getModuleFunctionURI($module, $function);
		if ($uri === false)
			return 'There is no such function or module.';
		else
			return SJB_System::getSystemSettings('SITE_URL').$uri;
	}

	function registerGlobalVariables()
	{
		$variables = SJB_System::getGlobalTemplateVariables();
		foreach ($variables as $name => $value)
			$this->assign($name, $value);
		$queryString = split('&', $_SERVER['QUERY_STRING']);
		$params = array();
		foreach ($queryString as $key => $val) {
			if (!strstr($val, 'lang=')) {
				$params[] = $val;
			}
		}
		$this->assign('url', SJB_System::getURI());
		$this->assign('acl', SJB_Acl::getInstance());
		$this->assign('params', implode('&amp;', $params));
	}
	
	function display($resource_name, $cache_id = null, $use_module_name_as_compile_id = true)
	{
		if (isset($_GET['debug']) && $_GET['debug'] == 1) {
			global $DEBUG;
			$DEBUG[] = array('Template.tpl'=>$resource_name);
		}
		$compile_id = null;
		if ($use_module_name_as_compile_id)
			$compile_id = $this->module_name;

		parent::display($resource_name, $cache_id, $compile_id);
	}
	

	function filterThenAssign($tpl_var, $value = null)
	{
		if (is_array($tpl_var))
			$this->htmlTagConverter->explore($tpl_var);
		if (!is_null($value))
			$this->htmlTagConverter->explore($value);
		parent::assign($tpl_var, $value);
	}

	
	function translate($params, $phrase_id, &$smarty, $repeat)
	{
		if ($repeat)
			return null; // see Smarty manual

		if (empty($phrase_id))
			return '';
			
		$this->i18n = SJB_I18N::getInstance();
		$mode = isset($params['mode']) ? $params['mode'] : null;

		if (isset($params['metadata']) && gettype($params['metadata']) === 'array') {
			$res = $this->_translateMetadata($params['metadata'], $phrase_id, $mode);
			$res = $this->replace_with_template_vars($res, $smarty);
			return $res;
		} 

		if (isset($params['type'])) {
			return $this->_translateByType($params['type'], $phrase_id);
		} 
		$domain = isset($params['domain']) ? $params['domain'] : null;
		$res = $this->i18n->gettext($domain, trim($phrase_id), $mode);
		return $this->replace_with_template_vars($res, $smarty);
	}
	
	function replace_with_template_vars($res, &$smarty)
	{
		if (preg_match_all('/{[$]([a-zA-Z0-9_]+)}/', $res, $matches)) {
			foreach($matches[1] as $varName) {
				$value = $smarty->get_template_vars($varName);
				$res = preg_replace('/{[$]'.$varName.'}/u',$value,$res);
			}
		}
		return $res;
	}

	function _translateMetadata($metadata, $phrase_id, $mode)
	{
		if (isset($metadata['domain']))
			return $this->i18n->gettext($metadata['domain'], $phrase_id, $mode);
		if (isset($metadata['type']))
			return $this->_translateByType($metadata['type'], $phrase_id);
		return null;
	}
	
	function _translateByType($type, $value)
	{
		switch ($type) {
			case 'int':
			case 'integer':
				return $this->i18n->getInt($value);
				break;
			case 'float':
				return $this->i18n->getFloat($value);
				break;
			case 'date':
				return $this->i18n->getDate($value);
				break;
			default: return $value;
				break;
		}
		return null;
	}

	function _replace_translation_alias($tpl_source)
	{
		return preg_replace_callback (
			'/\[\[(?:([\w-_]+)!)?(.*?)(?::([\w-_]+))?\]\]/msu',
			array (&$this, '_replace_alias_with_block_function_tr'), $tpl_source);
	}

	function _replace_alias_with_block_function_tr($matches)
	{
		$domain = $matches[1];
		$phrase_id = $matches[2];
		$mode = isset($matches[3]) ? ' mode="'.$matches[3].'"' : null;
		$metadata = null;
		if (preg_match("/^[$]([a-zA-Z0-9._]+)$/",$phrase_id, $m)) {
			$metadata = ' metadata=$METADATA.'.$m[1];
			$phrase_id = "{".$phrase_id."}";
		}
		else {
			if ($domain) {
				$domain = ' domain="'.$domain.'"';
			}
			else if (preg_match("/^(\w+\\\\!)/", $phrase_id)) {
				$phrase_id = preg_replace("/^(\w+)\\\\!/u", '$1!', $phrase_id);
			}
		}
		if ($phrase_id) {
			return sprintf('{tr%s%s%s}%s{/tr}', $metadata, $domain, $mode, $phrase_id);
		}
	}

		
}
