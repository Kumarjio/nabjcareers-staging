<?php  /* Smarty version 2.6.14, created on 2018-02-12 10:07:28
         compiled from search_results_resumes.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'search_results_resumes.tpl', 13, false),array('modifier', 'current', 'search_results_resumes.tpl', 46, false),array('modifier', 'strpos', 'search_results_resumes.tpl', 226, false),array('modifier', 'regex_replace', 'search_results_resumes.tpl', 226, false),array('modifier', 'strip_tags', 'search_results_resumes.tpl', 269, false),array('modifier', 'truncate', 'search_results_resumes.tpl', 269, false),array('function', 'image', 'search_results_resumes.tpl', 106, false),array('function', 'cycle', 'search_results_resumes.tpl', 251, false),array('function', 'module', 'search_results_resumes.tpl', 366, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
<?php  echo '
$.ui.dialog.defaults.bgiframe = true;
function submitForm(id) {
	lpp = document.getElementById("listings_per_page" + id);
	location.href = "?'; ?>
searchId=<?php  echo $this->_tpl_vars['searchId'];   echo '&action=search&page=1&listings_per_page=" + lpp.value;
}
function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
	reloadPage = false;
	newPageReload = false;
	$("#messageBox").dialog( \'destroy\' ).html(\''; ?>
<img style="vertical-align: middle;" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if((parentReload == true && !userLoggedIn) || newPageReload == true) {
				if(reloadPage == true)
					parent.document.location.reload();
			}
		}
	}).dialog( \'open\' );
	$.get(url, function(data){
		$("#messageBox").html(data);  
	});
	return false;
}
function SaveAd(noteId, url){
	$.get(url, function(data){
		$("#"+noteId).html(data);  
	});
}
'; ?>

</script>
<?php  if ($this->_tpl_vars['ERRORS']): ?>
	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  else: ?>
	<div <?php  if ($this->_tpl_vars['refineSearch']): ?>class="results"<?php  else: ?>class="noRefine"<?php  endif; ?>>
		
		<div id="topResults">
			<div class="headerBgBlock">
				<?php  if (isset ( $this->_tpl_vars['search_criteria']['username']['value'] )): ?>
					<?php  $this->assign('tmp_listing', current($this->_tpl_vars['listings'])); ?>
					<?php  if ($this->_tpl_vars['tmp_listing']['user']['FirstName'] != '' || $this->_tpl_vars['tmp_listing']['user']['LastName'] != ''): ?>
						<?php  $this->assign('firstName', $this->_tpl_vars['tmp_listing']['user']['FirstName']); ?>
						<?php  $this->assign('lastName', $this->_tpl_vars['tmp_listing']['user']['LastName']); ?>
						<div class="Results"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resumes by $firstName $lastName<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div><span></span>
					<?php  endif; ?>
				<?php  else: ?>
					<div class="Results"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume Search Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div><span></span>
				<?php  endif; ?>
				<!-- TOP QUICK LINKS -->
				<div class="topResultsLinks">
					<ul>
						<li class="modifySearchIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modify search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<?php  if ($this->_tpl_vars['listing_type_id'] != ''): ?><li class="saveSearchIco"><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/save-search/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/save-search/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_type_id'] != ''): ?><li class="saveSearchIco"><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/save-search/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&alert=1', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save Resume Alert<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/save-search/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save Resume Alert<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
						<li class="savedIco">
							<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-resumes"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings/?listing_type_id=resume', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  endif; ?>
						</li>
						<li class="savedIco">
							<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved searches<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved searches<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved searches<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  endif; ?>
						</li>
					</ul>
				</div>
				<!-- END TOP QUICK LINKS -->
			</div>

			<!-- TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
			<div class="topNavBarLeft"></div>
			<div class="topNavBar">
				<div class="numberResults">
					<?php  $this->assign('listings_number', $this->_tpl_vars['listing_search']['listings_number']); ?>
					<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results: $listings_number Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  if ($this->_tpl_vars['search_criteria']['ZipCode']['value']['location'] && $this->_tpl_vars['search_criteria']['ZipCode']['value']['radius']): ?>
						<?php  $this->assign('radius', $this->_tpl_vars['search_criteria']['ZipCode']['value']['radius']); ?> 
						<?php  ob_start(); ?>
							<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['GLOBALS']['radius_search_unit'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['radius_search_unit'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php  $this->_smarty_vars['capture']['radius_search_unit'] = ob_get_contents(); ob_end_clean(); ?>
						<?php  $this->assign('radius_search_unit', $this->_smarty_vars['capture']['radius_search_unit']); ?>
						<?php  $this->assign('location', $this->_tpl_vars['search_criteria']['ZipCode']['value']['location']); ?>
						<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>within $radius $radius_search_unit of $location<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  endif; ?>
				</div>
				
				<div class="numberPerPage">
					<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
						<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of resumes per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
						<select id="listings_per_page1" name="listings_per_page1" onchange="submitForm(1); return false;">
							<option value="10" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
							<option value="20" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
							<option value="50" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
							<option value="100" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
						</select>
					</form>
				</div>
				
				<div class="pageNavigation">
					<span class="prevBtn"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt=""/>
					<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?></span>
					<span class="navigationItems">
						<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
						<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
					</span>
					<span class="nextBtn"><?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
					<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png"  alt=""/></span>
				</div>
			</div>
			<div class="topNavBarRight"></div>
			<!-- END RESULTS / PER PAGE / NAVIGATION -->
		</div>
		
		<!-- START REFINE SEARCH -->
		<?php  if ($this->_tpl_vars['refineSearch']): ?>
		<div id="refineResults">
			<div id="blockBg">
				<div id="blockTop"></div>
				<div id="blockInner">
						<table cellpadding="0" cellspacing="0" id="currentSearch">
							<thead>
								<tr>
									<th class="tableLeft"> </th>
									<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Current Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</th>
									<th class="tableRight"> </th>
								</tr>
							</thead>
							<tbody>
								<?php  $_from = $this->_tpl_vars['currentSearch']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldID'] => $this->_tpl_vars['fieldInfo']):
?>
								<?php  ob_start(); ?>Property_<?php  echo $this->_tpl_vars['fieldID'];   $this->_smarty_vars['capture']['refineTranslationDomain'] = ob_get_contents(); ob_end_clean(); ?>
								<tr>
									<td></td>
									<td>
									<div class="currentSearch"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['fieldInfo']['name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
										<?php  $_from = $this->_tpl_vars['fieldInfo']['field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_type'] => $this->_tpl_vars['field_value']):
?>
											<?php  if ($this->_tpl_vars['field_type'] == 'monetary'): ?>
												<?php  $_from = $this->_tpl_vars['field_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loopVal'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loopVal']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['real_val'] => $this->_tpl_vars['val']):
        $this->_foreach['loopVal']['iteration']++;
?>
													<?php  if ($this->_foreach['loopVal']['iteration']%2 == 0): ?>
														<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
													<?php  endif; ?>
													<span class="curSearchItem"><a href='?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&action=undo&param=<?php  echo $this->_tpl_vars['fieldID']; ?>
&type=<?php  echo $this->_tpl_vars['field_type']; ?>
&value=<?php  echo $this->_tpl_vars['real_val'];   if ($this->_tpl_vars['show_brief_or_detailed']): ?>&amp;show_brief_or_detailed=<?php  echo $this->_tpl_vars['show_brief_or_detailed'];   endif; ?>'><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(undo)<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php  $this->_tag_stack[] = array('tr', array('domain' => $this->_smarty_vars['capture']['refineTranslationDomain'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['val'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
												<?php  endforeach; endif; unset($_from); ?>
											<?php  else: ?>
												<?php  $_from = $this->_tpl_vars['field_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['real_val'] => $this->_tpl_vars['val']):
?>
													<span class="curSearchItem"><a href='?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&action=undo&param=<?php  echo $this->_tpl_vars['fieldID']; ?>
&type=<?php  echo $this->_tpl_vars['field_type']; ?>
&value=<?php  echo $this->_tpl_vars['real_val'];   if ($this->_tpl_vars['show_brief_or_detailed']): ?>&amp;show_brief_or_detailed=<?php  echo $this->_tpl_vars['show_brief_or_detailed'];   endif; ?>'><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(undo)<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php  $this->_tag_stack[] = array('tr', array('domain' => $this->_smarty_vars['capture']['refineTranslationDomain'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['val'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br/>
												<?php  endforeach; endif; unset($_from); ?>
											<?php  endif; ?>
										<?php  endforeach; endif; unset($_from); ?>
									</td>
									<td></td>
								</tr>
								<?php  endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
						<br/>
						<table cellpadding="0" cellspacing="0" width="100%" id="refineResults">
							<thead>
								<tr>
									<th class="tableLeft"> </th>
									<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Refine Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</th>
									<th class="tableRight"> </th>
								</tr>
							</thead>
							<tbody>
								<?php  $_from = $this->_tpl_vars['refineFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['refineField']):
?>
									<?php  if ($this->_tpl_vars['refineField']['show'] && $this->_tpl_vars['refineField']['count_results']): ?>
										<tr>
											<td></td>
											<td width="100%">
												<div class="refine_button"><div class="refine_icon">[+]</div><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['refineField']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
												<div class="refine_block" style="display: none">
													<?php  $_from = $this->_tpl_vars['refineField']['search_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fieldValue'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fieldValue']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['fieldValue']['iteration']++;
?>
														<?php  if ($this->_foreach['fieldValue']['iteration'] == 6): ?>
															<div class="block_values"  style="display: none">
														<?php  endif; ?>
														<?php  ob_start(); ?>Property_<?php  echo $this->_tpl_vars['refineField']['field_name'];   $this->_smarty_vars['capture']['refineTranslationDomain'] = ob_get_contents(); ob_end_clean(); ?>
														<?php  if ($this->_tpl_vars['refineField']['criteria']): ?>
															<?php  if (! in_array ( $this->_tpl_vars['val']['value'] , $this->_tpl_vars['refineField']['criteria'] ) && ( ! $this->_tpl_vars['val']['sid'] || ( $this->_tpl_vars['val']['sid'] && ! in_array ( $this->_tpl_vars['val']['sid'] , $this->_tpl_vars['refineField']['criteria'] ) ) )): ?>
																<div class="refineItem"><a href='?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=refine&amp;<?php  echo $this->_tpl_vars['refineField']['field_name']; ?>
[multi_like_and][]=<?php  if ($this->_tpl_vars['val']['sid']):   echo $this->_tpl_vars['val']['sid'];   else:   echo $this->_tpl_vars['val']['value'];   endif;   if ($this->_tpl_vars['show_brief_or_detailed']): ?>&amp;show_brief_or_detailed=<?php  echo $this->_tpl_vars['show_brief_or_detailed'];   endif; ?>'><?php  $this->_tag_stack[] = array('tr', array('domain' => $this->_smarty_vars['capture']['refineTranslationDomain'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['val']['value'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> (<?php  echo $this->_tpl_vars['val']['count']; ?>
)</div>
															<?php  endif; ?>
														<?php  else: ?>
															<div class="refineItem"><a href='?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=refine&amp;<?php  echo $this->_tpl_vars['refineField']['field_name']; ?>
[multi_like_and][]=<?php  if ($this->_tpl_vars['val']['sid']):   echo $this->_tpl_vars['val']['sid'];   else:   echo $this->_tpl_vars['val']['value'];   endif;   if ($this->_tpl_vars['show_brief_or_detailed']): ?>&amp;show_brief_or_detailed=<?php  echo $this->_tpl_vars['show_brief_or_detailed'];   endif; ?>'><?php  $this->_tag_stack[] = array('tr', array('domain' => $this->_smarty_vars['capture']['refineTranslationDomain'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['val']['value'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> (<?php  echo $this->_tpl_vars['val']['count']; ?>
)</div>
														<?php  endif; ?>
													<?php  endforeach; endif; unset($_from); ?>
													<?php  if ($this->_foreach['fieldValue']['total'] > 6): ?>
														</div><div class="block_values_button"> &nbsp; &#187; <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>more<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
													<?php  endif; ?>
												</div>
											</td>
											<td></td>
										</tr>
									<?php  endif; ?>
								<?php  endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
		<?php  endif; ?>
		<!-- END REFINE SEARCH -->
			
		<!-- LISTINGS TABLE -->
			<div id="listingsResults">
				<?php  if ($this->_tpl_vars['listings']): ?>
					<table cellspacing="0">
						<thead>
							<tr>
								<th class="tableLeft"> </th>
								<th width="25%"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
								<th width="30%">
									<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;sorting_field=Title&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'Title'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
									<?php  if ($this->_tpl_vars['is_show_brief_or_detailed']): ?>
										<a href="?<?php  if ($this->_tpl_vars['searchId']): ?>searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;<?php  endif;   if (((is_array($_tmp=$this->_tpl_vars['params'])) ? $this->_run_mod_handler('strpos', true, $_tmp, 'searchId') : strpos($_tmp, 'searchId')) !== false):   echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['params'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/searchId=".($this->_tpl_vars['searchId'])."&amp;/", "") : smarty_modifier_regex_replace($_tmp, "/searchId=".($this->_tpl_vars['searchId'])."&amp;/", "")))) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/&amp;show_brief_or_detailed=".($this->_tpl_vars['show_brief_or_detailed'])."/", "") : smarty_modifier_regex_replace($_tmp, "/&amp;show_brief_or_detailed=".($this->_tpl_vars['show_brief_or_detailed'])."/", ""));   else:   echo $this->_tpl_vars['params'];   endif; ?>&amp;show_brief_or_detailed=<?php  if ($this->_tpl_vars['show_brief_or_detailed'] == 'brief'): ?>detailed<?php  else: ?>brief<?php  endif; ?>" id="showBriefOrDetailed">(<?php  if ($this->_tpl_vars['show_brief_or_detailed'] == 'brief'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show detailed<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show brief<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>)</a>
									<?php  endif; ?>
									<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'Title'):   if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
								</th>
								<th>
									<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;sorting_field=TotalYearsExperience&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'TotalYearsExperience'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Experience<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
									<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'TotalYearsExperience'):   if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
								</th>
								<th>
									<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;sorting_field=City&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'City'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>City<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
									<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'City'):   if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
								</th>
								<th width="10%">
									<a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;sorting_field=activation_date&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'activation_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
									<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'activation_date'):   if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="Up" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="Down" /><?php  endif;   endif; ?>
								</th>
								<th class="tableRight"> </th>
							</tr>
						</thead>
						<tbody>
						<!-- Job Info Start -->
						<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings']['iteration']++;
?>
							<?php  if ($this->_tpl_vars['listing']['anonymous'] == 1 && $this->_tpl_vars['search_criteria']['username']['value'] != ''): ?>
															<?php  else: ?>
								<tr <?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?>class="priorityListing"<?php  else: ?>class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
"<?php  endif; ?>>
									<td> </td>
									<td>
							    		<a name="listing_<?php  echo $this->_tpl_vars['listing']['id']; ?>
">&nbsp;</a>
							    		<strong><?php  if ($this->_tpl_vars['listing']['anonymous'] == 1):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   echo $this->_tpl_vars['listing']['user']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['listing']['user']['LastName'];   endif; ?></strong>
									</td>
									<td>
							    		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
" class="JobTittleSR"><strong><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</strong></a>
									</td>
									<td> <?php  if ($this->_tpl_vars['listing']['TotalYearsExperience'] > 0):   echo $this->_tpl_vars['listing']['TotalYearsExperience']; ?>
 <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>years<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?></td>
									<td> <?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_City')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['City'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
									<td> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
									<td> </td>
								</tr>
								<?php  if ($this->_tpl_vars['show_brief_or_detailed'] != 'brief'): ?>
									<?php  if ($this->_tpl_vars['listing']['Objective']): ?>
										<tr <?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?>class="priorityListing"<?php  else: ?>class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
"<?php  endif; ?>>
											<td> </td>
											<td colspan="5"><?php  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['listing']['Objective'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 120) : smarty_modifier_truncate($_tmp, 120)); ?>
</td>
											<td> </td>
										</tr>
									<?php  endif; ?>
								<?php  endif; ?>
								<tr <?php  if ($this->_tpl_vars['listing']['priority'] == 1): ?>class="priorityListing"<?php  else: ?>class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
"<?php  endif; ?>>
									<td> </td>
									<td colspan="5">
										<ul>
											<li class="saved2Ico">
												<span id='notes_<?php  echo $this->_tpl_vars['listing']['id']; ?>
'>
								   					<?php  if ($this->_tpl_vars['listing']['saved_listing']): ?>
								   						<?php  if ($this->_tpl_vars['listing']['saved_listing']['note'] && $this->_tpl_vars['listing']['saved_listing']['note'] != ''): ?>
								   							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
'); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
								   						<?php  else: ?>
								   							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
'); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
								   						<?php  endif; ?>
								   					<?php  else: ?>
								   						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>SaveAd('notes_<?php  echo $this->_tpl_vars['listing']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&listing_type=resume')<?php  else: ?>popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&listing_type=resume', 300, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>)<?php  endif; ?>; return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save ad<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
								   					<?php  endif; ?>
												</span>
											</li>
											<li class="viewDetails"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View resume details<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
											<?php  if ($this->_tpl_vars['listing']['video']['file_url']): ?><li class="viewVideo"><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
', 282, 300, 'VideoPlayer'); return false;"  href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Watch a video<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>				
										</ul>
										<span id = 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
'>
										<?php  if ($this->_tpl_vars['listing']['saved_listing'] && $this->_tpl_vars['listing']['saved_listing']['note'] && $this->_tpl_vars['listing']['saved_listing']['note'] != ''): ?>
											<b><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> <?php  echo $this->_tpl_vars['listing']['saved_listing']['note']; ?>

										<?php  endif; ?>
										</span><br/><br/>
									</td>
									<td> </td>
								</tr>
								<tr>
									<td colspan="7" class="separateListing"> </td>
								</tr>
							<?php  endif; ?>
						<?php  endforeach; endif; unset($_from); ?>
						<!-- END Job Info Start -->
						</tbody>
					</table>
				<?php  else: ?>
					<center><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no postings meeting the criteria you specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></center>
				<?php  endif; ?>
			</div>
		<!-- END LISTINGS TABLE -->

		<!-- BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
		<div id="endResults">
			<div class="topResultsLinks">
				<div class="topNavBarLeft"></div>
				<div class="topNavBar">
					<div class="numberResults">
						<?php  $this->assign('listings_number', $this->_tpl_vars['listing_search']['listings_number']); ?>
						<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Results: $listings_number Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php  if ($this->_tpl_vars['search_criteria']['ZipCode']['value']['location'] && $this->_tpl_vars['search_criteria']['ZipCode']['value']['radius']): ?>
							<?php  $this->assign('radius', $this->_tpl_vars['search_criteria']['ZipCode']['value']['radius']); ?> 
							<?php  ob_start(); ?>
								<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['GLOBALS']['radius_search_unit'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['radius_search_unit'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							<?php  $this->_smarty_vars['capture']['radius_search_unit'] = ob_get_contents(); ob_end_clean(); ?>
							<?php  $this->assign('radius_search_unit', $this->_smarty_vars['capture']['radius_search_unit']); ?>
							<?php  $this->assign('location', $this->_tpl_vars['search_criteria']['ZipCode']['value']['location']); ?>
							<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>within $radius $radius_search_unit of $location<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php  endif; ?>
					</div>
					<div class="numberPerPage">
						<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
						<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of resumes per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
							<select id="listings_per_page2" name="listings_per_page2" onchange="submitForm(2); return false;">
								<option value="10" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
								<option value="20" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
								<option value="50" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
								<option value="100" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
							</select>
						</form>
					</div>
					<div class="pageNavigation">
						<span class="prevBtn"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt=""/>
						<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?></span>
						<span class="navigationItems">
							<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=1">1</a><?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>...<?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
							<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>...<?php  endif; ?>
							<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
						</span>
						<span class="nextBtn"><?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?><a href="?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;action=search&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else: ?><a><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt=""/></span>
					</div>
				</div>
				<div class="topNavBarRight"></div>
			</div>
                        <?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'linkedin_people_search_results','profileSID' => $this->_tpl_vars['listing']['user']['id'],'count' => '5'), $this);?>

            		</div>
		<!-- END BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
	</div>
<?php  endif; ?>

<?php  echo '
	<script>
	$(".refine_button").click(function(){
		var butt = $(this);
		$(this).next(".refine_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".refine_icon").html("[-]");
				} else {
					butt.children(".refine_icon").html("[+]");
				}
			});
	});
	$(".block_values_button").click(function(){
		var butt = $(this);
		$(this).prev(".block_values").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.html("'; ?>
 &nbsp; &#171; <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>less<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '");
				} else {
					butt.html("'; ?>
 &nbsp; &#187; <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>more<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '");
				}
			});
	});
	</script>
'; ?>