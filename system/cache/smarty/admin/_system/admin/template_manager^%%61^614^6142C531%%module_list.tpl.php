<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:35:39
         compiled from module_list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'module_list.tpl', 17, false),)), $this); ?>
<div class="clr"><br/><br/></div>
<table>
	<thead>
		<tr>
			<th>Module Name</th>
			<th>Description</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $this->assign('counter', 0); ?>
		<?php  $_from = $this->_tpl_vars['module_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['system_module_name'] => $this->_tpl_vars['module_info']):
?>
			<?php  $this->assign('counter', $this->_tpl_vars['counter']+1); ?>
			<tr class="<?php  if ((1 & $this->_tpl_vars['counter'])): ?>oddrow<?php  else: ?>evenrow<?php  endif; ?>">
				<td><?php  echo $this->_tpl_vars['module_info']['display_name']; ?>
</td>
				<td><?php  echo $this->_tpl_vars['module_info']['description']; ?>
</td>
				<td align=center><a href="?module_name=<?php  echo $this->_tpl_vars['system_module_name']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
			</tr>
		<?php  endforeach; else: ?>
			<tr><td colspan=3>There are no modules with templates in the system. If you don't have any, your package either comes without module templates or is damaged. </td></tr>
		<?php  endif; unset($_from); ?>
	</tbody>
</table>