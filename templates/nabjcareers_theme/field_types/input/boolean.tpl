<input type="hidden" class="{if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]
{else}{$id}{/if}" value="0" />
<input type="checkbox" class="{if $complexField}complexField {$id}{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]
{else}{$id}{/if}" id="{$id}" {if $value}checked="checked" {/if} value="1" />
	

{* Job Fair *}
	{if $complexField == "JobFairs"} 
		<span class="greySubText">&nbsp;Yes</span>
    {/if}        
{* END of Job Fair *}
    