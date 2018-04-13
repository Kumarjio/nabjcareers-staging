<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

  <head>



<link alt="Asiameadiajobs.com: News" title="Asiameadiajobs.com: News" rel="image_src"  type="image/jpeg" href="{$GLOBALS.site_url}/templates/_system/main/images/icon-facebook.gif" />

<meta name="keywords" content="[[$KEYWORDS]]" />

<meta name="description" content="[[$DESCRIPTION]]" />

<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>  	

<title>{$GLOBALS.settings.site_title}{if $TITLE ne ""}: [[$TITLE]] {/if}</title>

<link rel="StyleSheet" type="text/css" href="{$GLOBALS.site_url}/templates/_system/main/images/css/form.css" />

<link rel="StyleSheet" type="text/css" href="{image src="design.css"}" />

{if $GLOBALS.current_language_data.rightToLeft}<link rel="StyleSheet" type="text/css" href="{image src="designRight.css"}" />{/if}

<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="{$GLOBALS.site_url}/rss/" />

{if $highlight_templates}

<!-- AJAX EDIT TEMPLATE SECTION -->

<link rel="StyleSheet" type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css"  />

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.js"></script>

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



	$("a.editTemplateMenu").live('click', function() {

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
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher:'dc1d43a6-e554-4b53-8d4f-9e82edc64815'});</script>
		{/literal}

<link rel="icon" href="{$GLOBALS.site_url}/favicon.ico" type="image/x-icon"></link> 
<link rel="shortcut icon" href="{$GLOBALS.site_url}/favicon.ico" type="image/x-icon"></link>













	<!-- link rel="stylesheet" type="text/css" href="http://nabj.org/global_inc/site_templates/YM-OR-01/combined.css?_v=1.64.102.250&context=hp"/>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/container/assets/skins/sam/container.css" -->
	<!--[if IE]><link rel="stylesheet" type="text/css" href="{$GLOBALS.site_url}/templates/nabjcareers_theme/nabj_org_elements/global_inc/site_templates/YM-OR-01/ie.css"><![endif]-->

		

		<!-- script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/dragdrop/dragdrop-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/container/container-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/yui/2.9.0/build/json/json-min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>	
		<script type="text/javascript" src="{$GLOBALS.site_url}/templates/nabjcareers_theme/nabj_org_elements/combined.js?context=hp&_v=1.45"></script -->
 	
















	</head>
<body id="PageBody">

<div id="messageBox"></div>

{include file="../menu/header.tpl"}

	<div class="leftColumn">

									<div class="loginFormTop"><span>[[Sign In]]</span></div>
								
										<div class="loginFormBg">
								
											<br/>{module name="users" function="login" template="login.tpl" internal="true"}<br/>
								
										</div>
								
										<div class="loginFormBottom"> </div>
								
										<div class="clr"><br/></div>
		
		<h1 class="Companies">[[Featured Companies]]</h1>

		{module name="users" function="featured_profiles" number_of_rows="4" number_of_cols="1" count_listing="4"}

	</div>

	<div class="mainColumn">

		{$MAIN_CONTENT}

		<div class="JobSeekerBlock">

			<div class="JobSeekerBlockTop">[[Job Seekers]]</div>

			<div class="JobSeekerBlockBg">

				<p><a href="{$GLOBALS.site_url}/registration/?user_group_id=JobSeeker">[[Register]]</a></p>

				<p><a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume">[[Post resumes]]</a></p>

				<p><a href="{$GLOBALS.site_url}/find-jobs/">[[Find jobs]]</a></p>

				<p><a href="{$GLOBALS.site_url}/job-alerts/?action=new">[[Get jobs by email]]</a></p>

				<br/>

			</div>

			<div class="JobSeekerBlockBottom"> </div>

		</div>

		

		<div class="EmployerBlock">

			<div class="EmployerBlockTop">[[Employers]]</div>

			<div class="EmployerBlockBg">

				<p><a href="{$GLOBALS.site_url}/registration/?user_group_id=Employer">[[Register]]</a></p>

				<p><a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job">[[Post jobs]]</a></p>

				<p><a href="{$GLOBALS.site_url}/search-resumes/">[[Search resumes]]</a></p>

				<p><a href="{$GLOBALS.site_url}/resume-alerts/?action=new">[[Get resumes by email]]</a></p>

				<br/>

			</div>

			<div class="EmployerBlockBottom"> </div>

		</div>

		<div class="clr"><br/></div>

		

		<div class="featuredJobsTop">[[Featured Jobs]]</div>

		<div class="featuredJobs">{module name="classifieds" function="featured_listings" count_listing="999" listing_type="Job"}</div>

		<div class="featuredJobsBottom"> </div>

		<div class="clr"><br/></div>

		<a href="{$GLOBALS.site_url}/listing-feeds/?feedId=10" id="mainRss">RSS</a>

		<div class="latestJobsTop">[[Latest Jobs]]</div>

		<div class="latestJobs">{module name="classifieds" function="latest_listings" count_listing="4" listing_type="Job"}</div>

		<div class="latestJobsBottom"> </div>

		<div class="clr"><br/></div>

		

		{if $GLOBALS.settings.display_blog_on_homepage}

		<div class="blogTop">[[Blog Posts]]</div>

		<div class="featuredJobs">

			<br/>{module name="miscellaneous" function="blog_page"}<br/>

		</div>

		<div class="featuredJobsBottom"> </div>

		{/if}

		
{*		<span class="st_email"></span>
		<span class="st_facebook"></span>
		<span class="st_twitter"></span>
		<span class="st_sharethis" displayText="ShareThis"></span> *}
	</div>

	<div class="rightColumn">

		{if $GLOBALS.settings.show_news_on_main_page}
			<h1 class="Category">[[News]]</h1>
			{module name="news" function="show_news"}
		{/if}
		

		
		<h1 class="Category">[[Jobs by Category]]</h1>
		{module name="classifieds" function="browse" level1Field="JobCategory" listing_type_id="Job" browse_template="browse_by_category.tpl"}
		<div class="clr"><br/></div>
		<h1 class="Category">[[Jobs by City]]</h1>
		{module name="classifieds" function="browse" level1Field="City" listing_type_id="Job" browse_template="browse_by_city.tpl"}
	</div>



	<div class="clr"><br/></div>

	{module name="banners" function="show_banners" group="Bottom Banners"}	

		<span class="st_email"></span>
		<span class="st_facebook"></span>
		<span class="st_twitter"></span>
		<span class="st_sharethis" displayText="ShareThis"></span>

{include file="../menu/footer.tpl"}

</body>

</html>



{if $highlight_templates}

<div id="highlighterBlock" style="display:none;background-color: #ccc; opacity: 0.5;"></div>

{/if}