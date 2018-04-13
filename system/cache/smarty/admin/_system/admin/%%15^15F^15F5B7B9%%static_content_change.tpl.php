<?php  /* Smarty version 2.6.14, created on 2018-04-01 03:15:45
         compiled from static_content_change.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'WYSIWYGEditor', 'static_content_change.tpl', 28, false),)), $this); ?>
<?php  echo $this->_tpl_vars['error']; ?>

<form method="post">
	<input type="hidden" name="action" value="change" />
	<input type="hidden" name="page_sid" value=<?php  echo $this->_tpl_vars['page_sid']; ?>
 />
	<table width="100%">
		<tr>
			<td width="15%">ID</td>
			<td><input type="text" name="page_id" value="<?php  echo $this->_tpl_vars['page']['id']; ?>
" class="text" /></td>
		</tr>
		<tr>
			<td>Static content name</td>
			<td><input type="text" name="name" value="<?php  echo $this->_tpl_vars['page']['name']; ?>
" class="text" /></td>
		</tr>
		<tr>
			<td>Language</td>
			<td>
				<select name="lang">
					<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
						<option value="<?php  echo $this->_tpl_vars['language']['id']; ?>
"<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['page']['lang']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['language']['caption']; ?>
</option>
					<?php  endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">Static content:</td>
		</tr>
		<tr>
			<td colspan="2"><?php  echo smarty_function_WYSIWYGEditor(array('name' => 'content','width' => "100%",'height' => '700','value' => $this->_tpl_vars['page_content'],'type' => 'fckeditor','conf' => 'BasicAdmin'), $this);?>
</td>
		</tr>
		<tr id="clearTable">
			<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Change" class="greenButton" /></span></td>
		</tr>
	</table>
</form>