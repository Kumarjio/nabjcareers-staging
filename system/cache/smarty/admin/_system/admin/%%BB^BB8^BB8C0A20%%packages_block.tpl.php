<?php  /* Smarty version 2.6.14, created on 2018-02-20 12:37:26
         compiled from packages_block.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'packages_block.tpl', 13, false),array('function', 'image', 'packages_block.tpl', 18, false),)), $this); ?>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Type</th>
			<th>Number of Listings</th>
			<th colspan="4" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php  $_from = $this->_tpl_vars['packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['package']):
        $this->_foreach['items_block']['iteration']++;
?>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><?php  echo $this->_tpl_vars['package']['fields']['name']; ?>
</td>
			<td><?php  echo $this->_tpl_vars['package']['fields']['description']; ?>
</td>
			<td><?php  echo $this->_tpl_vars['package']['class_name']; ?>
</td>
			<td><?php  echo $this->_tpl_vars['package']['number_of_listings']; ?>
</td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/package/?id=<?php  echo $this->_tpl_vars['package']['id']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/package/?action=delete&id=<?php  echo $this->_tpl_vars['package']['id']; ?>
" onClick="return confirm('Are you sure you want to delete this package?');" title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" hspace="3" border=0 alt="Delete"></a></td>
			<td>
				<?php  if ($this->_foreach['items_block']['iteration'] < $this->_foreach['items_block']['total']): ?>
					<a href="?package_id=<?php  echo $this->_tpl_vars['package']['id']; ?>
&amp;action=move_down&id=<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" border="0" alt=""/></a>
				<?php  endif; ?> 
			</td>
			<td>
				<?php  if ($this->_foreach['items_block']['iteration'] > 1): ?>
					<a href="?package_id=<?php  echo $this->_tpl_vars['package']['id']; ?>
&amp;action=move_up&id=<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" border="0" alt=""/></a>
				<?php  endif; ?> 
			</td>
		</tr>
	<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>