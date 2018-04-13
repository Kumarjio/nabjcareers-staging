{if $template_name eq ""}
	{if $ERROR ne "MODULE_DOES_NOT_EXIST"}
		{if $ERROR eq "CANNOT_COPY_THEME"}
			<p class="erro">Access denied</p>
		{/if}
		<table>
	            <thead>
	                <tr>
	                    <th>Template Name</th>
	                    <th class="actions">Actions</th>
	                </tr>
	                </thead>
	                <tbody>
				{assign var="counter" value=0}
				{foreach from=$template_list item="template_info"}
					{assign var="counter" value=$counter+1}
					<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
	                    <td>{$template_info}</td>
	                    <td>
	                        <a href="?module_name={$module_name}&template_name={$template_info}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a>
	                        <a title="Delete" onclick="return confirm('Template deletion may affect the front-end pages work. Are you sure you want to delete this Template?');" href="?action=delete&module_name={$module_name}&template_name={$template_info}"><img src="{image}delete.png" border=0 alt="Delete"></a>
	                    </td>
	                </tr>
				{foreachelse}
	            	<tr><td colspan="2">This module does not have any templates</td></tr>
				{/foreach}
			</tbody>
		</table>
	{/if}
{else}
	{module name="template_manager" function="edit_template"}
{/if}