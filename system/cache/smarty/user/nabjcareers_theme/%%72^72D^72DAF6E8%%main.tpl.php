<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:36:01
         compiled from main.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'main.tpl', 13, false),array('function', 'image', 'main.tpl', 23, false),array('function', 'module', 'main.tpl', 308, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

  <head>



<link alt="Asiameadiajobs.com: News" title="Asiameadiajobs.com: News" rel="image_src"  type="image/jpeg" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/icon-facebook.gif" />

<meta name="keywords" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['KEYWORDS'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['KEYWORDS'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />

<meta name="description" content="<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['DESCRIPTION'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['DESCRIPTION'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />

<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>  	

<title><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title'];   if ($this->_tpl_vars['TITLE'] != ""): ?>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['TITLE'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  endif; ?></title>

<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/css/form.css" />

<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "design.css"), $this);?>
" />

<?php  if ($this->_tpl_vars['GLOBALS']['current_language_data']['rightToLeft']): ?><link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "designRight.css"), $this);?>
" /><?php  endif; ?>

<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/rss/" />

<?php  if ($this->_tpl_vars['highlight_templates']): ?>

<!-- AJAX EDIT TEMPLATE SECTION -->

<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/css/jquery-ui.css"  />

<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.js"></script>

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



	$("a.editTemplateMenu").live(\'click\', function() {

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
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher:\'dc1d43a6-e554-4b53-8d4f-9e82edc64815\'});</script>
		'; ?>


<link rel="icon" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/favicon.ico" type="image/x-icon"></link> 
<link rel="shortcut icon" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/favicon.ico" type="image/x-icon"></link>













	<!-- link rel="stylesheet" type="text/css" href="http://nabj.org/global_inc/site_templates/YM-OR-01/combined.css?_v=1.64.102.250&context=hp"/>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/container/assets/skins/sam/container.css" -->
	<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/nabjcareers_theme/nabj_org_elements/global_inc/site_templates/YM-OR-01/ie.css"><![endif]-->

		

		<!-- script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/dragdrop/dragdrop-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/container/container-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/json/json-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>	
		<script type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/nabjcareers_theme/nabj_org_elements/combined.js?context=hp&_v=1.45"></script -->
 	
















	</head>
<body id="PageBody">

<div id="messageBox"></div>

<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../menu/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="leftColumn">

									<div class="loginFormTop"><span><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign In<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></div>
								
										<div class="loginFormBg">
								
											<br/><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login','template' => "login.tpl",'internal' => 'true'), $this);?>
<br/>
								
										</div>
								
										<div class="loginFormBottom"> </div>
								
										<div class="clr"><br/></div>
		
		<h1 class="Companies"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Featured Companies<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>

		<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'featured_profiles','number_of_rows' => '4','number_of_cols' => '1','count_listing' => '4'), $this);?>


	</div>

	<div class="mainColumn">

		<?php  echo $this->_tpl_vars['MAIN_CONTENT']; ?>


		<div class="JobSeekerBlock">

			<div class="JobSeekerBlockTop"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Seekers<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

			<div class="JobSeekerBlockBg">

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/registration/?user_group_id=JobSeeker"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Resume"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/find-jobs/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/job-alerts/?action=new"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Get jobs by email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<br/>

			</div>

			<div class="JobSeekerBlockBottom"> </div>

		</div>

		

		<div class="EmployerBlock">

			<div class="EmployerBlockTop"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Employers<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

			<div class="EmployerBlockBg">

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/registration/?user_group_id=Employer"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/resume-alerts/?action=new"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Get resumes by email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>

				<br/>

			</div>

			<div class="EmployerBlockBottom"> </div>

		</div>

		<div class="clr"><br/></div>

		

		<div class="featuredJobsTop"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Featured Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

		<div class="featuredJobs"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'classifieds','function' => 'featured_listings','count_listing' => '999','listing_type' => 'Job'), $this);?>
</div>

		<div class="featuredJobsBottom"> </div>

		<div class="clr"><br/></div>

		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-feeds/?feedId=10" id="mainRss">RSS</a>

		<div class="latestJobsTop"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Latest Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

		<div class="latestJobs"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'classifieds','function' => 'latest_listings','count_listing' => '4','listing_type' => 'Job'), $this);?>
</div>

		<div class="latestJobsBottom"> </div>

		<div class="clr"><br/></div>

		

		<?php  if ($this->_tpl_vars['GLOBALS']['settings']['display_blog_on_homepage']): ?>

		<div class="blogTop"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Blog Posts<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

		<div class="featuredJobs">

			<br/><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'miscellaneous','function' => 'blog_page'), $this);?>
<br/>

		</div>

		<div class="featuredJobsBottom"> </div>

		<?php  endif; ?>

		
	</div>

	<div class="rightColumn">

		<?php  if ($this->_tpl_vars['GLOBALS']['settings']['show_news_on_main_page']): ?>
			<h1 class="Category"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>News<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
			<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'news','function' => 'show_news'), $this);?>

		<?php  endif; ?>
		

		
		<h1 class="Category"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Jobs by Category<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
		<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'classifieds','function' => 'browse','level1Field' => 'JobCategory','listing_type_id' => 'Job','browse_template' => "browse_by_category.tpl"), $this);?>

		<div class="clr"><br/></div>
		<h1 class="Category"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Jobs by City<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
		<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'classifieds','function' => 'browse','level1Field' => 'City','listing_type_id' => 'Job','browse_template' => "browse_by_city.tpl"), $this);?>

	</div>



	<div class="clr"><br/></div>

	<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'banners','function' => 'show_banners','group' => 'Bottom Banners'), $this);?>
	

		<span class="st_email"></span>
		<span class="st_facebook"></span>
		<span class="st_twitter"></span>
		<span class="st_sharethis" displayText="ShareThis"></span>

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