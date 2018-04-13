<?php  /* Smarty version 2.6.14, created on 2018-03-22 08:12:28
         compiled from acl_group_permissions.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'acl_group_permissions.tpl', 17, false),)), $this); ?>
<table>
	<thead>
		<tr>
			<th width="400px">Permission</th>
			<?php  if ($this->_tpl_vars['type'] == 'plan' && $this->_tpl_vars['membershipPlanInfo']['user_group_sid']): ?>
				<th width="150px">Plan permissions</th>
				<th width="150px">User Group Permissions</th>
			<?php  else: ?>
				<th width="150px"></th>
				<th width="150px"></th>
			<?php  endif; ?>
		</tr>
	</thead>
	<tbody>
	    <?php  $_from = $this->_tpl_vars['resources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['permission']):
?>
	    	<?php  if ($this->_tpl_vars['permission']['group'] == $this->_tpl_vars['group']): ?>
	        	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
	        		<td><?php  echo $this->_tpl_vars['permission']['title']; ?>
</td>
	        		<td>
	        			<?php  if ($this->_tpl_vars['type'] == 'user'): ?>
	        				<?php  if ($this->_tpl_vars['acl']->isAllowed($this->_tpl_vars['permission']['name'],$this->_tpl_vars['role'])): ?>
	        					Allowed
	        				<?php  else: ?>
	        					Denied
	        				<?php  endif; ?>
	        			<?php  elseif ($this->_tpl_vars['type'] == 'guest' || $this->_tpl_vars['type'] == 'group' || $this->_tpl_vars['permission']['type'] == 'plan'): ?>
	            			<label for="<?php  echo $this->_tpl_vars['permission']['name']; ?>
_allow">Allow</label>
	            			<input type="hidden" name="<?php  echo $this->_tpl_vars['permission']['name']; ?>
" value="inherit" />
	            			<input id="<?php  echo $this->_tpl_vars['permission']['name']; ?>
_allow" type="checkbox" name="<?php  echo $this->_tpl_vars['permission']['name']; ?>
" value="allow" <?php  if ($this->_tpl_vars['permission']['value'] == 'allow'): ?>checked="checked"<?php  endif; ?> onchange="viewPermission(this);" class="permissionSelect" />
	        			<?php  else: ?>
	        				<select name="<?php  echo $this->_tpl_vars['permission']['name']; ?>
" onchange="viewPermission(this);" class="permissionSelect">
	        					<option value="inherit" <?php  if ($this->_tpl_vars['permission']['value'] != 'allow' && $this->_tpl_vars['permission']['value'] != 'deny'): ?>selected="selected"<?php  endif; ?>>Use user group permission</option>
	        					<option value="allow" <?php  if ($this->_tpl_vars['permission']['value'] == 'allow'): ?>selected="selected"<?php  endif; ?>>Allow</option>
	        					<option value="deny" <?php  if ($this->_tpl_vars['permission']['value'] == 'deny'): ?>selected="selected"<?php  endif; ?>>Deny</option>
	        				</select>
	        			<?php  endif; ?>
	            		<?php  if ($this->_tpl_vars['permission']['limitable'] && $this->_tpl_vars['type'] == 'plan'): ?>
	                		<div id="<?php  echo $this->_tpl_vars['permission']['name']; ?>
_amountPermissions">
		            			<?php  if (strpos ( $this->_tpl_vars['permission']['name'] , 'post' ) !== false): ?>Number of postings<?php  else: ?>Number of views<?php  endif; ?> <input size="4" type="text" name="<?php  echo $this->_tpl_vars['permission']['name']; ?>
_params" value="<?php  echo $this->_tpl_vars['permission']['params']; ?>
" />
		            			<br /><div style="font-size: 9px">Set empty or 0 for unlimited number.</div>
	            			</div>
	            		<?php  endif; ?>
	        		</td>
	        		<td>
	            		<?php  if ($this->_tpl_vars['type'] == 'user'): ?>
	    					<?php  if ($this->_tpl_vars['permission']['limitable'] && $this->_tpl_vars['acl']->isAllowed($this->_tpl_vars['permission']['name'],$this->_tpl_vars['role'])): ?>
	    						<?php  if ($this->_tpl_vars['acl']->getPermissionParams($this->_tpl_vars['permission']['name'],$this->_tpl_vars['role'])): ?>
	    							<?php  echo $this->_tpl_vars['acl']->getPermissionParams($this->_tpl_vars['permission']['name'],$this->_tpl_vars['role']); ?>

	    							<?php  if ($this->_tpl_vars['acl']->getPermissionParams($this->_tpl_vars['permission']['name'],$this->_tpl_vars['role']) == 1): ?>
	    								<?php  if (strpos ( $this->_tpl_vars['permission']['name'] , 'post' ) !== false): ?>
	    									posting
	    								<?php  else: ?>
	    									use
	    								<?php  endif; ?>
	    							<?php  else: ?>
	    								<?php  if (strpos ( $this->_tpl_vars['permission']['name'] , 'post' ) !== false): ?>
	    									postings
	    								<?php  else: ?>
	    									uses
	    								<?php  endif; ?>
	    							<?php  endif; ?>
	    						<?php  else: ?>
									<?php  if (strpos ( $this->_tpl_vars['permission']['name'] , 'post' ) !== false): ?>
										unlimited postings
									<?php  else: ?>
										unlimited use
									<?php  endif; ?>
	    						<?php  endif; ?>
	    					<?php  endif; ?>
	            		<?php  endif; ?>
	            		<?php  if ($this->_tpl_vars['type'] == 'plan' && $this->_tpl_vars['membershipPlanInfo']['user_group_sid']): ?>
		    				<?php  if ($this->_tpl_vars['acl']->isAllowed($this->_tpl_vars['permission']['name'],$this->_tpl_vars['membershipPlanInfo']['user_group_sid'],'group')): ?>
		    					<?php  if ($this->_tpl_vars['permission']['limitable']): ?>
	    							unlimited
	    						<?php  else: ?>
	    							allow
	    						<?php  endif; ?>
	        				<?php  else: ?>
	        					deny
	        				<?php  endif; ?>
	            		<?php  endif; ?>
	        		</td>
	        	</tr>
	    	<?php  endif; ?>
	    <?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>