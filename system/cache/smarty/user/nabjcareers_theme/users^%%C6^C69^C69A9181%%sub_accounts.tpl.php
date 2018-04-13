<?php  /* Smarty version 2.6.14, created on 2018-02-26 15:18:48
         compiled from sub_accounts.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'sub_accounts.tpl', 5, false),array('function', 'cycle', 'sub_accounts.tpl', 41, false),)), $this); ?>
<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
		<p class="error">
			<?php  if ($this->_tpl_vars['error'] == 'ACCESS_DENIED'): ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You don't have permissions to access this page.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php  else: ?>
				<?php  echo $this->_tpl_vars['error']; ?>

			<?php  endif; ?>
		</p>
	<?php  endforeach; endif; unset($_from);   else: ?>
	<?php  if ($this->_tpl_vars['isSubuserRegistered']): ?>
		<p class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sub-user registered successfully<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  endif; ?>
	
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/new/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create New Account<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<div class="clr"><br/></div>
	
	<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/">
		<input type="hidden" name="action_name" value="delete" />
		<div class="numberPerPage">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actions with Selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
			<input type="submit" name="action_delete" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')" />
		</div>
		
		<!-- END PER PAGE / NAVIGATION -->
		<div class="clr"><br/></div>
		<div class="results">
			<table cellspacing="0">
				<thead>
					<tr>
						<th class="tableLeft"> </th>
						<th width="1"><input type="checkbox" id="all_checkboxes_control" /></th>
						<th width="50%"><?php  if (! $this->_tpl_vars['isEmailAsUsername']):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></th>
						<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
						<th colspan="2"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actions<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php  $_from = $this->_tpl_vars['subusers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['subuser_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['subuser_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subuser']):
        $this->_foreach['subuser_block']['iteration']++;
?>
					<tr <?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?>class="priorityListing"<?php  else: ?>class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
"<?php  endif; ?>>
						<td> </td>
						<td><input type="checkbox" name="user_id[]" value="<?php  echo $this->_tpl_vars['subuser']['sid']; ?>
" id="checkbox_<?php  echo $this->_foreach['subuser_block']['iteration']; ?>
" /></td>
						<td><?php  if (! $this->_tpl_vars['isEmailAsUsername']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/edit/?user_id=<?php  echo $this->_tpl_vars['subuser']['sid']; ?>
"><strong><?php  echo $this->_tpl_vars['subuser']['username']; ?>
</strong></a><?php  endif; ?></td>
						<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/edit/?user_id=<?php  echo $this->_tpl_vars['subuser']['sid']; ?>
"><strong><?php  echo $this->_tpl_vars['subuser']['email']; ?>
</strong></a></td>
						<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/edit/?user_id=<?php  echo $this->_tpl_vars['subuser']['sid']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td><td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/?action_name=delete&amp;user_id[]=<?php  echo $this->_tpl_vars['subuser']['sid']; ?>
" onclick="return confirm('<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
					</tr>
					<tr>
						<td colspan="6" class="separateListing"> </td>
					</tr>
					<?php  endforeach; endif; unset($_from); ?>
				</tbody>
			</table>
		</div>
	</form>
	<script type="text/javascript">
		var total = <?php  echo $this->_foreach['subuser_block']['total']; ?>
;
		<?php  echo '
		function set_checkbox(param) {
			for (i = 1; i <= total; i++) {
				if (checkbox = document.getElementById(\'checkbox_\' + i))
					checkbox.checked = param;
			}
		}
		
		$("#all_checkboxes_control").click(function() {
			set_checkbox(this.checked);
		});
		'; ?>

	</script>
<?php  endif; ?>