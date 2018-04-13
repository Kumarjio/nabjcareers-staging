<?php  /* Smarty version 2.6.14, created on 2018-02-08 15:50:05
         compiled from print_invoice_user.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'print_invoice_user.tpl', 38, false),array('modifier', 'date_format', 'print_invoice_user.tpl', 42, false),)), $this); ?>
<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['id'] == $this->_tpl_vars['payment_info']['user_sid']): ?>
<div style="padding: 5px;">
	<span class="buttonsinvoice"><a class="abuttonsinvoice" href="" onclick="window.print()">Print Invoice</a></span>
	
	<?php  if ($this->_tpl_vars['payment_info']['callback_data'] == 'featured'): ?>
		 <p style="display: none;"><iframe width="1" height="1" src="<?php  echo $this->_tpl_vars['payment_info']['success_page_url']; ?>
"></iframe></p>
			<?php  elseif ($this->_tpl_vars['payment_info']['callback_data'] == 'priority'): ?>
		<p style="display: none;"><iframe width="1" height="1" src="<?php  echo $this->_tpl_vars['payment_info']['success_page_url']; ?>
"></iframe></p>
			<?php  endif; ?>

</div>
<div class="clr"><br/></div>
<table width="99%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#999999" style="margin:8px; border:1px; width:99%">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="6" align="center" bgcolor="#ffffff" >
				<tr>
					<td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr valign="top" class="bodytext2">
								<td>
									<span class="bodytext3"><strong><?php  echo $this->_tpl_vars['GLOBALS']['settings']['company_name']; ?>
</strong></span><br>
									<?php  echo $this->_tpl_vars['GLOBALS']['settings']['address']; ?>
<br>
									<?php  echo $this->_tpl_vars['GLOBALS']['settings']['city']; ?>
, <?php  echo $this->_tpl_vars['GLOBALS']['settings']['state']; ?>
 <?php  echo $this->_tpl_vars['GLOBALS']['settings']['postal_code']; ?>
<br>
									USA<br>
								</td>
								<td align="right" width="220">
									<table width="220" border="0" cellspacing="0" cellpadding="0">
										<tr align="center">
											<td><span class="bodytext4"><strong>Invoice</strong></span></td>
										</tr>
									</table>
									<br>
									<table width="200" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000;">
										<tr class="bodytext2">
											<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
											<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Invoice<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>#</th>
										</tr>
										<tr align="center" class="bodytext2">
												<td><?php  echo ((is_array($_tmp=$this->_tpl_vars['payment_info']['creation_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d %Y") : smarty_modifier_date_format($_tmp, "%B %d %Y")); ?>
</td>
											<td><?php  echo $this->_tpl_vars['payment_info']['sid']; ?>
</td>
										</tr>
									</table>
									<br>
								</td>
							</tr>
						</table>

						<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000;">
							<tr class="bodytext2"><th width="50%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Bill To<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th><th width="50%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Payment To<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th></tr>
							<tr class="bodytext2" align="center">
								<td>
									<?php  echo $this->_tpl_vars['user_info']['billingFirstName']; ?>
<br>
									<?php  echo $this->_tpl_vars['user_info']['billingCompany']; ?>
<br>
									<?php  echo $this->_tpl_vars['user_info']['billingAddress']; ?>
<br>
									<?php  echo $this->_tpl_vars['user_info']['billingCity'];   if ($this->_tpl_vars['user_info']['billingState'] != "No State-Outside of the US"): ?>, <?php  echo $this->_tpl_vars['user_info']['billingState'];   endif; ?> <?php  echo $this->_tpl_vars['user_info']['billingZip']; ?>
<br>
								</td>
								<td>
									<?php  echo $this->_tpl_vars['GLOBALS']['settings']['company_name']; ?>
<br>
									<?php  echo $this->_tpl_vars['GLOBALS']['settings']['address']; ?>
<br>
									<?php  echo $this->_tpl_vars['GLOBALS']['settings']['city']; ?>
, <?php  echo $this->_tpl_vars['GLOBALS']['settings']['state']; ?>
 <?php  echo $this->_tpl_vars['GLOBALS']['settings']['postal_code']; ?>
<br>
									Phone: <?php  echo $this->_tpl_vars['GLOBALS']['settings']['phone']; ?>
<br>
																	</td>
							</tr>
						</table>

						<br><br>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border:1px solid #000;">
							<tr class="bodytext2" height="50">
								<th>Description</th><th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th><th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Amount<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
							</tr>
							<tr valign="top" class="bodytext2" height="540">
								<td width="50%">
									<?php  echo $this->_tpl_vars['payment_info']['name']; ?>

									<?php  if ($this->_tpl_vars['priority_listing_info']):   echo $this->_tpl_vars['priority_listing_info']['Title'];   endif; ?>
									<?php  if ($this->_tpl_vars['featured_listing_info']):   echo $this->_tpl_vars['featured_listing_info']['Title'];   endif; ?>
									<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing']):
?><p>
										<?php  echo $this->_tpl_vars['listing']['Title']; ?>

										<?php  if ($this->_tpl_vars['listing']['featured'] && $this->_tpl_vars['listing']['priority']): ?> (featured and priority)<?php  endif; ?>
										<?php  if (! $this->_tpl_vars['listing']['featured'] && $this->_tpl_vars['listing']['priority']): ?> (priority)<?php  endif; ?>
										<?php  if ($this->_tpl_vars['listing']['featured'] && ! $this->_tpl_vars['listing']['priority']): ?> (featured)<?php  endif; ?>
													<br><?php  if ($this->_tpl_vars['listing']['duration']): ?> Duration: <?php  echo $this->_tpl_vars['listing']['duration']; ?>
 days<?php  endif; ?>
										<br><br>
									<?php  endforeach; endif; unset($_from); ?>
								</td>
								<td align="center">
										<?php  if ($this->_tpl_vars['listing']['activation_date']):   echo ((is_array($_tmp=$this->_tpl_vars['listing']['activation_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d %Y") : smarty_modifier_date_format($_tmp, "%B %d %Y"));   else:   echo ((is_array($_tmp=$this->_tpl_vars['payment_info']['creation_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d %Y") : smarty_modifier_date_format($_tmp, "%B %d %Y"));   endif; ?><br>
								</td>
								<td align="center"><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo $this->_tpl_vars['payment_info']['price']; ?>
</td>
							</tr>
							<tr class="bodytext2" height="50">
								<td colspan="2">Please Make Checks Payable to <?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</td>
								<td align="center" class="bodytext2"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo $this->_tpl_vars['payment_info']['price']; ?>
</strong></td>
							</tr>
						</table>
					</td>
				</tr>
							</table>
		</td>
	</tr>
</table>

<?php  else: ?>
<p>Access denied </p>
<?php  endif; ?>