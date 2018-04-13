{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-listings/?restore=1">Manage Listings</a> &#187; Display Listing{/breadcrumbs}
<h1>Display Listing</h1>

{if $errors}
	{foreach from=$errors key=error item=error_message}
		{if $error == 'LISTING_ID_ISNOT_SPECIFIED'}
			<p class="error">Listing ID is not specified</p>
		{elseif $error == 'LISTING_DOESNOT_EXIST'}
			<p class="error">Listing with specified ID does not exist</p>
		{elseif $error == 'NO_SUCH_FILE'}
			<p class="error">File does not exist</p>
		{/if}
	{/foreach}
{else}

	<p>
		{if $comments_total > 0}
			<a href="{$GLOBALS.site_url}/listing-comments/?listing_id={$listing.id}">Comments ({$comments_total})</a>,
		{else}
			Comments ({$comments_total}),
		{/if}
		{if $rate}
			<a  href="{$GLOBALS.site_url}/listing-rating/?listing_id={$listing.id}">Rate ({$rate})</a>
		{else}
			Rate ({$rate})
		{/if}
	</p>

	<table>
		<thead>
		    <tr>
				<th colspan="2">Listing Details</th>
			</tr>
		</thead>
		<tr class="oddrow">
			<td>Listing ID</td>
			<td>{$listing.id}</td>
		</tr>
		<tr class="evenrow">
			<td>Listing Type</td>
			<td>{$listing.type.id}</td>
		</tr>
		<tr class="oddrow">
			<td>Activation Date</td>
			<td>{$listing.activation_date}</td>
		</tr>
		<tr class="evenrow">
			<td>Expiration Date</td>
			<td>{$listing.expiration_date}</td>
		</tr>
		<tr class="oddrow">
			<td>Listing User</td>
			<td><a href="mailto:{$listing.user.email}">{$listing.user.username}</a></td>
		</tr>
		<tr class="evenrow">
			<td># of Views</td>
			<td>{$listing.views}</td>
		</tr>
		{foreach from=$form_fields item=field}
			{* Hide anonymous field for Jobs, hide 'reject_reason' and 'status' for not wait approve listings *}
			{if (!isset($form_fields.Resume) && $form.id == anonymous) || 
				($field.id == 'company_name' && empty($listing.company_name)) || 
				($wait_approve == 0 && ($field.id == 'reject_reason' || $field.id == 'status'))}
			{elseif $field.id == 'video' && empty($listing.video.file_url)}
			<tr class="{cycle values='oddrow,evenrow'}">
				<td>{$field.caption}</td>
				<td></td>
			</tr>
			{elseif $field.id == 'Salary' or $field.id == 'DesiredSalary'}
			<tr class="{cycle values='oddrow,evenrow'}">
				<td>{$field.caption}</td>
				<td>{display property=$field.id} {$listing.Salary.currency_sign}</td>
			</tr>
			{elseif $field.id == 'ApplicationSettings'}
				<tr class="{cycle values='oddrow,evenrow'}">
					<td>{$field.caption}</td>
					<td>{display property=$field.id template="application.settings.tpl"}</td>
				</tr>	
			{elseif $field.id == 'access_type'}
			<tr class="{cycle values='oddrow,evenrow'}">
				<td>{$field.caption}</td>
				<td>
					{foreach from=$access_type_properties->type->property_info.list_values item=access_type}
						{if $access_type_properties->value == $access_type.id}
							{$access_type.caption}
						{/if}	
					{/foreach}
				</td>
			</tr>
			{else}
				<tr class="{cycle values='oddrow,evenrow'}">
					<td>{$field.caption}</td>
					<td>
						{if $field.id == DesiredSalary}
							{if $listing.DesiredSalary.value != 0}[[$listing.DesiredSalary.currency_sign]][[$listing.DesiredSalary.value]]{/if}
						{elseif $field.id == Salary}
							{if $listing.Salary.value != 0}[[$listing.Salary.currency_sign]][[$listing.Salary.value]]{/if}
						{else}
							{display property=$field.id}
						{/if}
					</td>
				</tr>
			{/if}
		{/foreach}
	</table>
{/if}