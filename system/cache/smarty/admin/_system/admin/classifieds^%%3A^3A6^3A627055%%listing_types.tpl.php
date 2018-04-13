<?php  /* Smarty version 2.6.14, created on 2018-03-10 22:52:48
         compiled from listing_types.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'listing_types.tpl', 1, false),array('function', 'cycle', 'listing_types.tpl', 16, false),array('function', 'image', 'listing_types.tpl', 20, false),array('modifier', 'lower', 'listing_types.tpl', 25, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing Types<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Listing Types</h1>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing-type/">Add a New Listing Type</a></p>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Number of listings</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['listing_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_type']):
?>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><?php  echo $this->_tpl_vars['listing_type']['id']; ?>
</td>
			<td><?php  echo $this->_tpl_vars['listing_type']['caption']; ?>
</td>
			<td><?php  echo $this->_tpl_vars['listing_type']['listing_number']; ?>
</td>
			<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing-type/?sid=<?php  echo $this->_tpl_vars['listing_type']['sid']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border="0" alt="Edit" /></a></td>
			<?php  if ($this->_tpl_vars['listing_type']['listing_number'] > 0): ?>
			<?php  else: ?>
				<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/delete-listing-type/?sid=<?php  echo $this->_tpl_vars['listing_type']['sid']; ?>
" onclick='return confirm("Are you sure you want to delete this listing type?")' title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border="0" alt="Delete"/></a></td>
			<?php  endif; ?>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/posting-pages/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing_type']['id'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
" title="Posting Pages"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
postingPages.png" border="0" alt="Posting Pages" /></a></td>
		</tr>
		<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>