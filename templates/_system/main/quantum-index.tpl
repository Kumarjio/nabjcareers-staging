<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<link alt="Nabjcareers.org: News" title="Nabjcareers.org: News" rel="image_src"  type="image/jpeg" href="{$GLOBALS.site_url}/templates/_system/main/images/icon-facebook.gif" />
<title>{if $GLOBALS.user_page_uri == "/news"}Nabjcareers.org: News{elseif !$GLOBALS.page_not_found && !$exp_listings_404_page}{$GLOBALS.settings.site_title}{/if}{if $TITLE ne ""}{if !$GLOBALS.page_not_found && !$exp_listings_404_page}:{/if} [[$TITLE]]{/if}</title>
{literal}
<style type="text/css">
*html img,  *html.png {
 azimuth: expression(  this.pngSet?  this.pngSet=true : 
 (this.nodeName == "IMG" ?  (this.src.toLowerCase().indexOf('.png')>-1 ?  (this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')",  this.src = "{/literal}{image}blank.gif{literal}") :
 '') :          
 (this.currentStyle.backgroundImage.toLowerCase().indexOf('.png')>-1) ?  (this.origBg = (this.origBg) ?  this.origBg :             
 this.currentStyle.backgroundImage.toString().replace('url("', '').replace('")', ''),  this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')",  this.runtimeStyle.backgroundImage = "none") :
 ''  ), this.pngSet=true  );
}
</style>
{/literal}

<link rel="icon" href="http://nabjcareers.org/favicon.ico" type="image/x-icon"></link> 
<link rel="shortcut icon" href="http://nabjcareers.org/favicon.ico" type="image/x-icon"></link>

</head>

<body id="PageBody" onLoad="redirectParent()">
				
	<div id="messageBox"><div id="msgboxint"></div></div>
	
	<div class="indexDiv" >
		{module name="breadcrumbs" function="show_breadcrumbs"}
		{$ERRORS_CONTENT}	
		{$MAIN_CONTENT} 
		
	</div>
	</body>
</html>