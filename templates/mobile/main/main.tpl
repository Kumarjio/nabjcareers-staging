<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta name="keywords" content="[[$KEYWORDS]]" />
		<meta name="description" content="[[$DESCRIPTION]]" />
		<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
		<meta content="width= 320" name="viewport">  	
		<title>{$GLOBALS.settings.site_title}{if $TITLE ne ""}: [[$TITLE]] {/if}</title>
		<link rel="StyleSheet" type="text/css" href="{image src="design.css"}" />
		<link rel="apple-touch-icon" href="icon.png" />
	</head>
	<body>
	<div id="slider_from">
		
		<div class="logo">
			<div class="png"></div>
			<a href="{$GLOBALS.site_url}/"><img src="{image}logo.png" border="0" alt="[[{$GLOBALS.settings.logoAlternativeText}]]" title="[[{$GLOBALS.settings.logoAlternativeText}]]" /></a>
		</div>
		
		{* <div id="top_bar"><a href="http://knight.stanford.edu/"><img border="0" src="{image}knightl2012-mobile.jpg" style="margin-top: 3px;" alt="[[{$GLOBALS.settings.logoAlternativeText}]]" title="[[{$GLOBALS.settings.logoAlternativeText}]]" /></a></div> *}
		
		<div id="main_tab">
		  <ul>
		  	{if $GLOBALS.current_user.logged_in}
		  		<li class="first"><a href="{$GLOBALS.site_url}/logout/">[[Logout]]</a></li>
		  	{else}
				<li class="first" {if $GLOBALS.user_page_uri == "/login/"}id="current"{/if}><a href="{$GLOBALS.site_url}/login/">[[Sign In]]</a></li>		  	
	  		{/if}
		  	<li {if $GLOBALS.user_page_uri == "/find-jobs/" || $GLOBALS.user_page_uri == "/" && $GLOBALS.current_user.group.id != "JobSeeker" }id="current"{/if}><a href="{$GLOBALS.site_url}/find-jobs/">[[Find Jobs]]</a></li>
		  	<li {if $GLOBALS.user_page_uri == "/search-resumes/" || $GLOBALS.current_user.group.id == "JobSeeker"}id="current"{/if} class="last_menu_item"><a href="{$GLOBALS.site_url}/search-resumes/">[[Find Resumes]]</a></li>
		  </ul>
		</div>

		<div class="page" id="page">
			<div class="main">
				{if $GLOBALS.current_user.group.id == "Employer"}
					{module name="classifieds" function="search_form" listing_type_id="R" form_template="search_form_resumes.tpl"}
				{else}
					{$MAIN_CONTENT}
				{/if}
			</div>
		</div>
		
		
		<div id="foot"><a href="http://nabjcareers.org">click here to see the full site</div>
		
	</div>
	</body>
</html>
