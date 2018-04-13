{foreach from=$form_fields item=form_field}
	{if $form_field.id == 'video' || $form_field.id == 'youtube'}
		{if $package.video_allowed}
			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
		{/if}
	{elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id == "anonymous"}
		{* this empty place of 'anonymous' checkbox in 'Job' listing *}
	
	{elseif ($listing_type_id == "Resume" || $listing.type.id == "Resume") && $form_field.id == "Title" }
		<fieldset>
			<div class="inputName">[[Desired Job]]</div>
			<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
			<div class="inputField">{input property=$form_field.id}</div>
			{if $form_field.instructions}{assign var="instructionsExist" value="1"}
			
				<div class="instruction">
					<div class="instr_icon" onmouseover="javascript:$(this).next('.instr_block').show();" onmouseout="javascript:$(this).next('.instr_block').hide();"></div>
				    <div class="instr_block" id="instruction_{$form_field.id}">
						<div class="instr_arrow"></div>
						<div class="instr_cont">
							[[Enter the desired jobs you want. This will be displayed at the top of your resume. Example: Reporter, On-Air Talent, Producer, Copy Editor etc.]]
							<div class="clr"></div>
						</div>
						<div class="clr"></div>
					</div>
				    <div class="clr"></div>
				</div>
			{/if}
		</fieldset> 
	
	{elseif ($listing_type_id == "Resume" || $listing.type.id == "Resume") && $form_field.id == "anonymous"}
			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
{* Job Fair *}
	{elseif $form_field.id == "JobFairs"}
		{if $form_field.id}
			<div class="jobfairsBlockTitle"><strong>[[Job Fair Registrations]]</strong></div>
			<div id="jobfairsItemsContainer">
				<fieldset class="jobfairs_container">
					{assign var="fixInstructionsForComplexField" value=false}
					{if $form_field.type != 'complex'}
						{assign var="fixInstructionsForComplexField" value=true}
					{/if}
								
					<div class="inputNameJobFair">[[$form_field.caption]]</div>
					<div class="inputReqJobFair">&nbsp;{if $form_field.is_required}*{/if}</div>
					<div class="inputFieldjobfairsListBlock">{input property=$form_field.id}</div>
					{if $form_field.instructions && $fixInstructionsForComplexField}
						{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}
					{/if}
				</fieldset>
			</div>
		{/if}
{* END of Job Fair *}

	{elseif $form_field.id == "access_type"}
		{if $listing_type_id != "Job" && $listing.type.id != "Job"}
			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id template='resume_access.tpl'}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
		{/if}

	{* Apply Now section 20-12-2013 *}
								
	{elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id == "ApplyNowBtnChoice"}	
		<br><br>
		<fieldset class="applyNowBlock">
				<div class="inputNameApplicationForm">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				
				<div class="inputField">{input property=$form_field.id template='listCustom.tpl'}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
		</fieldset>
	
		<br><br>

	{elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id == 'ApplicationSettings'}
				<div id="ApplicationSettingsWarning">If you choose "No" be sure to put instructions on how to apply in the text of the job posting</div>
		
				<fieldset id="{$form_field.id}Fieldset">
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id template='applicationSettings.tpl'}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
		
		
	{* END OF Apply Now section 20-12-2013 *}
	
	
	
	
	{* 08-06-2014 Deleted jobs mod *}
	{elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id == 'deleted'}
				
	{else}
		<fieldset>
			{assign var="fixInstructionsForComplexField" value=false}
			{if $form_field.type != 'complex'}
				{assign var="fixInstructionsForComplexField" value=true}
			{/if}
			<div class="inputName">[[$form_field.caption]]</div>
			<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
			<div class="inputField">{input property=$form_field.id}</div>
			{if $form_field.instructions && $fixInstructionsForComplexField}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
		</fieldset>
	{/if}
{/foreach}


{literal}
	<script type="text/javascript">

		var jobfair_elems = document.getElementById("complexFields_JobFairs");
		
		if ($("#complexFields_JobFairs").find('fieldset').length) {

		}
		else {
			$(".jobfairsBlockTitle").css("display", "none");
			$("#jobfairsItemsContainer").css("display", "none");		
		}
		
		
	</script>
{/literal}


{if $instructionsExist}
	{literal}
		<script type="text/javascript">
			function instructionFunc() {
				var elem = $(".instruction").prev();
				elem.children().focus(function() {
					$(this).parent().next(".instruction").children(".instr_block").show();
				});
				elem.children().blur(function() {
					$(this).parent().next(".instruction").children(".instr_block").hide();
				});
			}
			$("document").ready(function() {
				instructionFunc();
			});
			function FCKeditor_OnComplete(editorInstance) {
				editorInstance.Events.AttachEvent( 'OnFocus', function() {
						$("#instruction_"+editorInstance.Name).show();
					});
				editorInstance.Events.AttachEvent( 'OnBlur', function() {
						$("#instruction_"+editorInstance.Name).hide();
					});
				return;
			}
			
		if ($("select[name=Country] option:selected").val() == "United States" ) 
		{
			$ ("select[name=State]").closest("fieldset").css({'display':'block'});
		}
		else 
		{
			$("select[name=State]").closest("fieldset").css({'display':'none'});
		}		
		$("select[name=Country]").bind("click", function (e) {	
			if ( $("select[name=Country] option:selected").val() == "United States" ) {
				$("select[name=State]").closest("fieldset").css({'display':'block'});
			}
			else {
				$("select[name=State]").val('Outside The US (No State)');
				$("select[name=State]").closest("fieldset").css({'display':'none'});	
			}
		});		
		</script>
	{/literal}
{/if}


{literal}
	<script type="text/javascript">
		
		
		$('.currentWork').each(function () {
	          if (this.checked) {
	          	$(this).closest("fieldset").prev("fieldset").css({'display':'none'});
	          }
		      else 
		      {
		      	$(this).closest("fieldset").prev("fieldset").css({'display':'block'});
		      }
		});
		
		$("#complexFields_WorkExperience").closest("fieldset").click(function() {
			$(".currentWork").each(function () {		
				$(this).bind("click", function (e) {		
					$('.currentWork').each(function () {
			           if (this.checked) {
			           		$(this).closest("fieldset").prev("fieldset").css({'display':'none'});
			           		$(this).closest("fieldset").prev("fieldset").children(".inputField").children("input").val("");
					   }
					   else 
					   {
					   		$(this).closest("fieldset").prev("fieldset").css({'display':'block'});
					   }
					});				
				});					
			});		
		});



	</script>
{/literal}
