<?php  /* Smarty version 2.6.14, created on 2014-10-20 20:24:04
         compiled from sitemap.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'sitemap.tpl', 5, false),array('function', 'image', 'sitemap.tpl', 10, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
<meta name="keywords" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['KEYWORDS'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['KEYWORDS'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
<meta name="description" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['DESCRIPTION'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['DESCRIPTION'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>  	
<title><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title'];   if ($this->_tpl_vars['TITLE'] != ""): ?>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['TITLE'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></title>
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/css/form.css" />
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
" />
<?php  if ($this->_tpl_vars['GLOBALS']['current_language_data']['rightToLeft']): ?><link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "designRight.css"), $this);?>
" /><?php  endif; ?>
<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/rss/" />
<link rel="stylesheet" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/lib/rating/style.css" type="text/css" />
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/css/jquery-ui.css"  />
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.validate.min.js"></script>

<?php  if ($this->_tpl_vars['highlight_templates']): ?>
<!-- AJAX EDIT TEMPLATE SECTION -->
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<script language="javascript" type="text/javascript">
<?php  echo '
$(function() {

	$("div.inner_div").bind("mouseenter", function(){
		var width	= $(this).parent().css(\'width\');
		var height	= $(this).parent().css(\'height\');
		var offset	= $(this).parent().offset();

		// inner_block css-class z-index = 11
		// set highlight z-index = 10
		$("#highlighterBlock").css({
			\'display\':\'block\',
			\'position\':\'absolute\',
			\'top\':offset.top,
			\'left\':offset.left,
			\'width\':width,
			\'height\':height,
			\'z-index\': 10
		});
	});
	$("div.inner_div").bind("mouseleave", function(){
		$("#highlighterBlock").css({
			\'display\':\'none\'
		});
	});
	
	// lets catch clicks on \'edit template\' links
	$("a.editTemplateLink").click(function() {
		//alert( $(this).attr(\'title\'));
		var templateName	= $(this).attr(\'title\');
		var link			= $(this).attr(\'href\');
		editTemplateMenu(templateName, link);
		return false;
	});

	$(".editTemplateMenu").live(\'click\', function() {
		var url = $(this).attr(\'href\');
		popUpWindow(url, 700, 550, \'Edit Template\', true);
		return false;
	});

	function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
		reloadPage = false;
		$("#messageBox").dialog( \'destroy\' ).html(\''; ?>
<img style="vertical-align: middle;" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
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
		}).dialog( \'open\' );
		
		$.get(url, function(data){
			$("#messageBox").html(data);  
		});
		return false;
	}


	function editTemplateMenu(templateName, url) {
		var title = \'Template\';
		$("#messageBox").dialog( \'destroy\' ).html(\'<b>Template Name:</b><br />\' + templateName + \'<br /><br /><a class="editTemplateMenu" style="font-weight: bold; color: #00f;" href="\'+url+\'" target="_blank">Edit this template</a>\');
		$("#messageBox").dialog({
			width: 300,
			height: 150,
			modal: true,
			title: title
		}).dialog( \'open\' );

		return false;
	}

});
'; ?>

</script>
<!-- END OF AJAX EDIT TEMPLATE SECTION -->
<?php  endif; ?>
<?php  echo '
<style type="text/css">
*html img,
*html.png
{
  azimuth: expression(
    this.pngSet?
      this.pngSet=true : 
        (this.nodeName == "IMG" ? 
          (this.src.toLowerCase().indexOf(\'.png\')>-1 ? 
            (this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'" + this.src + "\', sizingMethod=\'image\')",
                this.src = "';   echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
blank.gif<?php  echo '") :
            \'\') :          
          (this.currentStyle.backgroundImage.toLowerCase().indexOf(\'.png\')>-1) ?
            (this.origBg = (this.origBg) ? 
              this.origBg :             
              this.currentStyle.backgroundImage.toString().replace(\'url("\',\'\').replace(\'")\',\'\'),
              this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'" + this.origBg + "\', sizingMethod=\'crop\')",
              this.runtimeStyle.backgroundImage = "none") :
            \'\'
        ), this.pngSet=true
  );
}
</style>
'; ?>

	</head>
<body>
<div id="messageBox"></div>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../menu/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="siteMap">
	<h1><?php  echo $this->_tpl_vars['TITLE']; ?>
</h1>
	<?php  echo $this->_tpl_vars['ERRORS_CONTENT']; ?>

	<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>

</div>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../menu/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>
<?php  if ($this->_tpl_vars['highlight_templates']): ?>
<div id="highlighterBlock" style="display:none;background-color: #ccc; opacity: 0.5;"></div>
<?php  endif; ?>