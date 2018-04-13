<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	    <title>{$GLOBALS.settings.site_title} {if $TITLE ne ""} :: [[{$TITLE}]] {/if}</title>
		<link rel="StyleSheet" type="text/css" href="{image src="design.css"}">
		{if $GLOBALS.current_language_data.rightToLeft}<link rel="StyleSheet" type="text/css" href="{image src="designRight.css"}" />{/if}
		<style type="text/css">
		body {literal}{{/literal}		    margin: 0px;	    {literal}}{/literal}
		    TD.middle_head {literal}{{/literal}
			    BORDER-RIGHT: #cccccc 1px solid; 
			    BORDER-TOP: #cccccc 1px solid; 
			    FONT-WEIGHT: bold; FONT-SIZE: 18px; BACKGROUND-IMAGE: url({image src="gradient.gif"}); 
			    BORDER-LEFT: #cccccc 1px solid; 
			    BORDER-BOTTOM: #cccccc 1px solid; 
			    BACKGROUND-REPEAT: repeat-x; HEIGHT: 30px;
		    {literal}}{/literal}
		</style>
	</head>
	<body>
		{$ERRORS_CONTENT}
		{$MAIN_CONTENT}
	</body>
</html>