<div class="topMenu"> 
	<div class="leftTopMenu"> </div>
		<ul>
			<li><a href="{$GLOBALS.site_url}/">[[Home]]</a></li>
			<li class="sep"></li>
			<li><a href="{$GLOBALS.site_url}/my-account/">[[My Account]]</a></li>
			<li class="sep"></li>
				{if $GLOBALS.current_user.group.id != "Employer"}
					<li><a href="{$GLOBALS.site_url}/find-jobs/" >[[Find Jobs]]</a></li>
					<li class="sep"></li>
					<li><a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" >[[Post Resumes]]</a></li>
					<li class="sep"></li>
				{/if}
				{if $GLOBALS.current_user.group.id != "JobSeeker"}
					<li><a href="{$GLOBALS.site_url}/search-resumes/" >[[Search Resumes]]</a></li>
					<li class="sep"></li>
					<li><a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" >[[Post Jobs]]</a></li>
					<li class="sep"></li>
				{/if}
			<li><a href="{$GLOBALS.site_url}/contact/" >[[Contact]]</a></li>
			<li class="sep"></li>
		</ul>
	<div class="rightTopMenu"> </div>
</div>
<div class="clr"><br/></div>