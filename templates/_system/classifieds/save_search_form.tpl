<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>

{literal}
<script type="text/javascript">
	function saveSearchSubmit() {
		var options = {
				  target: "#messageBox",
				  url:  $("#saveSearchForm").attr("action")
				}; 
		$("#saveSearchForm").ajaxSubmit(options);
		return false;
	}
</script>
{/literal}
{if $is_alert}
	<h1>
		{if $listing_type_id == 'Job'} 
			[[Save Job Alert]]
		{elseif $listing_type_id == 'Resume'}
			[[Save Resume Alert]]
		{/if}
	</h1>
	<form method="post" action='{$GLOBALS.site_url}/save-search/' id="saveSearchForm" onsubmit="return saveSearchSubmit()">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="searchId" value="{$searchId}" />
		<p>[[Alert Name]] <input type="text" name="search_name" /></p>
		<input type="hidden" name="alert" value="1" />
		<p style="margin-left:10px;"><input type="submit" value="[[Save:raw]]" class="button" /></p>
	</form>
{else}
	<h1>[[Save Your Search]]</h1>
	<form method="post" action='{$GLOBALS.site_url}/save-search/' id="saveSearchForm" onsubmit="return saveSearchSubmit()">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="searchId" value="{$searchId}" />
		<p>[[Search Name]] <input type="text" name="search_name" /></p>
		<p style="margin-left:10px;"><input type="submit" value="[[Save:raw]]" class="button" /></p>
	</form>
{/if}