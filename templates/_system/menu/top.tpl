<div class="topMenu">
	<div class="topMenuLeft">
			<a href="{$GLOBALS.site_url}/my-account" >[[My Account]]</a>&nbsp;&nbsp;&nbsp;
			{if $GLOBALS.current_user.group.id != "Employer"}
				<a href="{$GLOBALS.site_url}/find-jobs/" >[[Find Jobs]]</a>&nbsp;&nbsp;&nbsp;
				<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" >[[Post Resumes]]</a>&nbsp;&nbsp;&nbsp;
			{/if}
			{if $GLOBALS.current_user.group.id != "JobSeeker"}
				<a href="{$GLOBALS.site_url}/search-resumes/" >[[Search Resumes]]</a>&nbsp;&nbsp;&nbsp;
				<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" >[[Post Jobs]]</a>&nbsp;&nbsp;&nbsp;
			{/if}
			<a href="{$GLOBALS.site_url}/contact" >[[Contact]]</a>
	</div>
	<div class="topMenuRight">
		<form id="langSwitcherForm" method="get" action="">
			[[Choose language]] 
			<select name="lang" onchange="location.href='{$GLOBALS.site_url}{$url}?lang='+this.value+'&amp;{$params}'">
				{foreach from=$GLOBALS.languages item=language}
					<option value="{$language.id}"{if $language.id == $GLOBALS.current_language} selected="selected"{/if}>{$language.caption}</option>
				{/foreach}
			</select>
		</form>	
	</div>
</div>
<div class="clr"></div>