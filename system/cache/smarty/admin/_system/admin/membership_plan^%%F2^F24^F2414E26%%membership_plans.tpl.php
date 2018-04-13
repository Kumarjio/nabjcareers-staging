<?php  /* Smarty version 2.6.14, created on 2018-02-20 12:37:13
         compiled from membership_plans.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'membership_plans.tpl', 1, false),array('function', 'cycle', 'membership_plans.tpl', 24, false),array('function', 'image', 'membership_plans.tpl', 30, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Membership Plans<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Membership Plans</h1>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/add/">Add a New Membership Plan</a></p>


<table>
	<thead>
	    <tr>
	    	<th>Id</th>
	        <th>Name</th>
	        <th>Descriptin</th>
	        <th>Price</th>
	        <th>Subscribed Users</th>
	        <th colspan="3" class="actions">Actions</th>
	    </tr>
    </thead>
    
    <?php  if ($this->_tpl_vars['url'] != "/resume-plans/"): ?>     
    
    <tbody>
	    <?php  $_from = $this->_tpl_vars['membership_plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['membership_plan']):
?>
	    <?php  if ($this->_tpl_vars['membership_plan']['id'] != '34' && $this->_tpl_vars['membership_plan']['id'] != '33' && $this->_tpl_vars['membership_plan']['id'] != '37' && $this->_tpl_vars['membership_plan']['id'] != '36'): ?>
	    	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
	    		<td><?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
</td>
	        	<td><?php  echo $this->_tpl_vars['membership_plan']['name']; ?>
</td>
	        	<td><?php  echo $this->_tpl_vars['membership_plan']['description']; ?>
</td>
	        	<td><?php  echo $this->_tpl_vars['membership_plan']['price']; ?>
</td>
	        	<td><?php  echo $this->_tpl_vars['membership_plan']['subscribed_users']; ?>
</td>
	        	<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/?id=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border="0" alt="Edit" /></a></td>
	        	<td><span class="greenButtonEnd"><input type="button" onclick="location.href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/?type=plan&amp;role=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
'" class="greenButton" value="Manage permissions" /></span></td>
	        	<?php  if ($this->_tpl_vars['membership_plan']['subscribed_users']): ?>
	        		<td>&nbsp;</td>
	        	<?php  else: ?>
		        	<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plans/?action=delete&membership_plan_sid=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
" onClick="return confirm('Are you sure you want to delete this membership plan?');" title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border="0" alt="Delete" /></a></td>
	        	<?php  endif; ?>
	    	</tr>
	    <?php  endif; ?>
	    <?php  endforeach; endif; unset($_from); ?>
	</tbody>
	
	<?php  else: ?> 	    <tbody>
	    <?php  $_from = $this->_tpl_vars['membership_plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['membership_plan']):
?>
	    	<?php  if ($this->_tpl_vars['membership_plan']['id'] != '35'): ?>	    	
		    	<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
		    		<td><?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
</td>
		        	<td><?php  echo $this->_tpl_vars['membership_plan']['name']; ?>
</td>
		        	<td><?php  echo $this->_tpl_vars['membership_plan']['description']; ?>
</td>
		        	<td><?php  echo $this->_tpl_vars['membership_plan']['price']; ?>
</td>
		        	<td><?php  echo $this->_tpl_vars['membership_plan']['subscribed_users']; ?>
</td>
		        	<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/?id=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border="0" alt="Edit" /></a></td>
		        	<td><span class="greenButtonEnd"><input type="button" onclick="location.href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/?type=plan&amp;role=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
'" class="greenButton" value="Manage permissions" /></span></td>
		        	<?php  if ($this->_tpl_vars['membership_plan']['subscribed_users']): ?>
		        		<td>&nbsp;</td>
		        	<?php  else: ?>
			        	<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plans/?action=delete&membership_plan_sid=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
" onClick="return confirm('Are you sure you want to delete this membership plan?');" title="Delete"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border="0" alt="Delete" /></a></td>
		        	<?php  endif; ?>
		    	</tr>	    	
	    	<?php  endif; ?>
	    <?php  endforeach; endif; unset($_from); ?>
	</tbody>
	<?php  endif; ?>

</table>