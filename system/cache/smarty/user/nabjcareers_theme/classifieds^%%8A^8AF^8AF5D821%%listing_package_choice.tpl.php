<?php  /* Smarty version 2.6.14, created on 2018-03-04 12:45:08
         compiled from listing_package_choice.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'listing_package_choice.tpl', 3, false),)), $this); ?>
<script type="text/javascript">
<!--
	var listingPackageChoiceErrorMessage = '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select a Package<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>';
	<?php  echo '
	$(document).ready(function() {
		$("#listing-package-choice-form").validate({
			rules: {
				listing_package_id: "required"
			},
			errorLabelContainer: "#listing-package-choice-message",
			errorClass: "error",
			errorElement: "p",
			messages: {
				listing_package_id: listingPackageChoiceErrorMessage
			}
		});
	});
	'; ?>

//-->
</script>

<div id="plans_containers">


<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select a Package<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<?php  if (empty ( $this->_tpl_vars['addListingPackageChoiceTpl'] )): ?>

<form name="checkform" id="listing-package-choice-form" method="post" action="" onsubmit="return planSubmit();">
<?php  endif; ?>
	<?php  $_from = $this->_tpl_vars['listing_packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listing_packages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listing_packages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['contract_id'] => $this->_tpl_vars['listing_packages']):
        $this->_foreach['listing_packages']['iteration']++;
?>
		<p>
			<b><?php  echo $this->_tpl_vars['listing_packages']['membership_plan_name']; ?>
</b>
			<?php  $_from = $this->_tpl_vars['listing_packages']['packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_package']):
?>
				
				
						<p id="<?php  echo $this->_tpl_vars['listing_package']['id']; ?>
_<?php  echo $this->_tpl_vars['contract_id']; ?>
" class="hide_<?php  echo $this->_tpl_vars['listing_package']['id']; ?>
">
					<input id="<?php  echo $this->_tpl_vars['listing_package']['id']; ?>
_inp" type="radio" class="packs_list" value="<?php  echo $this->_tpl_vars['listing_package']['id']; ?>
_<?php  echo $this->_tpl_vars['contract_id']; ?>
" <?php  if ($this->_tpl_vars['listing']['package']['id'] == $this->_tpl_vars['listing_package']['id']): ?>checked<?php  endif; ?>  onclick="planChosen = true; planSelectionCheck(); planSelectionRemember = this.id;" name="listing_package_id" /> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing_package']['name'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing_package']['name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
									
					<br /><?php  if (! $this->_tpl_vars['GLOBALS']['settings']['ecommerce']):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Free of charge<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing_package']['description'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing_package']['description'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
					
				</p>
			<?php  endforeach; endif; unset($_from); ?>
		</p>
	 	<?php  endforeach; endif; unset($_from); ?>
	  
	  
	<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job posting options<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>


<fieldset>
<div class="inputField"><input type="checkbox" name="featured_checkbox" id="featured_checkbox" onClick="checker(); reselectPlan();" /> Make Job a Featured listing <?php  if ($this->_tpl_vars['GLOBALS']['settings']['ecommerce']): ?>(+<?php  echo $this->_tpl_vars['listing_package']['featured_price']; ?>
$)<?php  endif; ?></div>
<div class="instruction">
	<div class="instr_icon" onmouseover="javascript:$(this).next('.instr_block').show();" onmouseout="javascript:$(this).next('.instr_block').hide();"></div>

    <div class="instr_block" id="instruction_Occupations">
		<div class="instr_arrow"></div>
		<div class="instr_cont">
			<p>"Featured Jobs" are highlighted in a special area of NabjCareers' Homepage."</p>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>

    <div class="clr"></div>
</div>
</fieldset>

<fieldset>
<div class="inputField"><input type="checkbox" name="priority_checkbox" id="priority_checkbox" onClick="checker(); reselectPlan();"  /> Make Job a Priority listing <?php  if ($this->_tpl_vars['GLOBALS']['settings']['ecommerce']): ?>(+<?php  echo $this->_tpl_vars['listing_package']['priority_price']; ?>
$)<?php  endif; ?></div>
<div class="instruction">
	<div class="instr_icon" onmouseover="javascript:$(this).next('.instr_block').show();" onmouseout="javascript:$(this).next('.instr_block').hide();"></div>

    <div class="instr_block" id="instruction_Occupations">
		<div class="instr_arrow"></div>
		<div class="instr_cont">
			<p>"Priority Listings: are displayed above average search results and are marked with a different color."</p>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>

    <div class="clr"></div>
</div>
</fieldset>

	<?php  if ($this->_tpl_vars['cloneJob']): ?><input type="hidden" name="tmp_listing_id" value="<?php  echo $this->_tpl_vars['tmp_listing_id']; ?>
" /><?php  endif; ?>
	
	<?php  if (empty ( $this->_tpl_vars['addListingPackageChoiceTpl'] )): ?>
	<input type="hidden" name="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
" />
	<input type="hidden" name="listing_type_id" value="<?php  echo $this->_tpl_vars['listing_type_id']; ?>
" />
	<input type="hidden" name="test_param" value="1111" />

	
	<div id="listing-package-choice-message"></div>
	<p><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next >><?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" /></p>
</form>
<?php  endif; ?>



 
<script language='JavaScript' type='text/javascript'> 

<?php  echo '
var planSelectionRemember = 0;
var selectedPlanId;

// in initial state we hide Fetured, Priority, F+Pr plans
$(".hide_43").css({"display" : "none"});
$(".hide_44").css({"display" : "none"});
$(".hide_45").css({"display" : "none"});

$(".hide_46").css({"display" : "none"});
$(".hide_47").css({"display" : "none"});
$(".hide_48").css({"display" : "none"});

$(".hide_49").css({"display" : "none"});
$(".hide_50").css({"display" : "none"});
$(".hide_51").css({"display" : "none"});

// plan "not used"
$(".hide_59").css({"display" : "none"});

function reselectPlan() {
	// checking checkbox corresponding to the preselected plan

	if(document.getElementById("priority_checkbox").checked && document.getElementById("featured_checkbox").checked) {		
//		BOTH 
		if (planSelectionRemember == \'40_inp\' || planSelectionRemember == \'43_inp\' || planSelectionRemember == \'46_inp\'  || planSelectionRemember == \'49_inp\') // 30
		{
			selectedPlanId = document.getElementById(\'49_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'49_inp\';
		}

		if (planSelectionRemember == \'41_inp\' || planSelectionRemember == \'44_inp\' || planSelectionRemember == \'47_inp\'  || planSelectionRemember == \'50_inp\') // 60
		{
			selectedPlanId = document.getElementById(\'50_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'50_inp\';
		}

		if (planSelectionRemember == \'42_inp\' || planSelectionRemember == \'45_inp\' || planSelectionRemember == \'48_inp\'  || planSelectionRemember == \'51_inp\') // 90
		{
			selectedPlanId = document.getElementById(\'51_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'51_inp\';
		}
	}
	
	else if(document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {		
	//		priority	 	
		if (planSelectionRemember == \'40_inp\' || planSelectionRemember == \'43_inp\' || planSelectionRemember == \'46_inp\'  || planSelectionRemember == \'49_inp\') // 30
		{
			selectedPlanId = document.getElementById(\'43_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'43_inp\';
		}
	
		if (planSelectionRemember == \'41_inp\' || planSelectionRemember == \'44_inp\' || planSelectionRemember == \'47_inp\'  || planSelectionRemember == \'50_inp\') // 60
		{
			selectedPlanId = document.getElementById(\'44_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'44_inp\';
		}
	
		if (planSelectionRemember == \'42_inp\' || planSelectionRemember == \'45_inp\' || planSelectionRemember == \'48_inp\'  || planSelectionRemember == \'51_inp\') // 90
		{
			selectedPlanId = document.getElementById(\'45_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'45_inp\';
		}
	}

	else if(!document.getElementById("priority_checkbox").checked && document.getElementById("featured_checkbox").checked) {		
		//		featured	 
		if (planSelectionRemember == \'40_inp\' || planSelectionRemember == \'43_inp\' || planSelectionRemember == \'46_inp\'  || planSelectionRemember == \'49_inp\') // 30
		{
			selectedPlanId = document.getElementById(\'46_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'46_inp\';
		}
	
		if (planSelectionRemember == \'41_inp\' || planSelectionRemember == \'44_inp\' || planSelectionRemember == \'47_inp\'  || planSelectionRemember == \'50_inp\') // 60
		{
			selectedPlanId = document.getElementById(\'47_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'47_inp\';
		}
	
		if (planSelectionRemember == \'42_inp\' || planSelectionRemember == \'45_inp\' || planSelectionRemember == \'48_inp\'  || planSelectionRemember == \'51_inp\') // 90
		{
			selectedPlanId = document.getElementById(\'48_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'48_inp\';
		}
	}

	else if(!document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {		
	//		NONE	 
		
		if (planSelectionRemember == \'40_inp\' || planSelectionRemember == \'43_inp\' || planSelectionRemember == \'46_inp\'  || planSelectionRemember == \'49_inp\') // 30
		{
			selectedPlanId = document.getElementById(\'40_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'40_inp\';
		}
	
		if (planSelectionRemember == \'41_inp\' || planSelectionRemember == \'44_inp\' || planSelectionRemember == \'47_inp\'  || planSelectionRemember == \'50_inp\') // 60
		{
			selectedPlanId = document.getElementById(\'41_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'41_inp\';
		}
	
		if (planSelectionRemember == \'42_inp\' || planSelectionRemember == \'45_inp\' || planSelectionRemember == \'48_inp\'  || planSelectionRemember == \'51_inp\') // 90
		{
			selectedPlanId = document.getElementById(\'42_inp\');
			selectedPlanId.checked = true;
			planSelectionRemember = \'42_inp\';
		}
	}
}

function checker(){
							
	// reset radio buttons
	 var inp_objs = document.getElementsByName(\'listing_package_id\');
	    for(i=0; i<inp_objs.length; i++) {
	    	inp_objs[i].checked = false;
	    	//planChosen = false;
	    }

	// show/hide Plans    
	if(document.getElementById("priority_checkbox").checked && document.getElementById("featured_checkbox").checked) {		
//	BOTH	
		
		$(".hide_40").css({"display" : "none"});
		$(".hide_41").css({"display" : "none"});
		$(".hide_42").css({"display" : "none"});
		
		$(".hide_43").css({"display" : "none"});
		$(".hide_44").css({"display" : "none"});
		$(".hide_45").css({"display" : "none"});

		$(".hide_46").css({"display" : "none"});
		$(".hide_47").css({"display" : "none"});
		$(".hide_48").css({"display" : "none"});

		$(".hide_49").css({"display" : "block"});
		$(".hide_50").css({"display" : "block"});
		$(".hide_51").css({"display" : "block"});


	}		
	else if (!document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {
//		 NONE
		
		$(".hide_40").css({"display" : "block"});
		$(".hide_41").css({"display" : "block"});
		$(".hide_42").css({"display" : "block"});
		
		$(".hide_43").css({"display" : "none"});
		$(".hide_44").css({"display" : "none"});
		$(".hide_45").css({"display" : "none"});

		$(".hide_46").css({"display" : "none"});
		$(".hide_47").css({"display" : "none"});
		$(".hide_48").css({"display" : "none"});

		$(".hide_49").css({"display" : "none"});
		$(".hide_50").css({"display" : "none"});
		$(".hide_51").css({"display" : "none"});
	}	
	else if (document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {
//		 PRIORITY	
		
		$(".hide_40").css({"display" : "none"});
		$(".hide_41").css({"display" : "none"});
		$(".hide_42").css({"display" : "none"});
		
		$(".hide_43").css({"display" : "block"});
		$(".hide_44").css({"display" : "block"});
		$(".hide_45").css({"display" : "block"});

		$(".hide_46").css({"display" : "none"});
		$(".hide_47").css({"display" : "none"});
		$(".hide_48").css({"display" : "none"});

		$(".hide_49").css({"display" : "none"});
		$(".hide_50").css({"display" : "none"});
		$(".hide_51").css({"display" : "none"});
	}	
		
	else if (!document.getElementById("priority_checkbox").checked && document.getElementById("featured_checkbox").checked) {
	//	 FEATURED
		
		$(".hide_40").css({"display" : "none"});
		$(".hide_41").css({"display" : "none"});
		$(".hide_42").css({"display" : "none"});
		
		$(".hide_43").css({"display" : "none"});
		$(".hide_44").css({"display" : "none"});
		$(".hide_45").css({"display" : "none"});

		$(".hide_46").css({"display" : "block"});
		$(".hide_47").css({"display" : "block"});
		$(".hide_48").css({"display" : "block"});

		$(".hide_49").css({"display" : "none"});
		$(".hide_50").css({"display" : "none"});
		$(".hide_51").css({"display" : "none"});
	}	
  
}


'; ?>

</script>


</div>


<div id="ProgressBar" style="display:none">
	<img src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>