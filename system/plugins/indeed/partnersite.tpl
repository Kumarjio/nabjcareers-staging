<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta name="keywords" content="[[$KEYWORDS]]" />
<meta name="description" content="[[$DESCRIPTION]]" />
<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>  
<title>{if !$GLOBALS.page_not_found && !$exp_listings_404_page}{$GLOBALS.settings.site_title}{/if}{if $TITLE ne ""}{if !$GLOBALS.page_not_found && !$exp_listings_404_page}:{/if} [[$TITLE]]{/if}</title>
</head>
<frameset rows="40,*">
	<frame name="sjb_hdr" src="{$GLOBALS.site_url}/partnersite/?action=header" frameborder="0" scrolling="no" noresize="noresize" />
	<frame name="sjb_content" src="http://www.indeed.com/viewjob?{$query}" frameborder="0" scrolling="yes" noresize="noresize" />
</frameset>
</html>