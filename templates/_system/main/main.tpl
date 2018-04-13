<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns=http://www.w3.org/1999/xhtml xml:lang=en-US lang="en-US">
  <head>
   	<Meta name=keywords content="[[$KEYWORDS]]">
  	<Meta name=description content="[[$DESCRIPTION]]">  	
    <title>{$GLOBALS.settings.site_title}{if $TITLE ne ""}:&nbsp;&nbsp;[[$TITLE]] {/if}</title>
		<link rel="StyleSheet" type="text/css" href="{image src="design.css"}">
		<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="{$GLOBALS.site_url}/rss/">
		{literal}
		<style type="text/css" />
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
	<body />	
		<div class="headerpage">
		{include file="../menu/header.tpl"}	
		</div><div class="main">	
			{module name="menu" function="top_menu"}
			<div class="content">
				<div class="rightPanel">
				     <div class="rightPanelTitle">&nbsp;&nbsp;[[Jobs by Category]]</div>
					 {module name="classifieds" function="browse" level1Field="JobCategory" listing_type_id="Job" browse_template="browse_by_category.tpl"}
					 <div class="rightPanelTitle">&nbsp;&nbsp;[[Jobs by City]]</div>
					 {module name="classifieds" function="browse" level1Field="City" listing_type_id="Job" browse_template="browse_by_city.tpl"}
				</div>
				<div class="centerBlock">
						<div class="quickSearchKeep">{$MAIN_CONTENT}</div>
						<br />
						<div class="searchForm" style="border-left-style: none; border-top-style:solid;">
							<div class="headerText">[[Featured Companies]]
							</div>
							{module name="users" function="featured_profiles" number_of_rows="1" number_of_cols="4"}
						</div>
						<br />
						<div class="searchForm" style="border-left-style: none; border-top-style:solid;">
							<div class="headerText">[[Featured Jobs]]
							</div>
							{module name="classifieds" function="featured_listings" number_of_rows="1" number_of_cols="4" listing_type="Job"}
						</div>
						<br/>
						<!--- BLOCK -->
						<div class="bbb" style="float: left;">
									
							<img src="{image}employers_img.png" style="float: left;"/>
							<div style="width: 200px; float:left; margin-left: 20px;">
								<div style="font-size: 14pt; padding:0; margin-top:2px; padding-bottom:10px;">[[Employers]]</div>	
								<a href="{$GLOBALS.site_url}/registration/?user_group_id=Employer">[[Register]]</a><br/>
								<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job">[[Post a job]]</a><br/>
								<a href="{$GLOBALS.site_url}/search-resumes/">[[Search resumes]]</a><br/>
								<a href="{$GLOBALS.site_url}/resume-alerts/?action=new">[[Get resumes by email]]</a>
							</div>
						</div>
						<div class="bbb">
							<img src="{image}jobseekers_img.png" / style="float: left;">
							<div style="width: 200px; float:left; margin-left: 20px;">
								<div style="font-size: 14pt; padding:0; margin-top:2px; padding-bottom:10px;">[[Job Seekers]]</div>	
								<a href="{$GLOBALS.site_url}/registration/?user_group_id=JobSeeker">[[Register]]</a><br/>
								<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume">[[Post resumes]]</a><br/>
								<a href="{$GLOBALS.site_url}/find-jobs/">[[Find jobs]]</a><br/>
								<a href="{$GLOBALS.site_url}/job-alerts/?action=new">[[Get jobs by email]]</a>
							</div>
						</div>
						<!--- END -->
						<br/>
						<div class="searchForm" style="border-left-style: none; border-top-style:solid; float: left; margin-top:15px;">			
								<div class="RSSBlock">
										<p style="padiing:0px; margin:0px; float: left; width: 90px;">
											<a href="{$GLOBALS.site_url}/rss">[[RSS Feed]]</a>
										</p> 
										<img src="{image}rss_icon.png" style="float:right; margin-right:5px;"/>
									</div>
								<div class="headerText">[[Latest Jobs]]
								</div>							
								{module name="classifieds" function="latest_listings" count_listing="4" number_of_rows="1" number_of_cols="4" listing_type="Job"}
						</div>
				</div>
			</div>
			<div class="footerBlock" style="clear:both;">
				<div style="width: 5px; height: 38px; float:left; background-image:url('{image}footer_left_angle.png')"></div>
				<div style="width: 5px; height: 38px; float:right; background-image:url('{image}footer_right_angle.png')"></div>
				<div class="copyright">
					<br />
					[[powered by]] <a target="_blank" href="http://www.smartjobboard.com" title="job board software script">SmartJobBoard</a>
				</div>
			</div>
		</div>
	</body>
</html>