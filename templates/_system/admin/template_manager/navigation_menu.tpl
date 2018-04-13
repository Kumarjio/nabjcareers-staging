{breadcrumbs}
	{foreach name="foreach" item="item" from=$navigation}
		{if $item.reference eq ""}
			{$item.name}
		{else}
			<a href="{$item.reference}">{$item.name}</a>
		{/if}
		{if not $smarty.foreach.foreach.last} &#187; {/if}
	{/foreach}
{/breadcrumbs}

<h1>{$title}</h1>
{foreach from=$errors item=error}
	{if $error == 'NOT_ALLOWED_IN_DEMO'}
		<p class="error">This action is not allowed in Demo mode</p>
	{else}
	{/if}
{/foreach}
<p>Active theme: <b>{$GLOBALS.settings.CURRENT_THEME}</b></p>
{if $show_highlight_setting}
	<div class="clr"></div>
	<form>
		<table>
			<thead>
				<tr>
					<th>Highlight Templates On Frontend&nbsp;</th>
					<th align=center>
						<select name="highlight_templates">
							<option value="0"{if $highlight_templates == 0} selected="selected"{/if}>disable</option>
							<option value="1"{if $highlight_templates == 1} selected="selected"{/if}>enable</option>
						</select>
					</th>
					<th><span class="greenButtonEnd"><input type="submit" name="highlight_submit" value="Save" class="greenButton"/></span></th>
				</tr>
			</thead>
		</table>
	</form>
{/if}