<h3 align="center">User list</h3>


	<table class="fieldset">
	{foreach from=$users key=id item=user} 
	  <tr> 
			<td valign=top>{$user.login}</td><td><a href="{$GLOBALS.site_url}/update_user_profile/?login={$user.login}" title="Edit"><img src="{image}edit.gif" hspace="3" border=0 alt="Edit"></a> <a href="{$GLOBALS.site_url}/delete-user/?login={$user.login}"><img src="{image}delete.gif" hspace="3" border=0 alt="Delete"></a><br></td>
	  </tr> 	
	{/foreach}
	</table>
<br>
