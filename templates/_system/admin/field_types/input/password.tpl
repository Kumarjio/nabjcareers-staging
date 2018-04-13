<input type="password"  name="{if $complexField}{$complexField}[{$id}][{$complexStep}][original]{else}{$id}[original]{/if}" 
class="inputString {if $complexField}complexField{/if}" /> 
{if $GLOBALS.user_page_uri === "/edit-user/"} Current password: {$user_info.access_token} {/if} <br />
<input type="password"  name="{if $complexField}{$complexField}[{$id}][{$complexStep}][confirmed]{else}{$id}[confirmed]{/if}" class="inputString {if $complexField}complexField{/if}" style="margin-top:2px;" /><br />
<span style="font-size:11px">[[Confirm Password]]</span>