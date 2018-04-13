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
	{elseif $form_field.id == "access_type"}
		{if $listing_type_id != "Job" && $listing.type.id != "Job"}{* *}
			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id template='resume_access.tpl'}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
		{/if}
	{elseif ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id == 'ApplicationSettings'}
		<fieldset>
			<div class="inputName">[[$form_field.caption]]</div>
			<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
			<div class="inputField">{input property=$form_field.id template='applicationSettings.tpl'}</div>
			{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="instructions.tpl" form_field=$form_field}{/if}
		</fieldset>
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
		</script>
	{/literal}
{/if}


{* ELDAR 
{if $listing_type_id == "Job" || $listing.type.id == "Job"}
<br /><br />
<p><input type="checkbox" id="featured_opt_box" value="Make Job a Featured Listing" />Make Job a Featured Listing&nbsp;<a>(i)</a></p>
<p><input type="checkbox" id="priority_opt_box" value="Make Job a Priority Listing" />Make Job a Priority Listing&nbsp;<a>(i)</a></p>
{/if}

 end ELDAR *}