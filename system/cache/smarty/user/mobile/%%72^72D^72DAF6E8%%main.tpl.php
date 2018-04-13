<?php  /* Smarty version 2.6.14, created on 2015-03-01 21:19:32
         compiled from main.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'main.tpl', 5, false),array('function', 'image', 'main.tpl', 10, false),array('function', 'module', 'main.tpl', 38, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta name="keywords" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['KEYWORDS'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['KEYWORDS'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
		<meta name="description" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['DESCRIPTION'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['DESCRIPTION'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
		<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
		<meta content="width= 320" name="viewport">  	
		<title><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title'];   if ($this->_tpl_vars['TITLE'] != ""): ?>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['TITLE'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  endif; ?></title>
		<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
" />
		<link rel="apple-touch-icon" href="icon.png" />
	</head>
	<body>
	<div id="slider_from">
		
		<div class="logo">
			<div class="png"></div>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
logo.png" border="0" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['settings']['logoAlternativeText'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['settings']['logoAlternativeText'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a>
		</div>
		
				
		<div id="main_tab">
		  <ul>
		  	<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>
		  		<li class="first"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/logout/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
		  	<?php  else: ?>
				<li class="first" <?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/login/"): ?>id="current"<?php  endif; ?>><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/login/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign In<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>		  	
	  		<?php  endif; ?>
		  	<li <?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/find-jobs/" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/" && $this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'JobSeeker'): ?>id="current"<?php  endif; ?>><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/find-jobs/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
		  	<li <?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/search-resumes/" || $this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'JobSeeker'): ?>id="current"<?php  endif; ?> class="last_menu_item"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
		  </ul>
		</div>

		<div class="page" id="page">
			<div class="main">
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
					<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'classifieds','function' => 'search_form','listing_type_id' => 'R','form_template' => "search_form_resumes.tpl"), $this);?>

				<?php  else: ?>
					<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>

				<?php  endif; ?>
			</div>
		</div>
		
		
		<div id="foot"><a href="http://nabjcareers.org">click here to see the full site</div>
		
	</div>
	</body>
</html>