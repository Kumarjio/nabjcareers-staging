<?php  /* Smarty version 2.6.14, created on 2018-03-09 13:58:08
         compiled from configure_gateway.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'configure_gateway.tpl', 1, false),array('function', 'cycle', 'configure_gateway.tpl', 39, false),array('function', 'input', 'configure_gateway.tpl', 41, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/gateways/">Payment Gateways</a> &#187; <?php  echo $this->_tpl_vars['gateway']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Configure <?php  echo $this->_tpl_vars['gateway']['caption']; ?>
</h1>
<p>
	<?php  if ($this->_tpl_vars['gateway']): ?>
		<?php  if ($this->_tpl_vars['gateway']['active']): ?>
			This gateway is currently active. Click here to <a href="?action=deactivate&gateway=<?php  echo $this->_tpl_vars['gateway']['id']; ?>
">deactivate</a> it.
		<?php  else: ?>
			This gateway is currently inactive. Click here to <a href="?action=activate&gateway=<?php  echo $this->_tpl_vars['gateway']['id']; ?>
">activate</a> it.
		<?php  endif; ?>
	<?php  endif; ?>
</p>
<?php  if ($this->_tpl_vars['gateway']['template']): ?>
	<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=payment&template_name=<?php  echo $this->_tpl_vars['gateway']['template']; ?>
">Edit the instructions page</a></p>
<?php  endif; ?>
<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_data']):
?>
	<?php  if ($this->_tpl_vars['error'] == 'NOT_IMPLEMENTED'): ?><p class="error">There is something not yet implmeneted in the system</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'API_LOGIN_ID_IS_NOT_SET'): ?><p class="error">API Login ID is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'TRANSACTION_KEY_IS_NOT_SET'): ?><p class="error">Transaction Key is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'MD5_HASH_IS_NOT_SET'): ?><p class="error">MD5-Hash is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'CURRENCY_CODE_IS_NOT_SET'): ?><p class="error">Currency Code is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'GATEWAY_NOT_FOUND'): ?><p class="error">Gateway not found</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'PAYMENT_ID_IS_NOT_SET'): ?><p class="error">Payment ID is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'NONEXISTED_PAYMENT_ID_SPECIFIED'): ?><p class="error">Specified payment ID does not exist</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'PAYMENT_IS_NOT_PENDING'): ?><p class="error">Payment status is not pending</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'EMAIL_IS_NOT_SET'): ?><p class="error">Email address is not set</p><?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'NOT_VERIFIED'): ?><p class="error">Payment procedure is not verified</p><?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>

<?php  if ($this->_tpl_vars['form_fields']): ?>
	<form method=post>
		<table>
			<thead>
				<tr>
					<th>Parameter</th>
					<th>Current Value</th>
				</tr>
			</thead>
			<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id'] => $this->_tpl_vars['field_info']):
?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
					<td valign=top><?php  echo $this->_tpl_vars['field_info']['caption']; ?>
</td>
					<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['field_id']), $this);?>
</td>
				</tr>
			<?php  endforeach; endif; unset($_from); ?>
			<tr id="clearTable">
				<td colspan="2">
					<input type="hidden" name="gateway" value="<?php  echo $this->_tpl_vars['gateway']['id']; ?>
" />
					<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
				</td>
			</tr>
		</table>
	</form>
<?php  endif; ?>


<?php  if ($this->_tpl_vars['params'] == "gateway=2checkout"): ?>
<span style="font-size: 12px;">
	To set up recurring billing in 2Checkout you need to do the following:<br/>
	<strong>1)</strong> Set an email address in 2Checkout for subscription notifications to be sent to (you'll need to do this only once);<br/>
	<strong>2)</strong> Add a new product to 2Checkout<br/>
	<strong>3)</strong> Link 2Checkout product with a recurring Membership plan (you'll need to do this after creating a new Membership Plan).<br/>
	<br/>
	Please see the detailed description below:<br/>
	<strong>1)</strong> Setting an email address to receive notifications:<br/>
	&nbsp; &nbsp; <strong>a)</strong> Log in to your Admin Vendor area in 2Checkout;<br/>
	&nbsp; &nbsp; <strong>b)</strong> Go to Notification &#187; Settings section;<br/>
	&nbsp; &nbsp; <strong>c)</strong> Enter the following URL to the Global URL field: <?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/notifications/2checkout/<br/>
	&nbsp; &nbsp; <strong>d)</strong> Press the Apply button.<br/>
	<br/>
	<strong>2)</strong> Adding a new product in 2Checkout and getting its ID:<br/>
	&nbsp; &nbsp; <strong>a)</strong> Log in to your Admin Vendor area in 2Checkout;<br/>
	&nbsp; &nbsp; <strong>b)</strong> Go to Products &#187; Create section;<br/>
	&nbsp; &nbsp; <strong>c)</strong> You will see Product adding form displayed, where you need to fill in the following fields:
	<ul>
	    <li>Name - any desired name;</li>
	    <li>Your Product ID - enter any desired ID;</li>
	    <li>Short Description - optional field;</li>
	    <li>Long Description - optional field;</li>
	    <li>Price - enter the desired amount. The same amount you'll need to enter in the 'Subscription Price' field of your recurring Membership Plan in SmartJobBoard;</li>
	    <li>Tangible - set No</li>
	    <li>Recurring - set Yes</li>
	    <li>Startup Fee - set to '0'</li>
	    <li>Bill Every - set the needed number of weeks/months or years (e.g. for twice a month - set '2 weeks'). The same period you need to enter in the 'Expiration Period' field of your recurring Membership Plan in SmartJobBoard;</li>
	    <li>Continue Billing For - set Forever;</li>
	    <li>Pending URL - you can leave field empty;</li>
	    <li>Approved URL - Use the following link: <?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/subscription/?subscriptionComplete=true</li>
	</ul>
	&nbsp; &nbsp; <strong>d)</strong> Once you completed filling in the form, go to Products &#187; View section;<br/>
	&nbsp; &nbsp; <strong>e)</strong> You will see a list of all products displayed, where you need to find the just created product. ID of the product will be displayed in the 2CO ID column (copy the ID).<br/>
	<br/>
	<strong>3)</strong> Linking a recurring Membership Plan and a 2Checkout product:<br/>
	&nbsp; &nbsp; <strong>a)</strong> Add a recurring Membership Plan in SmartJobBoard Admin Panel;<br/>
	&nbsp; &nbsp; <strong>b)</strong> Go to Admin Panel &#187; Payment Gateways &#187; 2Checkout (edit) where you will see the name of the Membership Plan you created;<br/>
	&nbsp; &nbsp; <strong>c)</strong> Opposite the Membership Plan name enter the ID of the product 2Checkout you created;<br/>
</span>
<?php  elseif ($this->_tpl_vars['params'] == "gateway=authnet_sim"): ?>
<span style="font-size: 12px;">
	To work with recurring billing in Authorize.Net you need to set the Silent Post URL. It is the URL where the subscription notifications will be sent.<br/>
	<br/>
	Silent Post URL description:<br/>
	The Silent Post URL is a location on your Web server where the payment gateway can "carbon copy" the transaction response. This allows you to use transaction response information for other purposes separately without affecting the amount of time it takes to respond to the payment gateway with a custom receipt page from the Relay Response URL.<br/>
	<br/>
	To configure the Silent Post URL:<br/>
	<strong>1)</strong> Log on to the Merchant Interface at https://account.authorize.net<br/>
	<strong>2)</strong> Click Settings under Account in the main menu on the left<br/>
	<strong>3)</strong> Click Silent Post URL in the Transaction Format Settings section<br/>
	<strong>4)</strong> Enter the secondary URL to which you would like the payment gateway to copy the transaction response http://YourSiteURL/system/payment/notifications/authnet_sim/<br/>
	<strong>5)</strong> Click Submit<br/>
	<strong>6)</strong> Go to Settings &#187; API Login ID and Transaction Key. There you will get the 'Current API Login ID' and the 'Current Transaction Key' (copy them).<br/>
	<strong>7)</strong> Also go to Settings &#187; MD5-Hash. And enter any descired value for the MD5-Hash. (copy it).<br/>
	<strong>8)</strong> Then you need to go to your SmartJobBoard Admin Panel &#187; Payments &#187; Authorize.Net SIM (edit) and specify there the API Login ID, Transaction Key and MD5-Hash.<br/>
</span>
<?php  endif; ?>