<h1>[[Find Jobs]]{if $acl->isAllowed('open_search_by_company_form')}<div class="RightLink"><a href="{$GLOBALS.site_url}/browse-by-company/">[[Search by Company]]</a></div>{/if}</h1>
<div class="clr"></div>
{if $id_saved}
	<form action="{$GLOBALS.site_url}/saved-searches/" method="get" id="search_form">
		<input type="hidden" name="action" value="{$action}" />
		<input type="hidden" name="id_saved" value="{$id_saved}" />
{else}
	<form action="{$GLOBALS.site_url}/search-results-jobs/" method="get" id="search_form">
		<input type="hidden" name="action" value="search" />
{/if}
	<input type="hidden" name="listing_type[equal]" value="Job" />
	<div id="adMargin">
		{if $id_saved}
			<fieldset>
				<div class="inputName">[[Search Name]]</div>
				<div class="inputField">{search property=name template='string.tpl'}</div>
			</fieldset>
		{/if}
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Keywords]]</div>
			<div class="inputField">{search property=keywords type="bool" listingType="Job"}</div>
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
			<div class="inputName">[[FormFieldCaptions!Search Within]]</div>
			<div class="inputField">{search property=ZipCode}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.Country.caption]]</div>
			<div class="inputField">{search property=Country}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.State.caption]]</div>
			<div class="inputField">{search property=State}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.City.caption]]</div>
			<div class="inputField">{search property=City template="string.like.tpl"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.Salary.caption]]</div>
			<div class="inputField">{search property=Salary}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.SalaryType.caption]]</div>
			<div class="inputField">{search property=SalaryType}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[$form_fields.EmploymentType.caption]]</div>
			<div class="inputField">{search property=EmploymentType}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[Property_PostedWithin!Posted Within]]</div>
			<div class="inputField">{search property=PostedWithin template="list.date.tpl"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField">
				{if $id_saved}
					<input class="button" type="submit" value="[[Save:raw]]"  id="search_button" />
				{else}
					<input class="button" type="submit" value="[[Search:raw]]"  id="search_button" />
				{/if}
			</div>
		</fieldset>
	</div>
</form>
<div id="adSpace">{module name="static_content" function="show_static_content" pageid="FindJobsAdSpace"}</div> 