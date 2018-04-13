<?php  /* Smarty version 2.6.14, created on 2017-06-24 09:14:11
         compiled from manage_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', 'manage_listing.tpl', 9, false),array('modifier', 'cat', 'manage_listing.tpl', 60, false),array('block', 'tr', 'manage_listing.tpl', 19, false),array('function', 'module', 'manage_listing.tpl', 63, false),)), $this); ?>

<h1>Preview Job</h1>

<p>Please review your job posting. <br />
If you find an error, click on the <b>"Edit this Job"</b> button below and make any necessary changes. 
When finished adding all jobs, please click the <b>"Activate Jobs"</b> button below. 
</p>

<?php  if ($this->_tpl_vars['waitApprove'] == 1): ?><p>Your <?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['type']['id'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)); ?>
 posting is successfully created and waiting for approval</p><?php  endif; ?>
<?php  if ($this->_tpl_vars['errors'] == null): ?>
<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
	<?php  $this->assign('link', 'my-job-details'); ?>
<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>
	<?php  $this->assign('link', 'my-resume-details'); ?>
<?php  endif; ?>

<?php  if (! $this->_tpl_vars['listing']['active'] && $this->_tpl_vars['listing']['package']['price'] != 0): ?>
	<div id="job_actions_btn">
	<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add another job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/new-listings-activate/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
	
		<p><?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "display_job.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
	<script type="text/javascript">
		<?php  echo '
		document.getElementById("listingsResults").style.marginRight = "-8px";
		'; ?>

	</script>
		
	
	<?php  endif; ?>
	

		
	
<?php  else: ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_message']):
?>
		<?php  if ($this->_tpl_vars['error'] == 'PARAMETERS_MISSED'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The key parameters are not specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  elseif ($this->_tpl_vars['error'] == 'WRONG_PARAMETERS_SPECIFIED'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Wrong parameters are specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  elseif ($this->_tpl_vars['error'] == 'NOT_OWNER'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are not owner of this listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  elseif ($this->_tpl_vars['error'] == 'NOT_LOGGED_IN'): ?>
		<?php  $this->assign('url', ((is_array($_tmp=$this->_tpl_vars['GLOBALS']['site_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/registration/") : smarty_modifier_cat($_tmp, "/registration/"))); ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please log in to access this page. If you do not have an account, please<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['url']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
		<br/><br/>
		<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login'), $this);?>

		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
<?php  endif; ?>

<br /><br />
<p><b>Posting length: </b><?php  echo $this->_tpl_vars['listing']['package']['listing_lifetime']; ?>
 days</p>
	<p><b>Featured: </b><?php  if ($this->_tpl_vars['listing']['featured'] == 1): ?> yes <?php  else: ?>no<?php  endif; ?></p>
	<p><b>Priority: </b><?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?> yes <?php  else: ?>no<?php  endif; ?></p>
	
	