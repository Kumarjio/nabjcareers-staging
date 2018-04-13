<div class="clr"><br/></div>
	<div class="bottomMenu">
		<a href="{$GLOBALS.site_url}/">[[Home]]</a> &nbsp; 
		<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/my-account/">[[My Account]]</a> &nbsp; 
		{if $GLOBALS.current_user.group.id != "Employer"}
			<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/find-jobs/" >[[Find Jobs]]</a> &nbsp; 
			<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" >[[Post Resumes]]</a> &nbsp;
		{/if}
		{if $GLOBALS.current_user.group.id != "JobSeeker"}
			<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/search-resumes/" >[[Search Resumes]]</a> &nbsp; 
			<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" >[[Post Jobs]]</a> &nbsp;
		{/if} 
		<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/contact/" >[[Contact]]</a>
		<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/about/">[[About Us]]</a>
		<img src="{image}sepDot.png" border="0" alt=""> &nbsp; <a href="{$GLOBALS.site_url}/site-map/">[[Sitemap]]</a>
	</div>
</div>
<div class="Footer">
	<span class="footertext">&copy; 2014-{$smarty.now|date_format:"%Y"}</span>	 
</div>
