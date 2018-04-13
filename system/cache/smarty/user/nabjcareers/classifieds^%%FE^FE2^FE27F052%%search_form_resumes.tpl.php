<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:36:15
         compiled from search_form_resumes.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'search_form_resumes.tpl', 1, false),array('function', 'search', 'search_form_resumes.tpl', 15, false),array('function', 'module', 'search_form_resumes.tpl', 82, false),)), $this); ?>
<?php  if ($this->_tpl_vars['id_saved']): ?><h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Saved Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1><?php  else: ?><h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1><?php  endif;   if ($this->_tpl_vars['id_saved']): ?>
	<form action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/" method="get"  id="search_form">
		<input type="hidden" name="action" value="<?php  echo $this->_tpl_vars['action']; ?>
" />
		<input type="hidden" name="id_saved" value="<?php  echo $this->_tpl_vars['id_saved']; ?>
" />
<?php  else: ?>
	<form action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-resumes/"  id="search_form">
	<input type="hidden" name="action" value="search" />
<?php  endif; ?>
<input type="hidden" name="listing_type[equal]" value="Resume" />
	<div id="adMargin">
		<?php  if ($this->_tpl_vars['id_saved']): ?>
			<fieldset>
				<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'name','template' => 'string.tpl'), $this);?>
</div>
			</fieldset>
		<?php  endif; ?>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keywords<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'keywords','type' => 'bool','listingType' => 'Resume'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['JobCategory']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['JobCategory']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'JobCategory'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['Occupations']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['Occupations']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'Occupations'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['JobType']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['JobType']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'JobType'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Within<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'ZipCode'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['Country']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['Country']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField" id="country_block"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'Country'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['State']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['State']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField" id="state_block"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'State'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['City']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['City']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'City','template' => "string.like.tpl"), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_fields']['DesiredSalary']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_fields']['DesiredSalary']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'DesiredSalary'), $this);?>
<br/><br/><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'DesiredSalaryType'), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_PostedWithin')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted Within<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'PostedWithin','template' => "list.date.tpl"), $this);?>
</div>
		</fieldset>
		<fieldset>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Institution Name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'InstitutionName','complexParent' => 'Education','template' => 'string.like.tpl'), $this);?>
</div>
		</fieldset>
				
		<?php  if ($this->_tpl_vars['jobfairs']): ?>
			<br />
			<div class="jobfairsBlockTitle"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select attendees of these Job Fairs Only:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
			<br />
		
			<div id="jobfairsTableContainer">
				<?php  $_from = $this->_tpl_vars['jobfairs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['jobfairs_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['jobfairs_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['jobfair']):
        $this->_foreach['jobfairs_block']['iteration']++;
?>
					<?php  if ($this->_tpl_vars['jobfair']['visible_emp']): ?>
						<fieldset class="jobfairs_container_search">
							<div class="inputNameJobFair_search"><?php  echo $this->_tpl_vars['jobfair']['caption']; ?>
</div>
							<div class="inputFieldjobfairsSearch"><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => $this->_tpl_vars['jobfair']['fieldid'],'complexParent' => 'JobFairs','template' => 'boolean.tpl'), $this);?>
</div>
						</fieldset>
					<?php  endif; ?>
				<?php  endforeach; endif; unset($_from); ?>
			</div>
		<?php  endif; ?>
		
		
				<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'linkedin_people_search','profileSID' => $this->_tpl_vars['listing']['user']['id']), $this);?>

				<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField">
				<?php  if ($this->_tpl_vars['id_saved']): ?>
					<input class="button" type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="search_button" />
				<?php  else: ?>
					<input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" id="search_button" />
				<?php  endif; ?>
			</div>
		</fieldset>
	</div>
</form>
<div id="adSpace"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'static_content','function' => 'show_static_content','pageid' => 'SearchResumesAdSpace'), $this);?>
</div>

<script type="text/javascript">
	<?php  echo '
		if ($("#country_block > select option:selected").val() == "United States" ) 
		{
			$ ("#state_block").closest("fieldset").css({\'display\':\'block\'});
		}
		else 
		{
			$("#state_block").closest("fieldset").css({\'display\':\'none\'});
		}
		
		$("#country_block > select").bind("click", function (e) 
			{	
				if ( $("#country_block > select option:selected").val() == "United States" ) 
				{
					$("#state_block").closest("fieldset").css({\'display\':\'block\'});
				}
				else 
				{
					$("#state_block").closest("fieldset").css({\'display\':\'none\'});	
					$("#state_block").children().val(\'Outside The US (No State)\');
				}
				
			}
			
		);
		
	'; ?>

	
	<?php  echo '
		$obj=$("#jobfairsTableContainer fieldset").html();
		if (!$obj) {
			$(".jobfairsBlockTitle").css({\'display\':\'none\'});
		}
		
		else {
			$(".jobfairsBlockTitle").css({\'display\':\'block\'});
		}	
	'; ?>

	
</script>