<?php  /* Smarty version 2.6.14, created on 2018-02-08 15:50:04
         compiled from cash_gateway.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'cash_gateway.tpl', 6, false),array('modifier', 'regex_replace', 'cash_gateway.tpl', 17, false),)), $this); ?>
<?php  $this->assign('username', $this->_tpl_vars['user']['CompanyName']); ?>

<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['message']):
?>
	<p class="error">
    	<?php  if ($this->_tpl_vars['error'] == 'INVALID_PAYMENT_ID'): ?>
    		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Invalid payment ID is specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
       	<?php  elseif ($this->_tpl_vars['error'] == 'ALREADY_OPENED_INVOICE'): ?>
    		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The payment has been already invoiced<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    		
    	<?php  else: ?>
    		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['error'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['message'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    	<?php  endif; ?>
	</p>
<?php  endforeach; else: ?>
<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
Dear <?php  echo $this->_tpl_vars['username']; ?>
, <br /><br />
Please send us a payment in the amount of <?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency']; ?>
 <?php  echo $this->_tpl_vars['amount']; ?>
 for<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo ((is_array($_tmp=$this->_tpl_vars['item_name'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/(Payment for)/", ' ') : smarty_modifier_regex_replace($_tmp, "/(Payment for)/", ' ')); ?>
<br />

<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your transaction reference number is $payment_id. <br /><br />

Thank you!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  endif; unset($_from); ?>


<p><iframe width="720" height="300" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/print-invoice/?payment_id=<?php  echo $this->_tpl_vars['payment_id']; ?>
&send_email=1"></iframe></p>

<p><span class="buttonsinvoice"><a class="abuttonsinvoice" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-account/">My account</a></span></p>
<?php  if ($this->_tpl_vars['plan_id'] == 33 || $this->_tpl_vars['plan_id'] == 37 || $this->_tpl_vars['plan_id'] == 39 || $this->_tpl_vars['plan_id'] == 40): ?>
</p><span class="buttonsinvoice"><a class="abuttonsinvoice" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/">Search resumes</a></span></p>
<?php  endif; ?>