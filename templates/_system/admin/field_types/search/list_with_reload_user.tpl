<select name='{$id}[equal]' onchange="usersReloadWithParameter(this.value)">
	<option value="">Any {$caption}</option>
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {if $selected_user_group_id === $list_value.id}selected="selected"{/if} >{$list_value.caption}</option>
	{/foreach}
</select>
{literal}
<script language="Javascript">
function usersReloadWithParameter(param)
{
	window.location = "?user_group_id="+param;
}
</script>
{/literal}