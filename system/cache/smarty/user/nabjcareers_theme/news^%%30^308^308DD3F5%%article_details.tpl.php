<?php  /* Smarty version 2.6.14, created on 2018-02-14 05:37:39
         compiled from article_details.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', 'article_details.tpl', 6, false),array('block', 'description', 'article_details.tpl', 7, false),array('block', 'tr', 'article_details.tpl', 29, false),array('modifier', 'strip_tags', 'article_details.tpl', 7, false),)), $this); ?>
<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error']):
?>
		<p class="error"><?php  echo $this->_tpl_vars['error_code']; ?>
</p>
	<?php  endforeach; endif; unset($_from); ?>
<?php  else: ?>
<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['article']['title'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('description', array()); $_block_repeat=true;$this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo ((is_array($_tmp=$this->_tpl_vars['article']['brief'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp));   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<div class="NewsItems">
		<h2><?php  echo $this->_tpl_vars['article']['title']; ?>
</h2>
		<small>posted: <?php  echo $this->_tpl_vars['article']['date']; ?>
</small> 
		<div class="newsPreview">
						
			
			<?php  if ($this->_tpl_vars['article']['text']):   echo $this->_tpl_vars['article']['text'];   else: ?>
			<?php  echo $this->_tpl_vars['article']['brief'];   endif; ?>
			<br /><br />
			<a href="<?php  echo $this->_tpl_vars['article']['link']; ?>
" target="_blank">Read full text</a> 		
			<br /><br />
		</div>
	</div>
<?php  endif; ?>

<?php  if ($this->_tpl_vars['GLOBALS']['plugins']['ShareThisPlugin']['active'] == 1 && $this->_tpl_vars['GLOBALS']['settings']['display_on_news_page'] == 1): ?>
	<?php  echo $this->_tpl_vars['GLOBALS']['settings']['header_code']; ?>

	<?php  echo $this->_tpl_vars['GLOBALS']['settings']['code']; ?>

<?php  endif; ?>
<div class="clr"><br/></div>
<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news-rss/" id="newsRss">RSS</a>&nbsp;<strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/all-news/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View All News<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></strong>