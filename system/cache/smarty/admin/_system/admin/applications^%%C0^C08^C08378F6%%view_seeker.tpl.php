<?php  /* Smarty version 2.6.14, created on 2018-03-22 08:13:02
         compiled from view_seeker.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'view_seeker.tpl', 1, false),array('block', 'tr', 'view_seeker.tpl', 3, false),array('function', 'cycle', 'view_seeker.tpl', 26, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">Users</a> &#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?username=<?php  echo $this->_tpl_vars['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_sid']; ?>
">Edit User Info</a> &#187; Manage Applications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Manage Applications for <?php  echo $this->_tpl_vars['username']; ?>
</h1>
<h3><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Jobs Applied<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

<?php  if ($this->_tpl_vars['applications']): ?>
<form method="post" action="">
	<input type="hidden" name="orderBy" value="<?php  echo $this->_tpl_vars['orderBy']; ?>
" />
	<input type="hidden" name="order" value="<?php  echo $this->_tpl_vars['order']; ?>
" />
	<input type="hidden" name="username" value="<?php  echo $this->_tpl_vars['username']; ?>
" />

	<span class="deleteButtonEnd"><input type="submit" name="action" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="deleteButton" onclick="return confirm('Are you sure you want to delete this listing?')"/></span>
	<div class="clr"><br /></div>
	
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th><a href="?username=<?php  echo $this->_tpl_vars['username']; ?>
&orderBy=date&order=<?php  if ($this->_tpl_vars['orderBy'] == 'date' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date applied<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th><a href="?username=<?php  echo $this->_tpl_vars['username']; ?>
&orderBy=title&order=<?php  if ($this->_tpl_vars['orderBy'] == 'title' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th><a href="?username=<?php  echo $this->_tpl_vars['username']; ?>
&orderBy=company&order=<?php  if ($this->_tpl_vars['orderBy'] == 'company' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th><a href="?username=<?php  echo $this->_tpl_vars['username']; ?>
&orderBy=status&order=<?php  if ($this->_tpl_vars['orderBy'] == 'status' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
			</tr>
		</thead>
		<tbody>
			<?php  $_from = $this->_tpl_vars['applications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['applications'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['applications']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['app']):
        $this->_foreach['applications']['iteration']++;
?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
				<td rowspan="2"><input type="checkbox" name="applications[<?php  echo $this->_tpl_vars['app']['id']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['applications']['iteration']; ?>
"/></td>
				<td><?php  echo $this->_tpl_vars['app']['date']; ?>
</td>
				<td><?php  if ($this->_tpl_vars['app']['job'] != NULL): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-listing/?listing_id=<?php  echo $this->_tpl_vars['app']['job']['sid']; ?>
"><?php  echo $this->_tpl_vars['app']['job']['Title']; ?>
</a><?php  else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Not Available Anymore<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></td>
				<td><?php  echo $this->_tpl_vars['app']['company']['CompanyName']; ?>
</td>
				<td><?php  echo $this->_tpl_vars['app']['status']; ?>
</td>
			</tr>
			<tr><td colspan="4"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cover Letter<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:<br/><?php  echo $this->_tpl_vars['app']['comments']; ?>
</td></tr>
			<?php  endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
</form>
<?php  endif; ?>

<script type="text/javascript">
	var total = <?php  echo $this->_foreach['applications']['total']; ?>
;
	<?php  echo '
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById(\'checkbox_\' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if ( this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});
</script>
'; ?>