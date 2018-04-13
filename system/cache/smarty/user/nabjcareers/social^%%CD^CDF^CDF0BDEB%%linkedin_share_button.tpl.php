<?php  /* Smarty version 2.6.14, created on 2014-10-21 23:26:38
         compiled from linkedin_share_button.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'linkedin_share_button.tpl', 6, false),array('block', 'tr', 'linkedin_share_button.tpl', 6, false),)), $this); ?>
<div class="in_share">
	<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php  echo $this->_tpl_vars['articleUrl']; ?>
&title=<?php  echo $this->_tpl_vars['articleTitle']; ?>
&summary=<?php  echo $this->_tpl_vars['articleSummary']; ?>
&source=<?php  echo $this->_tpl_vars['articleSource']; ?>
" title=""
	   onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php  echo $this->_tpl_vars['articleUrl']; ?>
&title=<?php  echo $this->_tpl_vars['articleTitle']; ?>
&summary=<?php  echo $this->_tpl_vars['articleSummary']; ?>
&source=<?php  echo $this->_tpl_vars['articleSource']; ?>
',
		   'windowname1',
		   'width=520, height=570'); return false;">
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
social/linkedin_16x16.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>share job on linkedin<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" border="0" />
	</a>
</div>