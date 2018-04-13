<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:14:12
         compiled from blank.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'blank.tpl', 4, false),array('function', 'image', 'blank.tpl', 5, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	    <title><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
 <?php  if ($this->_tpl_vars['TITLE'] != ""): ?> :: <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  endif; ?></title>
		<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
">
		<?php  if ($this->_tpl_vars['GLOBALS']['current_language_data']['rightToLeft']): ?><link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "designRight.css"), $this);?>
" /><?php  endif; ?>
		<style type="text/css">
		    TD.middle_head <?php  echo '{'; ?>

		    BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; FONT-WEIGHT: bold; FONT-SIZE: 18px; BACKGROUND-IMAGE: url(<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "gradient.gif"), $this);?>
); BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid; BACKGROUND-REPEAT: repeat-x; HEIGHT: 30px
		    <?php  echo '}'; ?>

		</style>
	</head>
	<body>
		<?php  echo $this->_tpl_vars['ERRORS_CONTENT']; ?>

		<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>

	</body>
</html>