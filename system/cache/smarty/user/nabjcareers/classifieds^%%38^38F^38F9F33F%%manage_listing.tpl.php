<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:57:56
         compiled from manage_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', 'manage_listing.tpl', 9, false),array('modifier', 'cat', 'manage_listing.tpl', 106, false),array('block', 'tr', 'manage_listing.tpl', 19, false),array('function', 'module', 'manage_listing.tpl', 109, false),)), $this); ?>
<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
	<h1>Preview Job</h1>
	<?php  if ($this->_tpl_vars['previous_page'] != 'edit_job'): ?>
		<p>Please review your job posting. <br />If you find an error, click on the 
		<b>"Edit this Job"</b> button below and make any necessary changes. When finished, please click the 
		<b>"Activate Jobs"</b> button below to proceed to the payment screen. </p>
	<?php  endif; ?>
	<?php  if ($this->_tpl_vars['waitApprove'] == 1): ?>	
		<p>Your <?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['type']['id'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)); ?>
 posting is successfully created and waiting for approval</p>
	<?php  endif; ?>

	<?php  if ($this->_tpl_vars['errors'] == null): ?>
	
		<?php  if ($this->_tpl_vars['previous_page'] == 'edit_job'): ?>
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
				<?php  $this->assign('link', 'my-job-details'); ?>
			<?php  endif; ?>		
			<p>
				<a class="twoabuttons" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Finished<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<a class="twoabuttons" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			</p>
		<div class="clear"></div>	
			<p class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your job has successfully been updated<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			
			<p>Please review your job update below. <br />If you find an error please edit this posting 
			by clicking on the 'Edit Job' button.</p>
			<p>[<a class="orange" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/">Click here to manage your jobs</a>]</p>
				<!--- LISTING INFO BLOCK --->
				<div>
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Category<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  echo $this->_tpl_vars['listing']['JobCategory']; ?>
</div>
					
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</div>
					
					
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Reference<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['id'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['id'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
					
					<?php  if ($this->_tpl_vars['listing']['JobDescription']): ?>
						<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong>
						<?php  echo $this->_tpl_vars['listing']['JobDescription']; ?>
</div>
						<div class="clr"></div>
					<?php  endif; ?>
					
					<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
						<?php  if ($this->_tpl_vars['listing']['JobRequirements']): ?>
							<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Requirements<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong> 
							<?php  echo $this->_tpl_vars['listing']['JobRequirements']; ?>
</div>
							<div class="clr"></div>
						<?php  endif; ?>
					<?php  endif; ?>
					
					<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
						<?php  if ($this->_tpl_vars['listing']['Occupations']): ?>
							<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Occupations<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong> 
							<?php  echo $this->_tpl_vars['listing']['Occupations']; ?>
</div>
							<div class="clr"><br/></div>
						<?php  endif; ?>
					<?php  endif; ?>
					
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Location<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong> 
						<?php  if ($this->_tpl_vars['listing']['City']):   echo $this->_tpl_vars['listing']['City']; ?>
, <?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing']['State'] != 'Outside The US (No State)'):   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>, <?php  endif; ?>
						<?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_Country')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</div>
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Zip Code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  echo $this->_tpl_vars['listing']['ZipCode']; ?>
</div>				
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Employment Type<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  echo $this->_tpl_vars['listing']['EmploymentType']; ?>
</div>
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Salary<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  echo $this->_tpl_vars['listing']['Salary']['value']; ?>
 <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['SalaryType'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['SalaryType'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
					<div class=""><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </strong><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
					<div class="clr"><br/></div>
				</div>
				<!--- END LISTING INFO BLOCK --->
			<div class="clr"><br/></div>
			<p>[<a class="orange" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/">Click here to manage your jobs</a>]</p>
		<?php  else: ?>
		
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
				<?php  $this->assign('link', 'my-job-details'); ?>
			<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>
				<?php  $this->assign('link', 'my-resume-details'); ?>
			<?php  endif; ?>
			
			<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add another job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-job-preview/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job' && ! $this->_tpl_vars['listing']['active']): ?>
				<a class="abutton" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/new-listings-activate/?action_activate=1&listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1&new_listings=1&new_listing=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<?php  endif; ?>
			
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
				<p>
					<iframe src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-job/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" style="border: 0; height: 300px; width: 100%;">
					</iframe>
				</p>
				<script type="text/javascript">
					<?php  echo 'document.getElementById("listingsResults").style.marginRight = "-8px";	'; ?>
	
				</script>
			<?php  endif; ?>
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
	<?php  endif;   endif; ?>



<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>

	<h1>Preview Resume</h1>

	<p>Please review your resume posting. <br />If you find an error, click on the <b>"Edit this Resume"</b> 
	button below and make any necessary changes. When finished, please click the <b>"Activate Resume"</b> 
	button below to proceed to the payment screen. </p>
	
	<?php  if ($this->_tpl_vars['waitApprove'] == 1): ?>
		<p>Your <?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['type']['id'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)); ?>
 posting is successfully created and waiting for approval</p>
	<?php  endif; ?>

	<?php  if ($this->_tpl_vars['errors'] == null): ?>
		<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>	
			<?php  $this->assign('link', 'my-job-details'); ?>
		<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>	
			<?php  $this->assign('link', 'my-resume-details'); ?>
		<?php  endif; ?>

		<a class="resbutton" style="margin: 0 160px;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<a class="resbutton" style="margin: 0 160px;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-account/?page=1"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activate Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		
			<div class="clr"><br></div>
				<p><iframe src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-resume/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" style="border: 0; height: 300px; width: 100%;"></iframe></p>
				
			<script type="text/javascript">		
				<?php  echo '	document.getElementById("listingsResults").style.marginRight = "-8px";'; ?>
	
			</script>						
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
					<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please log in to access this page. If you do not have an account, please<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					 <a href="<?php  echo $this->_tpl_vars['url']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>		
					 <br/><br/>		
					<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login'), $this);?>
		
				<?php  endif; ?>	
		<?php  endforeach; endif; unset($_from); ?>
		
	<?php  endif;   endif; ?>
	