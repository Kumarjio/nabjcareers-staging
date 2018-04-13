<?php  /* Smarty version 2.6.14, created on 2018-03-22 08:12:19
         compiled from main.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'main.tpl', 1, false),array('block', 'tr', 'main.tpl', 3, false),array('function', 'cycle', 'main.tpl', 13, false),array('function', 'image', 'main.tpl', 15, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">Users</a> > <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?username=<?php  echo $this->_tpl_vars['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_sid']; ?>
">Edit User Info</a> > Personal Messages<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Manage Personal messages for <?php  echo $this->_tpl_vars['username']; ?>
</h1>
<h3><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select folder<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

<table>
	<thead>
		<tr>
			<th>Folder</th>
			<th align="center">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Inbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php  echo $this->_tpl_vars['total_in']; ?>
)</td>
			<td width="20%" align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/pm-inbox/?username=<?php  echo $this->_tpl_vars['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_sid']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Outbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php  echo $this->_tpl_vars['total_out']; ?>
)</td>
			<td width="20%" align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/pm-outbox/?username=<?php  echo $this->_tpl_vars['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_sid']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
		</tr>
	</tbody>
</table>