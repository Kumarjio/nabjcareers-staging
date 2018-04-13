{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-listings/?restore=1">Manage Listings</a> &#187; Edit Listing{/breadcrumbs}
<h1>Edit Listing</h1>

{if $GLOBALS.is_ajax}
	<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	    
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.form.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
	<script language="javascript">
	
	var url = "{$GLOBALS.site_url}/edit-listing/";
	
	{literal}
		$("#editListingForm").submit(function() {
			var options = {
				target: "#messageBox",
	            url:  url,
	            succes: function(data) {
					$("#messageBox").html(data).dialog({width: 200});
				}
	        };
	        $(this).ajaxSubmit(options);
	        return false;
		});
	{/literal}
	</script>
{/if}

{include file='field_errors.tpl'}
<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<p>
{if $comments_total > 0}
	<a href="{$GLOBALS.site_url}/listing-comments/?listing_id={$listing_id}">Comments ({$comments_total})</a>,
{else}
	Comments ({$comments_total}),
{/if}
{if $rate}
	<a  href="{$GLOBALS.site_url}/listing-rating/?listing_id={$listing_id}">Rate ({$rate})</a>
{else}
	Rate ({$rate})
{/if}
</p>

<fieldset>
	<legend>&nbsp;Edit Listing</legend>
	<form method="post" enctype="multipart/form-data" action="" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('editListingForm');"{/if} id='editListingForm'>
		<input type="hidden" name="action" value="save_info"/>
		<input type="hidden" name="listing_id" value="{$listing_id}"/>
		<table>
			<tr>
				<td colspan="3"><a href="{$GLOBALS.site_url}/manage-pictures/?listing_id={$listing_id}">Edit Pictures</a></td>
			</tr>
				{foreach from=$form_fields item=form_field}
				{* Hide 'Reject Reason', 'Approval Status' fields, and Anonymous field for Jobs *}
					{if $form_field.id == 'reject_reason' || $form_field.id == 'status' || (!isset($form_fields.Resume) && $form_field.id == anonymous) }
					{elseif !isset($form_fields.Resume) && $form_field.id =='ApplicationSettings'}
					<tr>
						<td valign="top" width="20%">[[$form_field.caption]]</td>
						<td valign="top">&nbsp;{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td>{input property=$form_field.id template='applicationSettings.tpl'}</td>
					</tr>
					{elseif $form_field.id == "access_type"}
						{if $listing_type_id == "Job" || $listing.type.id == "Job"}{* *}
						{else}
							<tr>
								<td valign="top" width="20%">[[$form_field.caption]]</td>
								<td valign="top">&nbsp;{if $form_field.is_required} <font color="red">*</font>{/if}</td>
								<td>{input property=$form_field.id template='resume_access.tpl'}</td>
							</tr>
						{/if}
					{else}
						<tr>
							<td valign="top">{$form_field.caption}</td>
							<td valign="top">&nbsp;{if $form_field.is_required} <font color="red">*</font>{/if}</td>
							<td>{input property=$form_field.id}</td>
						</tr>
					{/if}
				{/foreach}
			<tr>
				<td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>