<img src="{image}icon-facebook.png" border="0" alt="News" title="News" style="position: absolute" width="1" height="1" />
<div class="MainDiv">
	<div id="LeaderContentArea">
		<div id="leader-container">
			<div id="leader-toolbar">
				<div id="toolbar-links">	
					<a href="http://www.nabj.org/general/?type=CONTACT">Contact Us</a> | 
					<a href="http://www.nabj.org/donations/">Donate</a>
						
									</div>
				</div>
				<div style="text-align: center;" id="leader-head"><br>
				</div>
			</div>
		</div> 
	<div class="headerPage">
		<table id="PageContainer" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td id="Toolbar_bg">
					<div id="Toolbar">
						<a id="PrintPage" href="http://www.nabj.org#" onclick="return false;" title="Print view will be available once the page has finished loading.">
							<img src="http://www.nabj.org/global_graphics/icons/print_bw.gif" align="left" border="0" height="16" width="16">Print to Page
						</a>
						{literal}<script type='text/javascript'>function PrintPageClickHandler(){this.handleEvent = createPrintPagePopup }PrintPage_OnClick = new PrintPageClickHandler(); addEventHandler_OnLoad(function(){ var element = document.getElementById("PrintPage"); if(element) { element.onclick = PrintPage_OnClick.handleEvent; element.title = "Print Page";} });</script>{/literal}
						 &nbsp; | &nbsp; <a href='/general/?type=CONTACT'>Contact Us</a> &nbsp; | &nbsp; <a href='/store/your_cart.asp'>Your Cart</a> &nbsp; | &nbsp; <a href='/login.aspx'>Sign In</a> &nbsp; | &nbsp; <a href='/general/register_start.asp'>Register</a>
					</div>
				</td>
			</tr>
			<tr>
				<td id="Head">
					<div id="headercontainer">
						<a href="http://www.nabj.org/" id="logo"></a>
						<a href="http://www.mjfellows.org" target="_blank" id="banner"></a>
					</div>
	
				{literal}	<style type="text/css">
				      #Head
				      {
				          background-image: url('http://www.nabj.org/graphics/bg_top.gif');
				      }
				 	</style>{/literal}
				</td>
			</tr>
			<tr>
				<td id="MainMenu">
					<div id="FrontendMainMenu" class="radmenu RadMenu_YMPublic ">
						 
						<script type="text/javascript" src="{$GLOBALS.site_url}/templates/nabjcareers_theme/nabj_org_elements/global_inc/RadControls/Menu/Scripts/4_3_2/RadMenu.js"></script>
						<span id="FrontendMainMenuStyleSheetHolder" style="display:none;"></span>
						
						
						<script type="text/javascript">{literal}RadControlsNamespace.AppendStyleSheet(false, 'FrontendMainMenu', '{/literal}{$GLOBALS.site_url}{literal}/templates/nabjcareers_theme/nabj_org_elements/global_inc/RadControls/Menu/Scripts/4_3_2/menu.css');{/literal}</script>	
						
						
						
						
						<script>{literal}
							sfHover = function() { 
							    var sfEls = document.getElementById("nav").getElementsByTagName("LI"); 
							    for (var i=0; i<sfEls.length; i++) { 
							        sfEls[i].onmouseover=function() { 
							            this.className+=" sfhover";
							            // $(this).toggle( "fold", 1000 ); 
							        } 
							        sfEls[i].onmouseout=function() { 
							            this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
							            // $(this).toggle( "fold", 1000 ); 
							        } 
							    } 
							} 
							if (window.attachEvent) window.attachEvent("onload", sfHover);						
						{/literal}</script>
						
						
						
						<ul class="horizontal rootGroup" id="nav">
							<li class="item first">
								<a href="http://www.nabj.org/" id="FrontendMainMenu_m0" class="link"><span class="text">Home</span></a>
							</li>
							<li id="menu_about_l1" class="item">
								<a href="http://www.nabj.org/?page=History" id="FrontendMainMenu_m1" class="link"><span class="text">About</span></a>
								
									<ul class="vertical group level1 menu_about_l2">
										<li class="item first">
											<a href="http://www.nabj.org/?page=presidentscorner" id="FrontendMainMenu_m1_m0" class="link"><span class="text">The President's Corner</span></a></li>
										<li class="item menu_history_l2">
											<a href="http://www.nabj.org/?page=History" id="FrontendMainMenu_m1_m1" class="link menu_history_l2"><span class="arrow text expandRight">History / Mission</span></a>
								
								
												<ul id="grandchild" class="vertical group level2 menu_history_l3">
													<li class="item first"><a href="http://www.nabj.org/?page=Founders" id="FrontendMainMenu_m1_m1_m0" class="link"><span class="text">Founders</span></a></li>
													<li class="item last"><a href="http://www.nabj.org/?Presidents" id="FrontendMainMenu_m1_m1_m1" class="link"><span class="text">Presidents</span></a></li>
													
													<li class="item"><a href="http://www.nabj.org/?page=CommittedCause" id="FrontendMainMenu_m1_m1_m2" class="link"><span class="text">Committed to the Cause</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?LifetimeMembers" id="FrontendMainMenu_m1_m1_m3" class="link"><span class="text">Lifetime Members</span></a></li>
													<li class="item last"><a href="http://www.nabj.org/?NABJConventions" id="FrontendMainMenu_m1_m1_m4" class="link"><span class="text">Conventions</span></a></li>		
												</ul>
								
										</li>
										<li class="item">
											<a href="http://www.nabj.org/?page=Constitution" id="FrontendMainMenu_m1_m2" class="link"><span class="text">Constitution</span></a>
										</li>
										<li class="item">
											<a href="http://www.nabj.org/?page=OperatingProcedures" id="FrontendMainMenu_m1_m3" class="link"><span class="text">Operating Procedures</span></a>
										</li><li class="item">
											<a href="http://www.nabj.org/?page=Board" id="FrontendMainMenu_m1_m4" class="link"><span class="text">Board of Directors</span></a>
										</li>
										<li class="item">
											<a href="#" id="FrontendMainMenu_m1_m5" class="link"><span class="arrow text">Regions/Chapters</span></a>
								
												<ul class="vertical group level2">
													<li class="item first">
														<a href="http://www.nabj.org/members/group_select.asp" id="FrontendMainMenu_m1_m5_m0" class="link"><span class="text">Find a Group</span></a>
													</li>
													<li class="item"><a href="http://www.nabj.org/groupmenu/" id="FrontendMainMenu_m1_m5_m1" class="link"><span class="text">Groups</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=RegionMap" id="FrontendMainMenu_m1_m5_m2" class="link"><span class="text">Region Map</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=regionI" id="FrontendMainMenu_m1_m5_m3" class="link"><span class="text">Region I</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=RegionII" id="FrontendMainMenu_m1_m5_m4" class="link"><span class="text">Region II</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=RegionIII" id="FrontendMainMenu_m1_m5_m5" class="link"><span class="text">Region III</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=RegionIV" id="FrontendMainMenu_m1_m5_m6" class="link"><span class="text">Region IV</span></a></li>
													
													<li class="item"><a href="http://www.nabj.org/?page=becomechapter" id="FrontendMainMenu_m1_m5_m9" class="link"><span class="text">Chapters</span></a></li>
													<li class="item"><a href="http://www.nabj.org/resource/resmgr/chapters/nabj_chapter_handbook.vers11.pdf" target="_blank" id="FrontendMainMenu_m1_m5_m10" class="link"><span class="text">Chapter Handbook</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?ChapterUpdateForm" target="_blank" id="FrontendMainMenu_m1_m5_m11" class="link"><span class="text">Chapter Update Form</span></a></li>
													<li class="item last"><a href="http://www.nabj.org/?chapterresources" id="FrontendMainMenu_m1_m5_m12" class="link"><span class="text">Chapter Resources</span></a></li>
												</ul>
		
										</li>
										<li class="item"><a href="http://www.nabj.org/?page=Committees" id="FrontendMainMenu_m1_m6" class="link"><span class="text">Committees</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=TaskForces" id="FrontendMainMenu_m1_m7" class="link"><span class="text">Task Forces</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=Staff" id="FrontendMainMenu_m1_m8" class="link"><span class="text">Staff</span></a></li>
										<li class="item last"><a href="http://www.nabj.org/?page=AnnualReports" id="FrontendMainMenu_m1_m9" class="link"><span class="text">Annual Reports</span></a></li>
									</ul>						
							</li>
													
							<li class="item menu_members_l1"><a href="http://www.nabj.org/general/register_member_type.asp?" id="FrontendMainMenu_m2" class="link"><span class="text">Members/Join</span></a>		
									<ul class="vertical group level1 menu_members_l2">
										<li class="item first">
											<a href="http://www.nabj.org/general/register_member_type.asp?" id="FrontendMainMenu_m2_m0" class="link"><span class="arrow text">Join NABJ</span></a>
										
												<ul class="vertical group level2">
													<li class="item first last"><a href="http://www.nabj.org/?page=NABJMemberBenefits" id="FrontendMainMenu_m2_m0_m0" class="link"><span class="text">Member Benefits</span></a></li>
													
													<li class="item"><a href="http://www.nabj.org/general/register_member_type.asp" id="FrontendMainMenu_m2_m0_m1" class="link"><span class="text">Join NABJ Online</span></a></li>
													<li class="item last"><a href="https://c.ymcdn.com/sites/nabj.site-ym.com/resource/resmgr/Membership/NABJ_Membership_Application.pdf" id="FrontendMainMenu_m2_m0_m2" class="link"><span class="text">Membership Application PDF</span></a></li>
												</ul>		
		
		
										</li>
										<li class="item"><a href="http://www.nabj.org/login.aspx" id="FrontendMainMenu_m2_m1" class="link"><span class="text">Renew</span></a></li>
										<li class="item"><a href="#" target="_blank" id="FrontendMainMenu_m2_m2" class="link"><span class="arrow text">Members Only</span></a>
												<ul class="vertical group level2">
													<li class="item first"><a href="http://www.nabj.org/?page=nabjjournal" id="FrontendMainMenu_m2_m2_m0" class="link"><span class="text">NABJ Journal</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=NABJTownHall" id="FrontendMainMenu_m2_m2_m1" class="link"><span class="text">State of NABJ Town Hall</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?meetingminutes" target="_blank" id="FrontendMainMenu_m2_m2_m2" class="link"><span class="text">Meeting Minutes</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=BusinessReports" id="FrontendMainMenu_m2_m2_m3" class="link"><span class="text">Business Reports</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=MemberBenefits" target="_blank" id="FrontendMainMenu_m2_m2_m4" class="link"><span class="text">Member Benefits</span></a></li>
													<li class="item"><a href="http://www.nabj.org/?page=JobsBank" id="FrontendMainMenu_m2_m2_m5" class="link"><span class="text">NABJ Jobs Online</span></a></li>
													<li class="item last"><a href="http://groups.yahoo.com/group/nabjforum/" target="_blank" id="FrontendMainMenu_m2_m2_m6" class="link"><span class="text">NABJ Forum (Listserve)</span></a></li>
												</ul>
		
										</li>
										<li class="item"><a href="#" id="FrontendMainMenu_m2_m3" class="link"><span class="arrow text">Interactive</span></a>	
											<ul class="vertical group level2">
												<li class="item first"><a href="http://www.facebook.com/group.php?gid=2204566906" target="_blank" id="FrontendMainMenu_m2_m3_m0" class="link"><span class="text">Facebook</span></a></li>
												<li class="item"><a href="http://www.linkedin.com/groups?about=&amp;gid=56785&amp;goback=.anb_56785_*2&amp;report.success=r3Tayp0nRRro3Er8iWS8vO-u_mFd11ndGIOEdAI27ES3KgpplepkOcIgotS3mJWzXqb2u21wqjDJwM" target="_blank" id="FrontendMainMenu_m2_m3_m1" class="link"><span class="text">LinkedIn</span></a></li>
												<li class="item last"><a href="http://twitter.com/nabj" target="_blank" id="FrontendMainMenu_m2_m3_m2" class="link"><span class="text">Twitter</span></a></li>
											</ul>		
										</li>
										<li class="item last"><a href="http://www.nabj.org/events/event_list.asp" id="FrontendMainMenu_m2_m4" class="link"><span class="text">Calendar</span></a></li>
									</ul>
							</li>
						
							<li class="item menu_students_l1">
								<a href="http://www.nabj.org/?SEEDOverview" id="FrontendMainMenu_m3" class="link"><span class="text">Students</span></a>						
									<ul class="vertical group level1 menu_students_l2">
										<li class="item first"><a href="http://www.nabj.org/?SEEDOverview" id="FrontendMainMenu_m3_m0" class="link"><span class="text">SEED Overview</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?SEEDScholars2013" id="FrontendMainMenu_m3_m1" class="link"><span class="text">Scholarships</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=internships" id="FrontendMainMenu_m3_m2" class="link"><span class="text">Internships</span></a></li>
											<ul class="vertical group level2">
												<li class="item first last"><a href="http://www.nabj.org/?16StuScottInterns" id="FrontendMainMenu_m3_m2_m0" class="link"><span class="text">Stuart Scott Internship</span></a></li>
											</ul>										
										<li class="item"><a href="http://www.nabj.org/?page=famushortcourse" id="FrontendMainMenu_m3_m3" class="link"><span class="text">FAMU Short Course</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=AfricanFellowships" id="FrontendMainMenu_m3_m4" class="link"><span class="text">Young African Journalists </span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=SEEDncshortcourse1" id="FrontendMainMenu_m3_m4" class="link"><span class="text">NC A&T Short Course</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?SEEDstudentproject14" id="FrontendMainMenu_m3_m5" class="link"><span class="arrow text">Student Multimedia Project</span></a>
											<ul class="vertical group level2">
												<li class="item first"><a href="http://nabjmonitor.org/2013/" id="FrontendMainMenu_m3_m5_m0" class="link"><span class="text">NABJ Monitor</span></a></li>
												<li class="item last"><a href="http://www.nabj.org/?page=SEEDstudentp13" id="FrontendMainMenu_m3_m5_m1" class="link"><span class="text">2013</span></a></li>
											</ul>
						
										</li>
										<li class="item last"><a href="http://www.nabj.org/?page=HighSchoolWorkshop" id="FrontendMainMenu_m3_m6" class="link"><span class="arrow text">High School Workshop</span></a>
								
												<ul class="vertical group level2">
													<li class="item first last"><a href="http://highschool.nabjconvention.org/" id="FrontendMainMenu_m3_m6_m0" class="link"><span class="text">JSHOP Reporter</span></a></li>
												</ul>
								
										</li>
									</ul>
								
							</li>
				
							
							<li class="item menu_media_l1"><a href="http://www.nabj.org/?page=MediaContact" id="FrontendMainMenu_m4" class="link"><span class="text">Media/News</span></a>
							
									<ul class="vertical group level1 menu_media_l2">
										<li class="item first"><a href="http://www.nabj.org/?page=MediaContact" id="FrontendMainMenu_m4_m0" class="link"><span class="text">Media Contact</span></a></li>
										<li class="item"><a href="http://www.nabj.org/news/?id=3202" id="FrontendMainMenu_m4_m1" class="link"><span class="text">NABJ News</span></a></li>
										<li class="item"><a href="http://www.nabj.org/resource/resmgr/Ads/Advertise_with_NABJ.14.pdf" id="FrontendMainMenu_m4_m2" class="link"><span class="text">Advertise With NABJ</span></a></li>
										<li class="item"><a href="http://www.nabj.org/news/default.asp?id=4987" id="FrontendMainMenu_m4_m3" class="link"><span class="text">Members On The Move</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?page=nabjjournal" id="FrontendMainMenu_m4_m4" class="link"><span class="text">NABJ Journal</span></a></li>
										<li class="item"><a href="#" id="FrontendMainMenu_m4_m5" class="link"><span class="text">NABJ Photo Gallery</span></a></li>
										<li class="item"><a href="http://www.youtube.com/user/nabjofficial?feature=results_main" id="FrontendMainMenu_m4_m6" class="link"><span class="text">NABJ Video</span></a></li>
										<li class="item"><a href="#" id="FrontendMainMenu_m4_m7" class="link"><span class="text">NABJ Social Media</span></a></li>
										<li class="item"><a href="http://www.nabj.org/?styleguide" id="FrontendMainMenu_m4_m8" class="link"><span class="text">NABJ Style Guide</span></a></li>
										<li class="item last"><a href="http://www.nabj.org/news/103235/NABJ-Releases-2012-Television-Newsroom-Management-and-Network-Diversity-Census.htm" id="FrontendMainMenu_m4_m9" class="link"><span class="text">2012 NABJ Diversity Census</span></a></li>
									</ul>
								
							</li>
							
							
							
							<li class="item menu_convention_l1"><a href="http://www.nabj.org/?2015Convention" id="FrontendMainMenu_m5" class="link"><span class="text">Convention</span></a>
							
									<ul class="vertical group level1 menu_convention_l2">
										<li class="item first"><a href="http://www.nabjnahj.com/" id="FrontendMainMenu_m5_m0" class="link"><span class="text">2016 - Washington, DC</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="http://www.nabj.org/event/nabjregistration2016" id="FrontendMainMenu_m5_m0_m0" class="link"><span class="text">Registration</span></a></li>
												<li class="item last"><a href="http://www.nabjnahj.com/i#partner-with-us" id="FrontendMainMenu_m5_m0_m1" class="link"><span class="text">Partnership</span></a></li>
											</ul></div>
										</li>
										<li class="item"><a href="http://www.nabj.org/?2015Convention" id="FrontendMainMenu_m5_m1" class="link"><span class="text">2015 - Minneapolis</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="https://goo.gl/photos/R2wEiewtY773J8vX9" id="FrontendMainMenu_m5_m1_m0" class="link"><span class="text">2015 Photo Highlights</span></a></li><li class="item"><a href="/?page=2015Overview" id="FrontendMainMenu_m5_m1_m1" class="link"><span class="text">Official Site</span></a></li><li class="item"><a href="/?2015Workshops" id="FrontendMainMenu_m5_m1_m2" class="link"><span class="text">2015 Program Book</span></a></li><li class="item"><a href="/?page=2015Partnership" id="FrontendMainMenu_m5_m1_m3" class="link"><span class="text">Partnership</span></a></li><li class="item"><a href="http://c.ymcdn.com/sites/www.nabj.org/resource/resmgr/Media/2015_ADVERTISMENT_INSERTION_.pdf" target="_blank" id="FrontendMainMenu_m5_m1_m4" class="link"><span class="text">2015 Advertising Form</span></a></li><li class="item"><a href="https://thenabj.wufoo.com/forms/nabj15-convention-career-fair-reception-request/" id="FrontendMainMenu_m5_m1_m5" class="link"><span class="text">Hosted Reception Form</span></a></li><li class="item"><a href="/?2015FilmFestival" id="FrontendMainMenu_m5_m1_m6" class="link"><span class="text">NABJ Film Festival FAQs</span></a></li><li class="item last"><a href="https://thenabj.wufoo.com/forms/nabj-conventionmedia-credential-application-2015/" target="_blank" id="FrontendMainMenu_m5_m1_m7" class="link"><span class="text">2015 Media Credentials</span></a></li>
											</ul></div>
										</li>
										<li class="item"><a href="/?page=2014Overview" id="FrontendMainMenu_m5_m2" class="link"><span class="text">2014 - Boston</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="https://plus.google.com/photos/115818991233852986663/albums/6044105089347732577" id="FrontendMainMenu_m5_m2_m0" class="link"><span class="text">Photo Highlights</span></a></li><li class="item"><a href="/?page=2014Overview" id="FrontendMainMenu_m5_m2_m1" class="link"><span class="text">Official Site</span></a></li><li class="item"><a href="/?ConventionProgram" id="FrontendMainMenu_m5_m2_m2" class="link"><span class="text">Convention Program Book</span></a></li><li class="item"><a href="https://thenabj.wufoo.com/forms/nabj-conventionmedia-credential-application-2014/" id="FrontendMainMenu_m5_m2_m3" class="link"><span class="text">Press Credentials</span></a></li><li class="item last"><a href="/?page=2014Sponsorship" id="FrontendMainMenu_m5_m2_m4" class="link"><span class="text">Sponsorship</span></a></li>
											</ul></div>
										</li>
										<li class="item"><a href="/?Convention2013" id="FrontendMainMenu_m5_m3" class="link"><span class="text">2013- Orlando</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="https://drive.google.com/folderview?id=0B0L1C2BACt_3SWwzTmZCUW1GY0E&amp;usp=sharing" id="FrontendMainMenu_m5_m3_m0" class="link"><span class="text">Photo Highlights</span></a></li><li class="item"><a href="http://www.scribd.com/doc/157046161/NABJ-2013-Program-Book" target="_blank" id="FrontendMainMenu_m5_m3_m1" class="link"><span class="text">Program</span></a></li><li class="item"><a href="/?page=Sponsors2013" id="FrontendMainMenu_m5_m3_m2" class="link"><span class="text">Partnership/Sponsorship</span></a></li><li class="item last"><a href="http://nabjmonitor.org/2013/" id="FrontendMainMenu_m5_m3_m3" class="link"><span class="text">Convention News</span></a></li>
											</ul></div>
										</li>
										<li class="item"><a href="/?page=Convention2012" id="FrontendMainMenu_m5_m4" class="link"><span class="text">2012 - New Orleans</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="http://www.scribd.com/doc/97504936/2012-NABJ-Convention-Guide" id="FrontendMainMenu_m5_m4_m0" class="link"><span class="text">2012 Program Book</span></a></li>
												<li class="item last"><a href="http://nabjconvention.org/2012/" id="FrontendMainMenu_m5_m4_m1" class="link"><span class="text">Convention News</span></a></li>
											</ul></div>
										</li>
										<li class="item"><a href="/?ConventionOverview" target="_blank" id="FrontendMainMenu_m5_m5" class="link"><span class="text">2011 - Philadelphia</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first last"><a href="/?page=2011ProgramBook" id="FrontendMainMenu_m5_m5_m0" class="link"><span class="text">2011 Program Book</span></a></li>
											</ul></div>
										</li>
										<li class="item last"><a href="#" target="_blank" id="FrontendMainMenu_m5_m6" class="link"><span class="text">2010 - San Diego</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="/?page=conventionnews" target="_blank" id="FrontendMainMenu_m5_m6_m0" class="link"><span class="text">Convention News</span></a></li><li class="item last"><a href="http://www.goeshow.com/nabj/Annual/2010/programbook.cfm" target="_blank" id="FrontendMainMenu_m5_m6_m1" class="link"><span class="text">Program Book</span></a></li>
											</ul></div>
										</li>
									</ul>									
							</li>
							
							
				
							<li class="item menu_events_l1"><a href="http://www.nabj.org/?page=MediaInstitute" id="FrontendMainMenu_m6" class="link"><span class="text">Events / Programs</span></a>
							
									<ul class="vertical group level1 menu_events_l2">
										<li class="item first"><a href="http://www.nabj.org/?page=MediaInstitute" id="FrontendMainMenu_m6_m0" class="link"><span class="arrow text">Media Institute </span></a>
								
												<ul class="vertical group level2">
													<li class="item first"><a href="http://www.nabj.org/events/event_details.asp?id=286589" id="FrontendMainMenu_m6_m0_m0" class="link"><span class="text">Conference on Energy</span></a></li>
													<li class="item"><a href="http://www.nabj.org/event/13MIHealthCA" id="FrontendMainMenu_m6_m0_m1" class="link"><span class="text">Conference on Health-CA</span></a></li>
													<li class="item"><a href="#" id="FrontendMainMenu_m6_m0_m2" class="link"><span class="arrow text">Conference on Health-DC</span></a>
													
															<ul class="vertical group level3">
																<li class="item first"><a href="http://www.nabj.org/events/event_details.asp?id=402037" id="FrontendMainMenu_m6_m0_m2_m0" class="link"><span class="text">NABJHealth14</span></a></li>
																<li class="item"><a href="http://www.nabj.org/event/NABJhealth13" id="FrontendMainMenu_m6_m0_m2_m1" class="link"><span class="text">NABJhealth13</span></a></li>
																<li class="item last"><a href="http://www.nabj.org/?2012Health" id="FrontendMainMenu_m6_m0_m2_m2" class="link"><span class="text">NABJhealth12</span></a></li>
															</ul>
													
													</li>
													<li class="item"><a href="http://www.nabj.org/?page=Fellowships" id="FrontendMainMenu_m6_m0_m3" class="link"><span class="text">Fellowships</span></a></li>
													<li class="item"><a href="#" id="FrontendMainMenu_m6_m0_m4" class="link"><span class="text">Webinars </span></a></li>
													<li class="item"><a href="http://www.nabj.org/events/event_details.asp?id=350259" id="FrontendMainMenu_m6_m0_m5" class="link"><span class="text">Media Professionals</span></a></li>
													<li class="item last"><a href="http://www.nabj.org/?page=InstituteCommittee" id="FrontendMainMenu_m6_m0_m6" class="link"><span class="text">Media Institute Committee</span></a></li>
												</ul>
											
										</li>
										<li class="item"><a href="http://www.nabj.org/?HealthyNABJ" id="FrontendMainMenu_m6_m1" class="link"><span class="text">Healthy NABJ</span></a></li>
										<li class="item last"><a href="#" id="FrontendMainMenu_m6_m2" class="link"><span class="text">Regional Conference</span></a>
											<div class="slide"><ul class="vertical group level2">
												<li class="item first"><a href="/events/event_details.asp?id=493845" id="FrontendMainMenu_m6_m2_m0" class="link"><span class="text">Region I</span></a></li>
												<li class="item"><a href="/event/2015reg3conf" id="FrontendMainMenu_m6_m2_m1" class="link"><span class="text">Region III</span></a></li>
												<li class="item"><a href="/events/event_details.asp?id=495183" id="FrontendMainMenu_m6_m2_m2" class="link"><span class="text">Region IV</span></a></li>
												<li class="item"><a href="/events/event_details.asp?id=305407&amp;group=" id="FrontendMainMenu_m6_m2_m3" class="link"><span class="text">Region V</span></a></li>
												<li class="item last"><a href="/events/event_details.asp?id=470627" id="FrontendMainMenu_m6_m2_m4" class="link"><span class="text">Region VI</span></a></li>
											</ul></div>
										</li>
									</ul>									
							</li>
							
				
				
							<li class="item menu_awards_l1"><a href="http://www.nabj.org/?page=NABJAwardEntries" id="FrontendMainMenu_m7" class="link"><span class="text">Awards</span></a>
								
								<ul class="vertical group level1 menu_awards_l2">
									<li class="item first"><a href="http://www.nabj.org/?page=NABJAwardEntries" id="FrontendMainMenu_m7_m0" class="link"><span class="text">Overview</span></a></li>
									<li class="item"><a href="#" id="FrontendMainMenu_m7_m1" class="link"><span class="arrow text">Special Honors</span></a>
									
											<ul class="vertical ontop group level2">
												<li class="ontop item first"><a href="http://www.nabj.org/?page=2014SpecialHonors" id="FrontendMainMenu_m7_m1_m0" class="ontop link"><span class="ontop text">Nominate</span></a></li>
												<li class="ontop item"><a href="http://www.nabj.org/?SpecialHonors2013" id="FrontendMainMenu_m7_m1_m1" class="link"><span class="ontop text">2013 Special Honors</span></a></li>
												<li class="ontop item"><a href="http://www.nabj.org/?page=SpecialHonors2012" id="FrontendMainMenu_m7_m1_m2" class="ontop link"><span class="ontop text">2012 Special Honors</span></a></li>
												<li class="ontop item"><a href="http://www.nabj.org/?page=SpecialHonors" id="FrontendMainMenu_m7_m1_m3" class="ontop link"><span class="ontop text">2010 Special Honors</span></a></li>
												<li class="ontop item"><a href="http://www.nabj.org/?page=SpecialHonors2011" id="FrontendMainMenu_m7_m1_m4" class="ontop link"><span class="ontop text">2011 Special Honors</span></a></li>
												<li class="ontop item last"><a href="http://www.nabj.org/?page=pastspecial" id="FrontendMainMenu_m7_m1_m5" class="ontop link"><span class="ontop text">Past Special Honors</span></a></li>
											</ul>
									
									</li>										
									
									<li class="item"><a href="#" id="FrontendMainMenu_m7_m2" class="link"><span class="text">Salute to Excellence</span></a>
										<div class="slide"><ul class="vertical group level2">
											<li class="item first"><a href="https://thenabj.wufoo.com/forms/2015-salute-to-excellence-plaque-reorders-q16rp4pi1blxmhv/" id="FrontendMainMenu_m7_m2_m0" class="link"><span class="text">STE Award Reorder</span></a></li>
											<li class="item"><a href="/?2015STEWINNERS" id="FrontendMainMenu_m7_m2_m1" class="link"><span class="text">2015 Winners</span></a></li>
											<li class="item"><a href="/?page=2015STEFinal" id="FrontendMainMenu_m7_m2_m2" class="link"><span class="text">2015 Finalists</span></a></li>
											<li class="item"><a href="/?page=STEFINALISTS2014" id="FrontendMainMenu_m7_m2_m3" class="link"><span class="text">2014 Finalists</span></a></li>
											<li class="item"><a href="/?page=STEWinners2013" id="FrontendMainMenu_m7_m2_m4" class="link"><span class="text">2013 Winners</span></a></li>
											<li class="item"><a href="/?page=STEFINALISTS2013" id="FrontendMainMenu_m7_m2_m5" class="link"><span class="text">2013 Finalists</span></a></li>
											<li class="item"><a href="/?page=STEWinners2012" id="FrontendMainMenu_m7_m2_m6" class="link"><span class="text">2012 Winners</span></a></li>
											<li class="item"><a href="/?page=STEFINALISTS2012" id="FrontendMainMenu_m7_m2_m7" class="link"><span class="text">2012 Finalists</span></a></li>
											<li class="item"><a href="/?page=STEWinners2011" id="FrontendMainMenu_m7_m2_m8" class="link"><span class="text">2011 Winners</span></a></li>
											<li class="item"><a href="/?2011STEFinalists" id="FrontendMainMenu_m7_m2_m9" class="link"><span class="text">2011 Finalists</span></a></li>
											<li class="item"><a href="/?page=SalutetoExcellence" id="FrontendMainMenu_m7_m2_m10" class="link"><span class="text">2010 Winners</span></a></li>
											<li class="item last"><a href="/?page=Nominees" id="FrontendMainMenu_m7_m2_m11" class="link"><span class="text">2010 Finalists</span></a></li>
										</ul></div>
									</li>				
					
									<li class="item"><a href="http://www.nabj.org/?page=RayTaliaferroAward" id="FrontendMainMenu_m7_m3" class="link"><span class="text">Ray Taliaferro Spirit Award</span></a></li>
									<li class="item"><a href="http://www.nabj.org/?page=GannetteFoundAward" id="FrontendMainMenu_m7_m4" class="link"><span class="text">Gannett Foundation Award</span></a></li>
									<li class="item"><a href="#" id="FrontendMainMenu_m7_m5" class="link"><span class="arrow text">Hall of Fame</span></a>
									
										<ul class="vertical group level2">													
											<li class="item"><a href="http://www.nabj.org/?HallofFameNomination" id="FrontendMainMenu_m7_m5_m1" class="link"><span class="text">Nominate</span></a></li>
											<li class="item"><a href="http://www.nabj.org/event/HOF2014" id="FrontendMainMenu_m7_m5_m2" class="link"><span class="arrow text">2014</span></a>			
												<ul class="vertical group level3">
													<li class="item first last"><a href="https://www.dropbox.com/sh/e0kaqlq99id66qq/Hm-KOLrPyT?n=154899110#/" id="FrontendMainMenu_m7_m5_m2_m0" class="link"><span class="text">Photo Highlights</span></a></li>
												</ul>												
											</li>
											<li class="item"><a href="http://www.nabj.org/?HOF2013" id="FrontendMainMenu_m7_m5_m3" class="link"><span class="text">2013</span></a></li>
											<li class="item"><a href="http://www.nabj.org/?page=HallofFame2012" id="FrontendMainMenu_m7_m5_m4" class="link"><span class="text">2012</span></a></li>
											<li class="item"><a href="http://www.nabj.org/?page=halloffamevideos" id="FrontendMainMenu_m7_m5_m5" class="link"><span class="text">2011</span></a></li>
											<li class="item last"><a href="http://www.nabj.org/?page=PastHallofFame" id="FrontendMainMenu_m7_m5_m6" class="link"><span class="text">Past Hall of Fame Honorees</span></a></li>
										</ul>										
									</li>
									<li class="item last"><a href="http://www.nabj.org/?page=IdaBWells" id="FrontendMainMenu_m7_m6" class="link"><span class="text">Ida B. Wells</span></a></li>
								</ul>								
							</li>

							<li class="item menu_jobs_l1"><a href="" id="FrontendMainMenu_m8" class="link"><span class="text">Jobs/Services</span></a>								
								<ul class="vertical group level1 menu_jobs_l2">
									<li class="item first"><a href="http://nabjcareers.org/" id="FrontendMainMenu_m8_m0" class="link"><span class="text">NABJ Career Center</span></a></li>
									<li class="item"><a href="http://www.nabj.org/?page=NABJisHiring" id="FrontendMainMenu_m8_m1" class="link"><span class="text">Jobs at NABJ</span></a></li>
									<li class="item last"><a href="http://www.nabj.org/?RFPNotice" id="FrontendMainMenu_m8_m2" class="link"><span class="text">RFP Notice</span></a></li>
									<li class="item last"><a href="http://www.nabj.org/?JournalismNext2013" id="FrontendMainMenu_m8_m4" class="link"><span class="text">JournalismNext.com</span></a></li>
								</ul>
							</li>
				
							<li class="item last menu_support_l1"><a href="#" id="FrontendMainMenu_m9" class="link"><span class="text">Support</span></a>								
									<ul class="vertical group level1 menu_support_l2">
										<li class="item first"><a href="http://www.nabjnahj.com/i#partner-with-us" id="FrontendMainMenu_m9_m0" class="link"><span class="text">Partnership</span></a></li>
										<li class="item"><a href="http://www.nabj.org/resource/resmgr/Media/nabjwb_webkit.pdf" id="FrontendMainMenu_m9_m1" class="link"><span class="text">Advertise</span></a></li>
										<li class="item last"><a href="http://www.nabj.org/donations/" id="FrontendMainMenu_m9_m2" class="link"><span class="text">Donations</span></a></li>
									</ul>								
							</li>
						</ul>					
					</div>
											
					{literal}		<script>
					sfHover = function() { 
					    var sfEls = document.getElementById("rootGroup").getElementsByTagName("LI"); 
					    for (var i=0; i<sfEls.length; i++) { 
					        sfEls[i].onmouseover=function() { 
					            this.className+=" sfhover"; 
					        } 
					        sfEls[i].onmouseout=function() { 
					            this.className=this.className.replace(new RegExp(" sfhover\\b"), ""); 
					        } 
					    } 
					} 
					if (window.attachEvent) window.attachEvent("onload", sfHover);
					</script>	
					{/literal}												
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td id="CenterColumn"><div id="SpMain">
								<style type="text/css">	{literal}#tat_table {z-index:99;	}	#FavoriteEditorTitle {margin: 0;	}{/literal}</style>
								<div class="yui-skin-sam">
									<div id="FavoriteOptsPanel" style="visibility:hidden;">
										<div id="FavoriteOptsPanelBody" class="bd">
											<div id="FormErrors" style="display:none">
												<div class="infobox">
													<ul id="FormErrorList" class="redalert"></ul>
												</div><br>
											</div>			
										</div>
									</div>
								</div>
								<style type="text/css">{literal} .ScoreControl {display:block;	float:left; } {/literal} </style>
								<table id="SpSubHead" border="0" cellpadding="0" cellspacing="0"><tr>
									<td id="SpTitleBar"><a href="{$GLOBALS.site_url}/">NABJ Career Center</a>								
										
										<div id="welcome_links">	
										
											{if $GLOBALS.current_user.logged_in}
												[[Welcome]] {if $GLOBALS.current_user.subuser}{$GLOBALS.current_user.subuser.username}{else}{$GLOBALS.current_user.username}{/if}, &nbsp;
												{if $GLOBALS.current_user.new_messages > 0} 
												<a href="{$GLOBALS.site_url}/private-messages/inbox/"><img src="{image}new_msg.gif" border="0" alt="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]"  title="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]" /></a>
												{/if}
												&nbsp; <a href="{$GLOBALS.site_url}/"> [[Home]]</a> &nbsp; &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
												<a href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a>
											{else}
												<a href="{$GLOBALS.site_url}/"> [[Home]]</a> &nbsp; &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
												<a href="{$GLOBALS.site_url}/registration/"> [[Register]]</a> &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp; 
												<a href="{$GLOBALS.site_url}/login/"> [[Sign In]]</a><br/>
												{* SOCIAL PLUGIN: LOGIN BUTTON 
												{module name="social" function="social_login"}
												/ SOCIAL PLUGIN: LOGIN BUTTON *}
											{/if}								
										</div>		
								</td></tr></table>
																			
							</td>
						</tr>
					</table>
				</td>
			</tr>							
		</table>
				
	</div>
	<div class="clr"></div>
	{module name="menu" function="top_menu"}	
	
	

	