<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:15:59
         compiled from news.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'news.tpl', 16, false),array('block', 'tr', 'news.tpl', 21, false),)), $this); ?>
<?php  if (! empty ( $this->_tpl_vars['articles'] )): ?>
	<div id="news">
		<input type="hidden" name="news_count" id="news_count" value="<?php  echo $this->_tpl_vars['news_count']; ?>
">
		<ul>
			<?php  $_from = $this->_tpl_vars['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['news_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['news_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['elem']):
        $this->_foreach['news_block']['iteration']++;
?>
				<li>
										<small><?php  echo $this->_tpl_vars['elem']['date']; ?>
</small><br/>
											<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news/<?php  echo $this->_tpl_vars['elem']['sid']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['elem']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html" class="newsLink"><?php  echo $this->_tpl_vars['elem']['title']; ?>
</a>
										<br/><?php  echo $this->_tpl_vars['elem']['brief']; ?>

				</li>
			<?php  endforeach; else: ?>
				<li><center><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There is no news in the system.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></center></li>	
			<?php  endif; unset($_from); ?>
		</ul>

		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news-rss/" id="newsRss">RSS</a>
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/all-news/" class="smallLink"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View All News<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
<?php  endif; ?>