<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:05:31
         compiled from index.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'index.tpl', 1, false),array('block', 'tr', 'index.tpl', 159, false),array('function', 'cycle', 'index.tpl', 7, false),array('modifier', 'string_format', 'index.tpl', 47, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Dashboard<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="dashboardBlocks">
	<h1 class="usersOnline">Users online</h1>
	<table width="100%">
		<tbody>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
				<td><strong>Total Users</strong></td>
				<?php  if ($this->_tpl_vars['onlineUsers']): ?>
				<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?online=1&amp;action=search"><?php  echo $this->_tpl_vars['onlineUsers']['JobSeeker']['count']+$this->_tpl_vars['onlineUsers']['Employer']['count']; ?>
 online</a></td>
				<?php  else: ?>
				<td align="center">0</td>
				<?php  endif; ?>
			</tr>
			<?php  if ($this->_tpl_vars['onlineUsers']): ?>
			<?php  $_from = $this->_tpl_vars['onlineUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['outer']['iteration']++;
?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
				<td><strong><?php  echo $this->_tpl_vars['value']['caption']; ?>
</strong></td>
				<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;online=1&amp;action=search"><?php  echo $this->_tpl_vars['value']['count']; ?>
 online</a></td>
			</tr>
			<?php  endforeach; endif; unset($_from); ?>
			<?php  else: ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
">
				<td colspan="2"><strong>No online users</strong></td>
			</tr>
			<?php  endif; ?>
		</tbody>
	</table>
</div>

<div class="dashboardBlocks">
	<h1 class="payments"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=">Payments</a></h1>
	<table width="100%">
		<thead>
			<tr>
				<th align="center">Period</th>
				<th align="center">Completed</th>
				<th align="center">Pending</th>
			</tr>
		</thead>
		<tbodY>
			<?php  $_from = $this->_tpl_vars['paymentsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['paymentPeriod']):
        $this->_foreach['outer']['iteration']++;
?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
				<td><?php  echo $this->_tpl_vars['key'];   echo $this->_tpl_vars['test']['payment']; ?>
</td>
				<?php  $_from = $this->_tpl_vars['paymentPeriod']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['paymentInfo']):
?>
					<?php  $_from = $this->_tpl_vars['paymentInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['Info']):
?>
						<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/payments/?creation_date%5Bnot_less%5D=<?php  if ($this->_tpl_vars['key'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['key'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['key'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>&amp;creation_date%5Bnot_more%5D=<?php  echo $this->_tpl_vars['today']; ?>
&amp;action=filter&amp;status%5Bequal%5D=<?php  if ($this->_tpl_vars['key1'] == 'completed'): ?>Completed<?php  else: ?>Pending<?php  endif; ?>"><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo ((is_array($_tmp=$this->_tpl_vars['Info']['payment'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</a></td>
					<?php  endforeach; endif; unset($_from); ?>
				<?php  endforeach; endif; unset($_from); ?>
			</tr>
			<?php  endforeach; endif; unset($_from); ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
">
				<td><strong>Total</strong></td>
				<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=Completed"><b><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo ((is_array($_tmp=$this->_tpl_vars['totalPayments'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</b></a></strong></td>
				<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/payments/?creation_date%5Bnot_less%5D=&amp;creation_date%5Bnot_more%5D=&amp;action=filter&amp;status%5Bequal%5D=Pending"><b><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo ((is_array($_tmp=$this->_tpl_vars['pendingPayments'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</b></a></strong></td>
			</tr>
		</tbodY>
	</table>
</div>
<div class="clr"><br/></div>

<div class="dashboardBlocks">
	<h1 class="registered"><a title="Total registered users"href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/">Registered Users: <?php  echo $this->_tpl_vars['usersInfo']['count']; ?>
</a></h1>
	<?php  $_from = $this->_tpl_vars['groupsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['groupInfo']):
        $this->_foreach['outer']['iteration']++;
?>
	<?php  if ($this->_tpl_vars['groupInfo']['approveInfo'] != ''): ?>
		<?php  if ($this->_tpl_vars['groupInfo']['approveInfo']['Pending'] != ''): ?>
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['groupInfo']['approveInfo']['user_group_id']; ?>
&amp;approval%5Bequal%5D=pending"><strong>Waiting for approval: <?php  echo $this->_tpl_vars['groupInfo']['approveInfo']['Pending']; ?>
</strong></a>
		<?php  else: ?>
				<strong>Waiting for approval: 0</strong>
		<?php  endif; ?>
	<?php  endif; ?>
	<table width="100%">
		<thead>
			<tr>
				<th><b><?php  echo $this->_tpl_vars['groupInfo']['caption']; ?>
</b></th>
				<th align="center">Active</th>
				<th align="center">Not active</th>
				<th align="center">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php  $_from = $this->_tpl_vars['groupInfo']['periods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['period'] => $this->_tpl_vars['group']):
?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
					<td><?php  echo $this->_tpl_vars['period']; ?>
</td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=1&amp;registration_date%5Bnot_less%5D=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><?php  echo $this->_tpl_vars['group']['active']; ?>
</a></td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=0&amp;registration_date%5Bnot_less%5D=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><?php  echo $this->_tpl_vars['group']['count']-$this->_tpl_vars['group']['active']; ?>
</a></td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;registration_date%5Bnot_less%5D=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><?php  echo $this->_tpl_vars['group']['count']; ?>
</a></td>
				</tr>
			<?php  endforeach; endif; unset($_from); ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
">
				<td><strong>Totals</strong></td>
				<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=1"><?php  echo $this->_tpl_vars['groupInfo']['total']['active']; ?>
</a></strong></td>
				<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=0"><?php  echo $this->_tpl_vars['groupInfo']['total']['count']-$this->_tpl_vars['groupInfo']['total']['active']; ?>
</a></strong></td>
				<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?user_group%5Bequal%5D=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search"><?php  echo $this->_tpl_vars['groupInfo']['total']['count']; ?>
</a></strong></td>
			</tr>
		</tbody>
	</table>
	<br/>
	<?php  endforeach; endif; unset($_from); ?>
</div>

<div class="dashboardBlocks">
	<?php  $this->assign('totalPostings', '0'); ?>
	<?php  $_from = $this->_tpl_vars['listingsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['listingInfo']):
        $this->_foreach['outer']['iteration']++;
?>
		<?php  $this->assign('totalPostings', ($this->_tpl_vars['listingInfo']['total']['count']+$this->_tpl_vars['totalPostings'])); ?>
	<?php  endforeach; endif; unset($_from); ?>
	<h1 class="postings"><a title="Total postings" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?action=search">Postings: <?php  echo $this->_tpl_vars['totalPostings']; ?>
</a></h1>
	<?php  $_from = $this->_tpl_vars['listingsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['listingInfo']):
        $this->_foreach['outer']['iteration']++;
?>
		<?php  $this->assign('totalPostings', ($this->_tpl_vars['listingInfo']['total']['count']+$this->_tpl_vars['totalPostings'])); ?>
	<?php  endforeach; endif; unset($_from); ?>
	
	<?php  $_from = $this->_tpl_vars['listingsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['listingInfo']):
        $this->_foreach['outer']['iteration']++;
?>
		<?php  if ($this->_tpl_vars['listingInfo']['approveInfo'] != ''): ?>
			<?php  if ($this->_tpl_vars['listingInfo']['approveInfo']['pending'] != ''): ?>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?action=search&amp;listing_type%5Bequal%5D=<?php  echo $this->_tpl_vars['listingInfo']['approveInfo']['listing_type_id']; ?>
&amp;status%5Bequal%5D=pending"><strong>Waiting for approval: <?php  echo $this->_tpl_vars['listingInfo']['approveInfo']['pending']; ?>
</strong></a>
			<?php  else: ?>
					<strong>Waiting for approval: 0</strong>
			<?php  endif; ?>
		<?php  endif; ?>
		<table width="100%">
			<thead>
				<tr class="headrow">
					<th>
						<?php  echo $this->_tpl_vars['key']; ?>
<br/>
						<?php  if ($this->_tpl_vars['totalFlagsNum'][$this->_tpl_vars['key']] > 0): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flagged-listings/?listing_type_id=<?php  echo $this->_tpl_vars['key']; ?>
"><strong>Flagged: <?php  echo $this->_tpl_vars['totalFlagsNum'][$this->_tpl_vars['key']]; ?>
</strong></a><?php  endif; ?>
					</th>
					<th>Active</th>
					<th>Not active</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_from = $this->_tpl_vars['listingInfo']['periods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['period'] => $this->_tpl_vars['listingType']):
?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
					<td><?php  echo $this->_tpl_vars['period']; ?>
</td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?active[equal]=1&amp;listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;activation_date[not_less]=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><b><?php  echo $this->_tpl_vars['listingType']['active']; ?>
</b></a></td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?active[equal]=0&amp;listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;activation_date[not_less]=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><b><?php  echo $this->_tpl_vars['listingType']['count']-$this->_tpl_vars['listingType']['active']; ?>
</b></a></td>
					<td align="center"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;activation_date[not_less]=<?php  if ($this->_tpl_vars['period'] == 'Today'):   echo $this->_tpl_vars['today'];   endif;   if ($this->_tpl_vars['period'] == 'This Week'):   echo $this->_tpl_vars['weekAgo'];   endif;   if ($this->_tpl_vars['period'] == 'This Month'):   echo $this->_tpl_vars['monthAgo'];   endif; ?>"><b><?php  echo $this->_tpl_vars['listingType']['count']; ?>
</b></a></td>
				</tr>
				<?php  endforeach; endif; unset($_from); ?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
">
					<td><strong>Totals</strong></td>
					<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=1"><?php  echo $this->_tpl_vars['listingInfo']['total']['active']; ?>
</a></strong></td>
					<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search&amp;active%5Bequal%5D=0"><?php  echo $this->_tpl_vars['listingInfo']['total']['count']-$this->_tpl_vars['listingInfo']['total']['active']; ?>
</a></strong></td>
					<td align="center"><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?listing_type[equal]=<?php  echo $this->_tpl_vars['key']; ?>
&amp;action=search"><?php  echo $this->_tpl_vars['listingInfo']['total']['count']; ?>
</a></strong></td>
				</tr>
			</tbody>
		</table>
	<br/>
	<?php  endforeach; endif; unset($_from); ?>
</div>

<div class="clr"><br/></div>

<div class="dashboardBlocks">
	<h1 class="quickLinks">Quick links</h1>
	<table width="100%">
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="http://www.smartjobboard.com/wiki/" target="_blank"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User Manual<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/upload-logo/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload your logo<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing-field/edit-list/?field_sid=198"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit job categories list<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing-field/edit-list/?field_sid=214"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit countries list<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=main&amp;template_name=main.tpl"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Home page template<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=main&amp;template_name=index.tpl"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit all pages template<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-css/?action=edit&amp;file=<?php  echo $this->_tpl_vars['file']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit CSS file<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-css/?action=edit&amp;file=../templates/_system/main/images/css/form.css"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Forms CSS file<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
		</tr>	
	</table>
</div>

<br />