<?php  /* Smarty version 2.6.14, created on 2018-04-01 03:13:11
         compiled from user_pages_list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'user_pages_list.tpl', 1, false),array('function', 'image', 'user_pages_list.tpl', 12, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Site Pages<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Site Pages</h1>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-pages/?action=new_page">Add a New User Page</a></p>

<table>
	<thead>
		<tr>
			<th>
				<a href="?restore=1&amp;sorting_field=uri&amp;sorting_order=<?php  if ($this->_tpl_vars['sort_pages']['sorting_order'] == 'ASC' && $this->_tpl_vars['sort_pages']['sorting_field'] == 'uri'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">URI</a>
					<?php  if ($this->_tpl_vars['sort_pages']['sorting_field'] == 'id'): ?>
						<?php  if ($this->_tpl_vars['sort_pages']['sorting_order'] == 'ASC'): ?>
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
						<?php  else: ?>
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
						<?php  endif; ?>
					<?php  endif; ?>
			</th>
			<th>Title</th>	
			<th>Module</th>
			<th>Function</th>
			<th colspan=2 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['pages_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page']):
        $this->_foreach['foreach']['iteration']++;
?>
			<tr class="<?php  if (!(1 & $this->_foreach['foreach']['iteration'])): ?>evenrow<?php  else: ?>oddrow<?php  endif; ?>">
				<!--td><?php  echo $this->_tpl_vars['page']['uri']; ?>
</td-->
				<!--td><a href="?action=edit_page&uri=<?php  echo $this->_tpl_vars['page']['uri']; ?>
"><?php  echo $this->_tpl_vars['page']['uri']; ?>
</a></td-->	
				<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/..<?php  echo $this->_tpl_vars['page']['uri']; ?>
" target="_blank"><?php  echo $this->_tpl_vars['page']['uri']; ?>
</a></td>		
				<td><?php  echo $this->_tpl_vars['page']['title']; ?>
</td>
				<td><?php  echo $this->_tpl_vars['page']['module']; ?>
</td>
				<td><?php  echo $this->_tpl_vars['page']['function']; ?>
</td>
				<td><a href="?action=edit_page&uri=<?php  echo $this->_tpl_vars['page']['uri']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
				<td><a href="?action=delete_page&uri=<?php  echo $this->_tpl_vars['page']['uri']; ?>
" onclick="return confirm('Are you sure you want to delete this page?')" title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border=0 alt="Delete"></a></td>
			</tr>
		<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>