{if $id_saved}<h1>[[Edit Saved Search]]</h1>{else}<h1>[[Search Resumes]]</h1>{/if}
{if $id_saved}
	<form action="{$GLOBALS.site_url}/saved-searches/" method="get"  id="search_form">
		<input type="hidden" name="action" value="{$action}" />
		<input type="hidden" name="id_saved" value="{$id_saved}" />
{else}
	<form action="{$GLOBALS.site_url}/search-results-resumes/"  id="search_form">
	<input type="hidden" name="action" value="search" />
{/if}
<input type="hidden" name="listing_type[equal]" value="Resume" />
	<div id="adMargin">
		{if $id_saved}
			<fieldset>
				<div class="inputName">[[Search Name]]</div>
				<div class="inputField">{search property=name template='string.tpl'}</div>
			</fieldset>
		{/if}
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Keywords]]</div>
			<div class="inputField">{search property=keywords type="bool" listingType="Resume"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.JobCategory.caption]]</div>
			<div class="inputField">{search property=JobCategory}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.Occupations.caption]]</div>
			<div class="inputField">{search property=Occupations}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.JobType.caption]]</div>
			<div class="inputField">{search property=JobType}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Search Within]]</div>
			<div class="inputField">{search property=ZipCode}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.Country.caption]]</div>
			<div class="inputField" id="country_block">{search property=Country}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.State.caption]]</div>
			<div class="inputField" id="state_block">{search property=State}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.City.caption]]</div>
			<div class="inputField">{search property=City template="string.like.tpl"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.DesiredSalary.caption]]</div>
			<div class="inputField">{search property=DesiredSalary}<br/><br/>{search property=DesiredSalaryType}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[Property_PostedWithin!Posted Within]]</div>
			<div class="inputField">{search property=PostedWithin template="list.date.tpl"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[Institution Name]]</div>
			<div class="inputField">{search property='InstitutionName' complexParent='Education' template='string.like.tpl'}</div>
		</fieldset>
				
		{if $jobfairs}
			<br />
			<div class="jobfairsBlockTitle"><strong>[[Select attendees of these Job Fairs Only:]]</strong></div>
			<br />
		
			<div id="jobfairsTableContainer">
				{foreach from=$jobfairs item=jobfair name=jobfairs_block}
					{if $jobfair.visible_emp}
						<fieldset class="jobfairs_container_search">
							<div class="inputNameJobFair_search">{$jobfair.caption}</div>
							<div class="inputFieldjobfairsSearch">{search property=$jobfair.fieldid complexParent='JobFairs' template='boolean.tpl'}</div>
						</fieldset>
					{/if}
				{/foreach}
			</div>
		{/if}
		
		
		{* LINKEDIN: PEOPLE SEARCH *}
		{module name="social" function="linkedin_people_search" profileSID=$listing.user.id}
		{* / LINKEDIN: PEOPLE SEARCH *}
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField">
				{if $id_saved}
					<input class="button" type="submit" value="[[Save:raw]]" id="search_button" />
				{else}
					<input type="submit" value="[[Search:raw]]" class="button" id="search_button" />
				{/if}
			</div>
		</fieldset>
	</div>
</form>
<div id="adSpace">{module name="static_content" function="show_static_content" pageid="SearchResumesAdSpace"}</div>

<script type="text/javascript">
	{literal}
		if ($("#country_block > select option:selected").val() == "United States" ) 
		{
			$ ("#state_block").closest("fieldset").css({'display':'block'});
		}
		else 
		{
			$("#state_block").closest("fieldset").css({'display':'none'});
		}
		
		$("#country_block > select").bind("click", function (e) 
			{	
				if ( $("#country_block > select option:selected").val() == "United States" ) 
				{
					$("#state_block").closest("fieldset").css({'display':'block'});
				}
				else 
				{
					$("#state_block").closest("fieldset").css({'display':'none'});	
					$("#state_block").children().val('Outside The US (No State)');
				}
				
			}
			
		);
		
	{/literal}
	
	{literal}
		$obj=$("#jobfairsTableContainer fieldset").html();
		if (!$obj) {
			$(".jobfairsBlockTitle").css({'display':'none'});
		}
		
		else {
			$(".jobfairsBlockTitle").css({'display':'block'});
		}	
	{/literal}
	
</script>