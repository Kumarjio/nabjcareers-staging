<?php  /* Smarty version 2.6.14, created on 2018-03-22 08:12:28
         compiled from acl.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'acl.tpl', 46, false),)), $this); ?>
<?php  echo '
<script type="text/javascript">
<!--
	function viewPermission(el)
    {
    	var groupDiv = \'#\' + el.name + \'_groupPermissions\';
    	var amountDiv = \'#\' + el.name + \'_amountPermissions\';

    	if (el.tagName == \'INPUT\') {
    		$(groupDiv).hide();
    		if (el.checked) {
    			$(amountDiv).show();
    		}
    		else {
    			$(amountDiv).hide();        		
    		}
    	}
    	else {
        	switch (el.value) {
        		case \'inherit\':
            		$(groupDiv).show();
            		$(amountDiv).hide();
            		break;
        		case \'allow\':
            		$(groupDiv).hide();
            		$(amountDiv).show();
            		break;
        		case \'deny\':
        			$(groupDiv).hide();
        			$(amountDiv).hide();
            		break;
        	}
    	}
	}

    $(document).ready(function () {
        $(".permissionSelect").each(function () {
        	viewPermission(this);
        });
    });

//-->
</script>
'; ?>


<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php  if ($this->_tpl_vars['type'] == 'user'): ?>
    	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?restore=1">Users</a> &#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?sid=<?php  echo $this->_tpl_vars['role']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">Edit User Info</a> &#187; View Permissions
    <?php  elseif ($this->_tpl_vars['type'] == 'group'): ?>
    	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-groups/">User Groups</a> &#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user-group/?sid=<?php  echo $this->_tpl_vars['role']; ?>
"><?php  echo $this->_tpl_vars['userGroupInfo']['name']; ?>
</a> &#187; Manage <?php  if ($this->_tpl_vars['type'] == 'group'):   echo $this->_tpl_vars['userGroupInfo']['name']; ?>
 <?php  endif; ?>Permissions
    <?php  elseif ($this->_tpl_vars['type'] == 'guest'): ?>
    	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-groups/">User Groups</a> &#187; Manage Guest Permissions
    <?php  elseif ($this->_tpl_vars['type'] == 'plan'): ?>
    	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plans/">Membership Plans</a> &#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/?id=<?php  echo $this->_tpl_vars['role']; ?>
"><?php  echo $this->_tpl_vars['membershipPlanInfo']['name']; ?>
</a> &#187; Manage <?php  echo $this->_tpl_vars['membershipPlanInfo']['name']; ?>
 Permissions 
    <?php  endif; ?>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>
	<?php  if ($this->_tpl_vars['type'] == 'user'): ?>View<?php  else: ?>Manage<?php  endif; ?> 
	<?php  if ($this->_tpl_vars['type'] == 'group'): ?>
		<?php  echo $this->_tpl_vars['userGroupInfo']['name']; ?>

	<?php  elseif ($this->_tpl_vars['type'] == 'guest'): ?>
		Guest
	<?php  elseif ($this->_tpl_vars['type'] == 'plan'): ?>
		<?php  echo $this->_tpl_vars['membershipPlanInfo']['name']; ?>

	<?php  endif; ?> Permissions
</h1>
<div style="width: 700px;	display: block;">
	<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="type" value="<?php  echo $this->_tpl_vars['type']; ?>
" />
		<input type="hidden" name="role" value="<?php  echo $this->_tpl_vars['role']; ?>
" />
		<h3>General permissions</h3>
		<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "acl_group_permissions.tpl", 'smarty_include_vars' => array('group' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<?php  $_from = $this->_tpl_vars['listingTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingType']):
?>
			<h3><?php  echo $this->_tpl_vars['listingType']['name']; ?>
 permissions</h3>
			<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "acl_group_permissions.tpl", 'smarty_include_vars' => array('group' => $this->_tpl_vars['listingType']['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php  endforeach; endif; unset($_from); ?>
	
		<?php  if ($this->_tpl_vars['type'] != 'user'): ?>
	    	<?php  if ($this->_tpl_vars['type'] == 'plan'): ?>
	        	<table width="100%" id="clear">
	        		<tr>
	        			<td  width="100%" style="text-align: right;"><small><b>Apply changes to all users currently subscribed to this plan</b></small></td><td align="right" ><input type="radio" name="update_users" value="1" checked="checked" /></td>
	        		</tr>
	        		<tr>
	        			<td  style="text-align: right;"><small><b>Changes will be applied to newly subscribed users only</b></small></td><td align="right" ><input type="radio" name="update_users" value="0"></td>
	        		</tr>
	        	</table>
	    	<?php  endif; ?>
			<br/><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
		<?php  endif; ?>
	</form>
</div>