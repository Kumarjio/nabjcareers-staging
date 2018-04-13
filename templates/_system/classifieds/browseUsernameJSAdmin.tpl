{if $GLOBALS.user_page_uri != "/browse-by-usernamejs-admin/"}
	{foreach from = $alphabets item = alphabet name=alphabet}  
	<div>
		<div class="browseCompanyAB">
			<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char=any_char">#</a>
		</div>
		{foreach from = $alphabet item = char name=char}  
		<div class="browseCompanyAB">
			<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char={$char}">{$char}</a>
		</div>
		{/foreach}
		<div class="clr"></div>
	</div>
	{/foreach}
	{include file="searchFormLastName.tpl"}
{else}
	<b>Browse Last Name:</b>
	{foreach from = $alphabets item = alphabet name=alphabet}  
		<div>
			<div class="browseCompanyAB">
				<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char=any_char">#</a>
			</div>
			{foreach from = $alphabet item = char name=char}  
			<div class="browseCompanyAB">
				<a class='browseItem' href="{$GLOBALS.site_url}/browse-by-usernamejs-admin/?first_char={$char}">{$char}</a>
			</div>
			{/foreach}
			<div class="clr"></div>
		</div>
	{/foreach}
{/if}