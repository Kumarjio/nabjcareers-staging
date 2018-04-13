<?php  /* Smarty version 2.6.14, created on 2014-10-20 01:18:26
         compiled from index.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'index.tpl', 8, false),array('function', 'image', 'index.tpl', 13, false),array('function', 'module', 'index.tpl', 211, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<link alt="Asiameadiajobs.com: News" title="Asiameadiajobs.com: News" rel="image_src"  type="image/jpeg" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/icon-facebook.gif" />
<meta name="keywords" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['KEYWORDS'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['KEYWORDS'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
<meta name="description" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['DESCRIPTION'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['DESCRIPTION'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
<title><?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/news"): ?>Asiamediajobs.com: News<?php  elseif (! $this->_tpl_vars['GLOBALS']['page_not_found'] && ! $this->_tpl_vars['exp_listings_404_page']):   echo $this->_tpl_vars['GLOBALS']['settings']['site_title'];   endif;   if ($this->_tpl_vars['TITLE'] != ""):   if (! $this->_tpl_vars['GLOBALS']['page_not_found'] && ! $this->_tpl_vars['exp_listings_404_page']): ?>:<?php  endif; ?> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['TITLE'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></title>
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/css/form.css" />
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
" />
<?php  if ($this->_tpl_vars['GLOBALS']['current_language_data']['rightToLeft']): ?>
<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "designRight.css"), $this);?>
" />
<?php  endif; ?>
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
*html img,  *html.png {
 azimuth: expression(  this.pngSet?  this.pngSet=true : 
 (this.nodeName == "IMG" ?  (this.src.toLowerCase().indexOf(\'.png\')>-1 ?  (this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'" + this.src + "\', sizingMethod=\'image\')",  this.src = "';   echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
blank.gif<?php  echo '") :
 \'\') :          
 (this.currentStyle.backgroundImage.toLowerCase().indexOf(\'.png\')>-1) ?  (this.origBg = (this.origBg) ?  this.origBg :             
 this.currentStyle.backgroundImage.toString().replace(\'url("\', \'\').replace(\'")\', \'\'),  this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'" + this.origBg + "\', sizingMethod=\'crop\')",  this.runtimeStyle.backgroundImage = "none") :
 \'\'  ), this.pngSet=true  );
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
<div class="indexDiv"	<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/search-results-jobs/" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/search-results-resumes/" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/display-job" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/display-resume" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/company" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/browse-by-category" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/browse-by-city" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?> id="noPad"<?php  endif; ?>>
<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'breadcrumbs','function' => 'show_breadcrumbs'), $this);?>


	<?php  echo $this->_tpl_vars['ERRORS_CONTENT']; ?>


	<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>

</div>
<?php  if ($this->_tpl_vars['GLOBALS']['plugins']['ShareThisPlugin']['active'] == 1 && $this->_tpl_vars['GLOBALS']['settings']['display_for_all_pages'] == 1): ?>

	<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] != '/news' && $this->_tpl_vars['GLOBALS']['user_page_uri'] != '/display-job' && $this->_tpl_vars['GLOBALS']['user_page_uri'] != '/display-resume'): ?>
    <div id="shareThis"><?php  echo $this->_tpl_vars['GLOBALS']['settings']['header_code'];   echo $this->_tpl_vars['GLOBALS']['settings']['code']; ?>
</div>
<?php  endif; ?>

<?php  endif; ?>
<div id="grayBgBanner"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'banners','function' => 'show_banners','group' => 'Bottom Banners'), $this);?>
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