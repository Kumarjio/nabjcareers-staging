<?php  /* Smarty version 2.6.14, created on 2018-03-27 10:33:48
         compiled from listing_fields.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'listing_fields.tpl', 1, false),array('function', 'cycle', 'listing_fields.tpl', 15, false),array('function', 'display', 'listing_fields.tpl', 16, false),array('function', 'image', 'listing_fields.tpl', 21, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Common Fields<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Common Fields</h1>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing-field/">Add a New Listing Field</a></p>

<table>
	<thead>
		<th>ID</th>
		<th>Caption</th>
		<th>Type</th>
		<th>Required</th>
		<th colspan="3" class="actions">Actions</th>	
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['listing_field_sids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing_field_sid']):
        $this->_foreach['items_block']['iteration']++;
?>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'id','object_sid' => $this->_tpl_vars['listing_field_sid']), $this);?>
</td>
			<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'caption','object_sid' => $this->_tpl_vars['listing_field_sid']), $this);?>
</td>
			<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'type','object_sid' => $this->_tpl_vars['listing_field_sid']), $this);?>
</td>
			<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'is_required','object_sid' => $this->_tpl_vars['listing_field_sid']), $this);?>
</td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/attention-listing-type-field/?listing_sid=<?php  echo $this->_tpl_vars['listing_field_sid']; ?>
"  title="Template Instructions">Template Instructions</a></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing-field/?sid=<?php  echo $this->_tpl_vars['listing_field_sid']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border="0" alt="Edit" /></a></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/delete-listing-field/?sid=<?php  echo $this->_tpl_vars['listing_field_sid']; ?>
" onclick='return confirm("Are you sure you want to delete this field?")' title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border="0" alt="Delete" /></a></td>
		</tr>
		<?php  endforeach; endif; unset($_from); ?>	
	</tbody>
</table>