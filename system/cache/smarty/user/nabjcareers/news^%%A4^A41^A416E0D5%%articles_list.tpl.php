<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:57:53
         compiled from articles_list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', 'articles_list.tpl', 6, false),array('block', 'tr', 'articles_list.tpl', 9, false),array('modifier', 'regex_replace', 'articles_list.tpl', 59, false),)), $this); ?>
<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error']):
?>
		<p class="error"><?php  echo $this->_tpl_vars['error_code']; ?>
</p>
	<?php  endforeach; endif; unset($_from); ?>
<?php  else: ?>
<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>: Asia Media News<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  if ($this->_tpl_vars['show_categories_block']): ?>
	<div id="newsCategory">
		<h3><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>News Categories<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
		<?php  if (empty ( $this->_tpl_vars['current_category_sid'] )): ?>
			<strong>&#187; All</strong> 
		<?php  else: ?>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/all-news/">All</a> 
		<?php  endif; ?>
		<?php  $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
			<?php  if ($this->_tpl_vars['category']['name'] != 'Archive' && $this->_tpl_vars['category']['count'] > 0): ?>
				<?php  if ($this->_tpl_vars['current_category_sid'] == $this->_tpl_vars['category']['sid']): ?>
					<strong>&#187; <?php  echo $this->_tpl_vars['category']['name']; ?>
</strong>
				<?php  else: ?>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/all-news/<?php  echo $this->_tpl_vars['category']['sid']; ?>
"><?php  echo $this->_tpl_vars['category']['name']; ?>
</a>
				<?php  endif; ?>
			<?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
	</div>
<?php  endif; ?>

<form action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/all-news/">
	<input type="hidden" name="action" value="search" />
	<input type="text" name="search_text" value="" /> <input type="submit" name="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
</form>
<br/>
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news-rss/" id="newsRss">RSS</a>
<?php  if ($this->_tpl_vars['pages'] > 1): ?>
	<!-- PAGINATION -->
	<p>
		<form id="news_per_page_form" method="get" action="?">
			<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
">&lt;Previous</a><?php  else: ?>&lt;Previous<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-3 > 0): ?>&nbsp;<a href="?page=1">1</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-3 > 1): ?>&nbsp;...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-2 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['current_page']-2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['current_page']-1; ?>
</a><?php  endif; ?>
			<strong><?php  echo $this->_tpl_vars['current_page']; ?>
</strong>
			<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['current_page']+1; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+2 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['current_page']+2; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages']): ?>&nbsp;...<?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages'] + 1): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['pages']; ?>
"><?php  echo $this->_tpl_vars['pages']; ?>
</a><?php  endif; ?>
			<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
">Next&gt;</a><?php  else: ?>Next&gt;<?php  endif; ?>
			<input type="hidden" name="page" value="1" />
		</form>
	</p>
	<!-- END OF PAGINATION -->
<?php  endif; ?>

<?php  $_from = $this->_tpl_vars['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<div class="newsItems">
		<?php  if ($this->_tpl_vars['item']['link']): ?>
			<h2><a href="<?php  echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php  echo $this->_tpl_vars['item']['title']; ?>
</a></h2>
		<?php  else: ?>
			<h2><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news/<?php  echo $this->_tpl_vars['item']['sid']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html"><?php  echo $this->_tpl_vars['item']['title']; ?>
</a></h2>
		<?php  endif; ?>
		<div class="newsPreview">
			<small><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  echo $this->_tpl_vars['item']['date']; ?>
</small>
			<?php  if ($this->_tpl_vars['item']['image']): ?><img src="<?php  echo $this->_tpl_vars['item']['image_link']; ?>
" align="left" width="100" vspace="5" hspace="5" /><?php  endif; ?>
			<br/><?php  echo $this->_tpl_vars['item']['brief']; ?>

			<?php  if ($this->_tpl_vars['item']['link']): ?>
				<p align="right"><a href="<?php  echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>read more<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
			<?php  else: ?>
				<p align="right"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news/<?php  echo $this->_tpl_vars['item']['sid']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>read more<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
			<?php  endif; ?>
		</div>
	</div>
	<div class="clr"><br/></div>
<?php  endforeach; endif; unset($_from); ?>


<?php  if ($this->_tpl_vars['pages'] > 1): ?>
<!-- PAGINATION -->
<p>
	<form id="news_per_page_form" method="get" action="?">
	<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
">&lt;Previous</a><?php  else: ?>&lt;Previous<?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']-3 > 0): ?>&nbsp;<a href="?page=1">1</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']-3 > 1): ?>&nbsp;...<?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']-2 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['current_page']-2; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']-1 > 0): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['current_page']-1; ?>
</a><?php  endif; ?>
	<b><?php  echo $this->_tpl_vars['current_page']; ?>
</b>
	<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['current_page']+1; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']+2 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['current_page']+2; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages']): ?>&nbsp;...<?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']+3 < $this->_tpl_vars['pages'] + 1): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['pages']; ?>
"><?php  echo $this->_tpl_vars['pages']; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['current_page']+1 <= $this->_tpl_vars['pages']): ?>&nbsp;<a href="?page=<?php  echo $this->_tpl_vars['current_page']+1; ?>
">Next&gt;</a><?php  else: ?>Next&gt;<?php  endif; ?>

	<input type="hidden" name="page" value="1" />
	</form>

</p>
<!-- END OF PAGINATION -->
<?php  endif; ?>
	
<?php  endif; ?>