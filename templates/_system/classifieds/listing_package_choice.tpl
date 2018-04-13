<script type="text/javascript">
<!--
	var listingPackageChoiceErrorMessage = '[[Please select a Package]]';
	{literal}
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
	{/literal}
//-->
</script>

{* ELDAR 09-10-2012 *}
<div id="plans_containers">
{* end ELDAR 09-10-2012 *}


<h1>[[Select a Package]]</h1>
{if empty($addListingPackageChoiceTpl)}

<form name="checkform" id="listing-package-choice-form" method="post" action="" onsubmit="return planSubmit();">
{/if}
	{foreach from=$listing_packages item="listing_packages" key="contract_id" name="listing_packages"}
		<p>
			<b>{$listing_packages.membership_plan_name}</b>
			{foreach from=$listing_packages.packages item="listing_package"}
				
				
		{* end ELDAR *}
				<p id="{$listing_package.id}_{$contract_id}" class="hide_{$listing_package.id}">
					<input id="{$listing_package.id}_inp" type="radio" class="packs_list" value="{$listing_package.id}_{$contract_id}" {if $listing.package.id == $listing_package.id}checked{/if} {* ??? OnChange="packField.value=this.value" *} onclick="planChosen = true; planSelectionCheck(); planSelectionRemember = this.id;" name="listing_package_id" /> [[$listing_package.name]]
				{* end ELDAR *}					
					<br />{if !$GLOBALS.settings.ecommerce}[[Free of charge]]{else}[[$listing_package.description]]{/if}
					
				</p>
			{/foreach}
		</p>
	 {* end ELDAR *}
	{/foreach}
	  
	  
	<h1>[[Job posting options]]</h1>


<fieldset>
<div class="inputField"><input type="checkbox" name="featured_checkbox" id="featured_checkbox" onClick="checker(); reselectPlan();" /> Make Job a Featured listing {if $GLOBALS.settings.ecommerce}(+{$listing_package.featured_price}$){/if}</div>
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
<div class="inputField"><input type="checkbox" name="priority_checkbox" id="priority_checkbox" onClick="checker(); reselectPlan();"  /> Make Job a Priority listing {if $GLOBALS.settings.ecommerce}(+{$listing_package.priority_price}$){/if}</div>
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

	{if $cloneJob}<input type="hidden" name="tmp_listing_id" value="{$tmp_listing_id}" />{/if}
	
	{if empty($addListingPackageChoiceTpl)}
	<input type="hidden" name="listing_id" value="{$listing_id}" />
	<input type="hidden" name="listing_type_id" value="{$listing_type_id}" />
	<input type="hidden" name="test_param" value="1111" />

	
	<div id="listing-package-choice-message"></div>
	<p><input type="submit" value="[[Next >>:raw]]" class="button" /></p>
</form>
{/if}



{*  cust  *} 
<script language='JavaScript' type='text/javascript'> 

{literal}
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
		if (planSelectionRemember == '40_inp' || planSelectionRemember == '43_inp' || planSelectionRemember == '46_inp'  || planSelectionRemember == '49_inp') // 30
		{
			selectedPlanId = document.getElementById('49_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '49_inp';
		}

		if (planSelectionRemember == '41_inp' || planSelectionRemember == '44_inp' || planSelectionRemember == '47_inp'  || planSelectionRemember == '50_inp') // 60
		{
			selectedPlanId = document.getElementById('50_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '50_inp';
		}

		if (planSelectionRemember == '42_inp' || planSelectionRemember == '45_inp' || planSelectionRemember == '48_inp'  || planSelectionRemember == '51_inp') // 90
		{
			selectedPlanId = document.getElementById('51_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '51_inp';
		}
	}
	
	else if(document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {		
	//		priority	 	
		if (planSelectionRemember == '40_inp' || planSelectionRemember == '43_inp' || planSelectionRemember == '46_inp'  || planSelectionRemember == '49_inp') // 30
		{
			selectedPlanId = document.getElementById('43_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '43_inp';
		}
	
		if (planSelectionRemember == '41_inp' || planSelectionRemember == '44_inp' || planSelectionRemember == '47_inp'  || planSelectionRemember == '50_inp') // 60
		{
			selectedPlanId = document.getElementById('44_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '44_inp';
		}
	
		if (planSelectionRemember == '42_inp' || planSelectionRemember == '45_inp' || planSelectionRemember == '48_inp'  || planSelectionRemember == '51_inp') // 90
		{
			selectedPlanId = document.getElementById('45_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '45_inp';
		}
	}

	else if(!document.getElementById("priority_checkbox").checked && document.getElementById("featured_checkbox").checked) {		
		//		featured	 
		if (planSelectionRemember == '40_inp' || planSelectionRemember == '43_inp' || planSelectionRemember == '46_inp'  || planSelectionRemember == '49_inp') // 30
		{
			selectedPlanId = document.getElementById('46_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '46_inp';
		}
	
		if (planSelectionRemember == '41_inp' || planSelectionRemember == '44_inp' || planSelectionRemember == '47_inp'  || planSelectionRemember == '50_inp') // 60
		{
			selectedPlanId = document.getElementById('47_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '47_inp';
		}
	
		if (planSelectionRemember == '42_inp' || planSelectionRemember == '45_inp' || planSelectionRemember == '48_inp'  || planSelectionRemember == '51_inp') // 90
		{
			selectedPlanId = document.getElementById('48_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '48_inp';
		}
	}

	else if(!document.getElementById("priority_checkbox").checked && !document.getElementById("featured_checkbox").checked) {		
	//		NONE	 
		
		if (planSelectionRemember == '40_inp' || planSelectionRemember == '43_inp' || planSelectionRemember == '46_inp'  || planSelectionRemember == '49_inp') // 30
		{
			selectedPlanId = document.getElementById('40_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '40_inp';
		}
	
		if (planSelectionRemember == '41_inp' || planSelectionRemember == '44_inp' || planSelectionRemember == '47_inp'  || planSelectionRemember == '50_inp') // 60
		{
			selectedPlanId = document.getElementById('41_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '41_inp';
		}
	
		if (planSelectionRemember == '42_inp' || planSelectionRemember == '45_inp' || planSelectionRemember == '48_inp'  || planSelectionRemember == '51_inp') // 90
		{
			selectedPlanId = document.getElementById('42_inp');
			selectedPlanId.checked = true;
			planSelectionRemember = '42_inp';
		}
	}
}

function checker(){
							
	// reset radio buttons
	 var inp_objs = document.getElementsByName('listing_package_id');
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


{/literal}
</script>


{* ELDAR 09-10-2012 *}
</div>
{* end ELDAR 09-10-2012 *}


<div id="ProgressBar" style="display:none">
	<img src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" />[[Please, wait ...]]
</div>
