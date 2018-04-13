<?php  /* Smarty version 2.6.14, created on 2018-02-21 12:17:51
         compiled from view_error_log.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'view_error_log.tpl', 1, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Error Log<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>View Error Log</h1>

<form method="post">
	<p>Last 
		<select name="recordsNum" onchange="submit()">
		<option value="10" <?php  if ($this->_tpl_vars['recordsNum'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
		<option value="20" <?php  if ($this->_tpl_vars['recordsNum'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
		<option value="50" <?php  if ($this->_tpl_vars['recordsNum'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
		<option value="100" <?php  if ($this->_tpl_vars['recordsNum'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
		</select>
	 	records from log</p>
</form>

<div id="log">
	<?php  $_from = $this->_tpl_vars['errorLog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
		<hr size="3" noshade>
		<h3 style="border-bottom:1px dashed #666; padding-bottom: 10px;">Date: <?php  echo $this->_tpl_vars['error']['date']; ?>
</h3>
		<?php  echo $this->_tpl_vars['error']['errors']; ?>

		<br />
	<?php  endforeach; endif; unset($_from); ?>
</div>