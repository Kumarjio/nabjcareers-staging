<?php  /* Smarty version 2.6.14, created on 2018-04-01 03:13:18
         compiled from static_content.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'static_content.tpl', 1, false),array('function', 'cycle', 'static_content.tpl', 48, false),array('function', 'image', 'static_content.tpl', 56, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Static Content<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Static Content</h1>
<?php  echo $this->_tpl_vars['error']; ?>


<form method=post>
	<fieldset>
		<legend>Add a New Static Content</legend>
		<input type= "hidden" name= "action" value= "add">
		<table>
			<tr>
				<td>ID</td>
				<td><input type="text" name="page_id" value="" class="text"></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="" class="text" onFocus="JavaScript: if (!this.value) this.value=pageid.value;"></td>
			</tr>
			<tr>
				<td>Language</td>
				<td>
					<select name="lang">
						<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
							<option value="<?php  echo $this->_tpl_vars['language']['id']; ?>
"<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['GLOBALS']['current_language']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['language']['caption']; ?>
</option>
						<?php  endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</fieldset>
</form>

<div class="clr"><br/></div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Language</th>
			<th colspan=2 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sid'] => $this->_tpl_vars['page']):
        $this->_foreach['foreach']['iteration']++;
?>
			<tr class=<?php  echo smarty_function_cycle(array('values' => "'oddrow', 'evenrow'"), $this);?>
>
				<td><?php  echo $this->_tpl_vars['page']['id']; ?>
</td>
				<td><?php  echo $this->_tpl_vars['page']['name']; ?>
&nbsp;</td>
				<td>
					<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
						<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['page']['lang']):   echo $this->_tpl_vars['language']['caption'];   endif; ?>
					<?php  endforeach; endif; unset($_from); ?>
				</td>
				<td><a href="?action=edit&page_sid=<?php  echo $this->_tpl_vars['sid']; ?>
&pageid=<?php  echo $this->_tpl_vars['page']['id']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
				<td><a href="?action=delete&page_sid=<?php  echo $this->_tpl_vars['sid']; ?>
" onclick="return confirm('Are you sure you want to delete this Static Content?')" title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border=0 alt="Delete"></a></td>
			</tr>
		<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>