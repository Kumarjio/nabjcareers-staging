{if $errors}
	{foreach item="error" from=$errors}
		<p class="error">[[{$error}]]</p>
	{/foreach}
{else}
{breadcrumbs}
	{if $listing_type_id == 'Job/Resume'}
	<a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a> &#187; Template Instructions
	{else}
		<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">{$listing_type_id}</a> &#187;  Template Instructions
	{/if}
{/breadcrumbs}
	 
	<h1>Template Instructions</h1>
	{if $listing_field_info.type == 'complex'}
		<p>The field you created will be automatically added to the {$listing_type_id} posting form. But it will not appear on the details page.</p>
		<div style='padding-bottom:15px;'>You will need to modify template files below in order to make this field appear on that page:</div>
	{else}
		<p>The field you created will be automatically added to the {$listing_type_id} posting form. But it will not appear on the search form, search results page and details page.</p>
		<div style='padding-bottom:15px;'>You will need to modify the template listed below in order to make this field appear on these pages:</div>
	{/if}
	{if $listing_type_id == 'Job/Resume'}
		<span style='font-weight: bold;'>Search Resume form:</span> <a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_form_resumes.tpl">search_form_resumes.tpl</a> - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style="color: #3f7f7f;">&lt;fieldset&gt;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputName"&gt;</span>&#91;&#91;$form_fields.{$listing_field_info.id}.caption&#93;&#93;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputField"&gt;</span>&#123;search property={$listing_field_info.id}&#125;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
			<div style="color: #3f7f7f;">&lt;/fieldset&gt;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		<span style='font-weight: bold;'>Search Job form:</span> <a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_form.tpl">search_form.tpl</a> - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style="color: #3f7f7f;">&lt;fieldset&gt;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputName"&gt;</span>&#91;&#91;$form_fields.{$listing_field_info.id}.caption&#93;&#93;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputField"&gt;</span>&#123;search property={$listing_field_info.id}&#125;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
			<div style="color: #3f7f7f;">&lt;/fieldset&gt;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		
		<span style='font-weight: bold;'>Resume search results page:</span> <a  target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_results_resumes.tpl">search_results_resumes.tpl</a> - insert the following code 
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style='padding-left: 15px;'>&#123;$listing&#46;{$listing_field_info.id}&#125;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		<span style='font-weight: bold;'>Job search results page:</span> <a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_results_jobs.tpl">search_results_jobs.tpl</a> - insert the following code 
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style='padding-left: 15px;'>&#123;$listing&#46;{$listing_field_info.id}&#125;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		
		<span style='font-weight: bold;'>Resume details page:</span> <a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=display_resume.tpl">display_resume.tpl</a> - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div>&#123;if $listing.{$listing_field_info.id}&#125;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;h3&gt;</span>&#91;&#91;FormFieldCaptions!{$listing_field_info.caption}&#93;&#93;<span style="color: #3f7f7f;">&lt;/h3&gt;</span></div>
				<div style='padding-left: 15px;'>&#123;$listing.{$listing_field_info.id}&#125;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="clr"&gt;&lt;br/&gt;&lt;/div&gt;</span></div>
			<div>&#123;/if&#125;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		<span style='font-weight: bold;'>Job details page:</span> <a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=display_job.tpl">display_job.tpl</a> - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div>&#123;if $listing.{$listing_field_info.id}&#125;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;h3&gt;</span>&#91;&#91;FormFieldCaptions!{$listing_field_info.caption}&#93;&#93;<span style="color: #3f7f7f;">&lt;/h3&gt;</span></div>
				<div style='padding-left: 15px;'>&#123;$listing.{$listing_field_info.id}&#125;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="clr"&gt;&lt;br/&gt;&lt;/div&gt;</span></div>
			<div>&#123;/if&#125;</div>
			
		</div>
		to the place where this field should appear.<br/><br/>
	{else}
	    {if $listing_field_info.type!='complex'}
		<span style='font-weight: bold;'>Search {$listing_type_id} form:</span> {if $listing_type_id=='Resume'}<a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&template_name=search_form_resumes.tpl">search_form_resumes.tpl</a>{else}<a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_form.tpl">search_form.tpl</a>{/if} - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style="color: #3f7f7f;">&lt;fieldset&gt;</div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputName"&gt;</span>&#91;&#91;$form_fields.{$listing_field_info.id}.caption&#93;&#93;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
				<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="inputField"&gt;</span>&#123;search property={$listing_field_info.id}&#125;<span style="color: #3f7f7f;">&lt;/div&gt;</span></div>
			<div style="color: #3f7f7f;">&lt;/fieldset&gt;</div>
		</div>
		to the place where this field should appear.<br/><br/>
		
		<span style='font-weight: bold;'>{$listing_type_id} search results page:</span> {if $listing_type_id=='Resume'}<a  target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&template_name=search_results_resumes.tpl">search_results_resumes.tpl</a>{else}<a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=search_results_jobs.tpl">search_results_jobs.tpl</a>{/if} - insert the following code 
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style='padding-left: 15px;'>
				&#123;$listing&#46;{$listing_field_info.id}{if $listing_field_info.type=='monetary'}&#46;value{/if}&#125;
			</div>
		</div>
		to the place where this field should appear.<br/><br/>
		{/if}
		
		<span style='font-weight: bold;'>{$listing_type_id} details page:</span> {if $listing_type_id=='Resume'}<a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&template_name=display_resume.tpl">display_resume.tpl</a>{else}<a target='_blank' href="{$GLOBALS.site_url}/edit-templates/?module_name=classifieds&amp;template_name=display_job.tpl">display_job.tpl</a>{/if} - insert the following code
		<div style="font-size: 12px; margin: 5px 0 0 0; padding:5px 0; font-family: Arial; font-style: italic; border: 1px dashed #ff5500;">
			<div style='padding-left: 15px;'>
				{if $listing_field_info.type=='complex'}
					&#123;display property={$listing_field_info.id}&#125;
				{else}
					<div>&#123;if $listing.{$listing_field_info.id}&#125;</div>
						<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;h3&gt;</span>&#91;&#91;FormFieldCaptions!{$listing_field_info.caption}&#93;&#93;<span style="color: #3f7f7f;">&lt;/h3&gt;</span></div>
						<div style='padding-left: 15px;'>&#123;$listing.{$listing_field_info.id}{if $listing_field_info.type=='monetary'}&#46;value{/if}&#125;</div>
						<div style='padding-left: 15px;'><span style="color: #3f7f7f;">&lt;div class="clr"&gt;&lt;br/&gt;&lt;/div&gt;</span></div>
					<div>&#123;/if&#125;</div>
				{/if}
			</div>
		</div>
		to the place where this field should appear.<br/><br/>
	{/if}
{/if}