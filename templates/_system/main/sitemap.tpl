<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
<meta name="keywords" content="[[$KEYWORDS]]" />
<meta name="description" content="[[$DESCRIPTION]]" />
<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>  	
<title>{$GLOBALS.settings.site_title}{if $TITLE ne ""}: [[$TITLE]]{/if}</title>
<link rel="StyleSheet" type="text/css" href="{$GLOBALS.site_url}/templates/_system/main/images/css/form.css" />
<link rel="StyleSheet" type="text/css" href="{image src="design.css"}" />
{if $GLOBALS.current_language_data.rightToLeft}<link rel="StyleSheet" type="text/css" href="{image src="designRight.css"}" />{/if}
<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="{$GLOBALS.site_url}/rss/" />
<link rel="stylesheet" href="{$GLOBALS.site_url}/system/lib/rating/style.css" type="text/css" />
<link rel="StyleSheet" type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css"  />
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.validate.min.js"></script>

{if $highlight_templates}
<!-- AJAX EDIT TEMPLATE SECTION -->
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
<script language="javascript" type="text/javascript">
{literal}
$(function() {

	$("div.inner_div").bind("mouseenter", function(){
		var width	= $(this).parent().css('width');
		var height	= $(this).parent().css('height');
		var offset	= $(this).parent().offset();

		// inner_block css-class z-index = 11
		// set highlight z-index = 10
		$("#highlighterBlock").css({
			'display':'block',
			'position':'absolute',
			'top':offset.top,
			'left':offset.left,
			'width':width,
			'height':height,
			'z-index': 10
		});
	});
	$("div.inner_div").bind("mouseleave", function(){
		$("#highlighterBlock").css({
			'display':'none'
		});
	});
	
	// lets catch clicks on 'edit template' links
	$("a.editTemplateLink").click(function() {
		//alert( $(this).attr('title'));
		var templateName	= $(this).attr('title');
		var link			= $(this).attr('href');
		editTemplateMenu(templateName, link);
		return false;
	});

	$(".editTemplateMenu").live('click', function() {
		var url = $(this).attr('href');
		popUpWindow(url, 700, 550, 'Edit Template', true);
		return false;
	});

	function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
		reloadPage = false;
		$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title,
			close: function(event, ui) {
				if(parentReload == true) {
						parent.document.location.reload();
				}
			}
		}).dialog( 'open' );
		
		$.get(url, function(data){
			$("#messageBox").html(data);  
		});
		return false;
	}


	function editTemplateMenu(templateName, url) {
		var title = 'Template';
		$("#messageBox").dialog( 'destroy' ).html('<b>Template Name:</b><br />' + templateName + '<br /><br /><a class="editTemplateMenu" style="font-weight: bold; color: #00f;" href="'+url+'" target="_blank">Edit this template</a>');
		$("#messageBox").dialog({
			width: 300,
			height: 150,
			modal: true,
			title: title
		}).dialog( 'open' );

		return false;
	}

});
{/literal}
</script>
<!-- END OF AJAX EDIT TEMPLATE SECTION -->
{/if}
{literal}
<style type="text/css">
*html img,
*html.png
{
  azimuth: expression(
    this.pngSet?
      this.pngSet=true : 
        (this.nodeName == "IMG" ? 
          (this.src.toLowerCase().indexOf('.png')>-1 ? 
            (this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')",
                this.src = "{/literal}{image}blank.gif{literal}") :
            '') :          
          (this.currentStyle.backgroundImage.toLowerCase().indexOf('.png')>-1) ?
            (this.origBg = (this.origBg) ? 
              this.origBg :             
              this.currentStyle.backgroundImage.toString().replace('url("','').replace('")',''),
              this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')",
              this.runtimeStyle.backgroundImage = "none") :
            ''
        ), this.pngSet=true
  );
}
</style>
{/literal}
	</head>
<body>
<div id="messageBox"></div>
{include file="../menu/header.tpl"}
<div id="siteMap">
	<h1>{$TITLE}</h1>
	{$ERRORS_CONTENT}
	{$MAIN_CONTENT}
</div>
{include file="../menu/footer.tpl"}
</body>
</html>
{if $highlight_templates}
<div id="highlighterBlock" style="display:none;background-color: #ccc; opacity: 0.5;"></div>
{/if}