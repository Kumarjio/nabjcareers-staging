<?php  /* Smarty version 2.6.14, created on 2018-02-08 19:51:09
         compiled from display_resume.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', 'display_resume.tpl', 2, false),array('block', 'keywords', 'display_resume.tpl', 3, false),array('block', 'description', 'display_resume.tpl', 4, false),array('block', 'tr', 'display_resume.tpl', 8, false),array('function', 'image', 'display_resume.tpl', 122, false),array('function', 'module', 'display_resume.tpl', 175, false),array('function', 'display', 'display_resume.tpl', 184, false),)), $this); ?>
<div id="displayListing">
	<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  echo $this->_tpl_vars['listing']['Title']; ?>
 <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('keywords', array()); $_block_repeat=true;$this->_plugins['block']['keywords'][0][0]->_tpl_keywords($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  echo $this->_tpl_vars['listing']['Title']; ?>
 <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['keywords'][0][0]->_tpl_keywords($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('description', array()); $_block_repeat=true;$this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  echo $this->_tpl_vars['listing']['Title']; ?>
 <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  if ($this->_tpl_vars['errors']): ?>
	    <?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error_message']):
?>
			<p class="error">
				<?php  if ($this->_tpl_vars['error_code'] == 'UNDEFINED_LISTING_ID'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing ID is not defined<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  if ($this->_tpl_vars['GLOBALS']['settings']['exp_listings_404_page']): ?>
						<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>404 Not Found<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  endif; ?>
				<?php  elseif ($this->_tpl_vars['error_code'] == 'WRONG_LISTING_ID_SPECIFIED'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There is no listing in the system with the specified ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  if ($this->_tpl_vars['GLOBALS']['settings']['exp_listings_404_page']): ?>
						<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>404 Not Found<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  endif; ?>
				<?php  elseif ($this->_tpl_vars['error_code'] == 'LISTING_IS_NOT_ACTIVE'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This Resume is no longer available<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  if ($this->_tpl_vars['GLOBALS']['settings']['exp_listings_404_page']): ?>
						<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>404 Not Found<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  endif; ?>
				<?php  elseif ($this->_tpl_vars['error_code'] == 'NOT_OWNER'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You're not the owner of this posting<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php  elseif ($this->_tpl_vars['error_code'] == 'LISTING_IS_NOT_APPROVED'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing with specified ID is not approved by admin<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  if ($this->_tpl_vars['GLOBALS']['settings']['exp_listings_404_page']): ?>
						<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>404 Not Found<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  endif; ?>
				<?php  elseif ($this->_tpl_vars['error_code'] == 'WRONG_DISPLAY_TEMPLATE'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Wrong template to display listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php  endif; ?>
			</p>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  else: ?>
		<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
		<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
		<?php  echo '
		<script type="text/javascript"><!--
		$.ui.dialog.defaults.bgiframe = true;
		function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn) {
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
					if(parentReload == true && !userLoggedIn) {
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
		
		'; ?>

			var link = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/";
			<?php  echo '
			// send flagForm and show result
			function sendFlagForm() {
				$("#flagForm").ajaxSubmit({
					url : link, 
					success : function (data) {
						$("#messageBox").html(data);
					}
				});
				return false;
			}
			--></script>
		'; ?>



<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] != "/manage-listing/"): ?>	
	<div class="results">
		<div id="topResults">
			<!-- SAVE LISTING / PRINT LISTING -->
			<div class="searchResultsHeaderLineNew">
				<ul>
					<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] != "/my-resume-details"): ?>
						<li class="panelSavedIco"><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&displayForm=1&listing_type=resume', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<li class="panelViewDitailsIco">
							<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-resumes"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Saved Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?><a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings/?listing_type_id=resume', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Saved Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Saved Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  endif; ?>
						</li>
					<?php  endif; ?>
					<?php  if ($this->_tpl_vars['acl']->isAllowed('flag_resume')): ?>
						<li class="printListingIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
', 400, 350, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Flag Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" id="message_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Flag This Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<?php  endif; ?>
						<li class="printListingIco"><a target="_blank" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/print-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Print This Ad<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<li class="viewMapIco"><a target="_blank" href="http://www.maps.google.com/?q=<?php  echo $this->_tpl_vars['listing']['City']; ?>
+<?php  echo $this->_tpl_vars['listing']['State']; ?>
+<?php  echo $this->_tpl_vars['listing']['ZipCode']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Map<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
				</ul>
			</div>
			<!-- END SAVE LISTING / PRINT LISTING -->
			
			<!-- MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
			<div class="clr"></div>
			<div class="ModResults">&nbsp;
				<?php  if ($this->_tpl_vars['searchId'] != "" && $this->_tpl_vars['GLOBALS']['user_page_uri'] != "/my-resume-details"): ?>
					<ul>
						<li class="arrow"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['search_uri']; ?>
?action=search&amp;searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
#listing_<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<li class="modifySearchIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modify Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					</ul>
				<?php  endif; ?>
			</div>
			<div class="Rating">&nbsp;
				<?php  if ($this->_tpl_vars['show_rates'] != 0 && $this->_tpl_vars['acl']->isAllowed('add_resume_ratings')): ?>
					<ul><li class="ratingPanel"><p style="float:left; margin-top: 0px; padding: 0px;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rate This Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "rating.tpl", 'smarty_include_vars' => array('listing' => $this->_tpl_vars['listing'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p></li></ul>
				<?php  endif; ?>
			</div>
			<div class="Comments">&nbsp;
				<?php  if ($this->_tpl_vars['show_comments'] != 0 && $this->_tpl_vars['acl']->isAllowed('add_resume_comments')): ?>
					<ul><li class="comments"><a href="#comment_1"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (+<?php  echo $this->_tpl_vars['listing']['comments_num']; ?>
)</a></li></ul>
				<?php  endif; ?>
			</div>
			<div class="Pagging">&nbsp;
				<?php  if ($this->_tpl_vars['searchId'] != "" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>
					<ul>
						<li class="pagging">
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" style="margin-right:2px;" border="0" />
							<?php  if ($this->_tpl_vars['prev_next_ids']['prev']): ?>
								<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>my-resume-details<?php  else: ?>display-resume<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['prev']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp;
							<?php  else: ?>
								<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &nbsp;
							<?php  endif; ?>
							<?php  if ($this->_tpl_vars['prev_next_ids']['next']): ?>
								<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>my-resume-details<?php  else: ?>display-resume<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['next']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?>
								<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							<?php  endif; ?>
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" style="margin-left:2px;"  border="0"/>
						</li>
					</ul>
				<?php  endif; ?>
			</div>
			<!-- END MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
		</div>
	</div> 
	
	
<?php  endif; ?>
	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo">
			<div id="blockTop"></div>
			<div class="compProfileTitle"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="compProfileInfo">
				<?php  if ($this->_tpl_vars['listing']['anonymous'] != 1 || $this->_tpl_vars['applications']['anonymous'] === 0): ?>
					<?php  if ($this->_tpl_vars['listing']['user']['Photo']['file_url']): ?>
						<center><img src="<?php  echo $this->_tpl_vars['listing']['user']['Photo']['file_url']; ?>
" alt="" /></center>
					<?php  endif; ?>
						<span class="usernameResume"><strong><?php  echo $this->_tpl_vars['listing']['user']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['listing']['user']['LastName']; ?>
</strong></span>
						<br /><?php  echo $this->_tpl_vars['listing']['user']['Address']; ?>

						<br /><?php  if ($this->_tpl_vars['listing']['user']['City']):   echo $this->_tpl_vars['listing']['user']['City']; ?>
, <?php  endif; ?><strong><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['user']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['user']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong> <?php  if ($this->_tpl_vars['listing']['user']['Country']): ?>(<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['user']['Country'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['user']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<?php  endif; ?>
						<br /><br />
						<br /><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['listing']['user']['PhoneNumber']; ?>

						<br /><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <a href="mailto:<?php  echo $this->_tpl_vars['listing']['user']['email']; ?>
"><?php  echo $this->_tpl_vars['listing']['user']['email']; ?>
</a><br/>
						
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-resumes/?action=search&amp;username[equal]=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All resumes by this user<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<br /><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
', 560, 400, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;"  class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></strong>
				<?php  else: ?>
						<br /><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>
						<br /><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
view_ditail.png" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Download Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/><a href="?filename=<?php  echo $this->_tpl_vars['listing']['Resume']['saved_file_name']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Download Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<br /><strong><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
&amp;anonym=1" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
&anonym=1', 560, 400, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;"  class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></strong>
				<?php  endif; ?>
								<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'profile_widget','profileSID' => $this->_tpl_vars['listing']['user']['id']), $this);?>

								<?php  $_from = $this->_tpl_vars['video_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id']):
?>
					<?php  if ($this->_tpl_vars['listing'][$this->_tpl_vars['field_id']]['file_url'] != ""): ?>
					<br/><center><?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_player.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center><br/>
					<?php  endif; ?>
				<?php  endforeach; endif; unset($_from); ?>
				<?php  if ($this->_tpl_vars['listing']['Youtubevideo']): ?>
					<br /><center><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>youtube<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong></center>
					<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'Youtubevideo'), $this);?>

				<?php  endif; ?>
				<?php  $_from = $this->_tpl_vars['listing']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picimages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picimages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['picture']):
        $this->_foreach['picimages']['iteration']++;
?>
						<br/><a target="_blank" href ="<?php  echo $this->_tpl_vars['picture']['picture_url']; ?>
"> <img src="<?php  echo $this->_tpl_vars['picture']['thumbnail_url']; ?>
" border="0" title="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" alt="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" /> </a>
				<?php  endforeach; endif; unset($_from); ?>
			</div>
			<div class="compProfileBottom"></div>
		</div>
		<!--- END PROFILE BLOCK --->
	</div>
	
	<div id="listingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</h2>
			<div class="clr"><br/></div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resumes ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['id'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['id'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resumes Views<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['listing']['views']; ?>

				
				
			<?php  if ($this->_tpl_vars['listing']['Resume']['file_url'] != ""): ?>
				<div class="downloadResume_right">
					<a href="?filename=<?php  echo $this->_tpl_vars['listing']['Resume']['saved_file_name']; ?>
">
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
ico_resume.gif" alt=""/><span style="display: block; position: relative; top: -30px; left: 40px;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Uploaded resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>available. Click<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>here to view<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
					</a>
				</div>
			<?php  endif; ?>
				
				</div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Location<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  if ($this->_tpl_vars['listing']['City']):   echo $this->_tpl_vars['listing']['City']; ?>
, <?php  endif;   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>, <?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_Country')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Zip Code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  echo $this->_tpl_vars['listing']['ZipCode']; ?>
</div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Type<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['EmploymentType'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['EmploymentType'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Category<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['JobCategory'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['JobCategory'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="clr"><br/></div>
			
			<?php  if ($this->_tpl_vars['listing']['Objective']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Objective<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
				<?php  echo $this->_tpl_vars['listing']['Objective']; ?>

				<div class="clr"><br/></div>
			<?php  endif; ?>
			
			<?php  if ($this->_tpl_vars['listing']['Education']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Education<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
			    <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'Education'), $this);?>

			    <div class="clr"><br/></div>
			<?php  endif; ?>
			
			<?php  if ($this->_tpl_vars['listing']['WorkExperience']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Work Experience<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
				<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'WorkExperience'), $this);?>

				<div class="clr"><br/></div>
			<?php  endif; ?>

			<?php  if ($this->_tpl_vars['listing']['TotalYearsExperience']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Years Experience<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
				<?php  echo $this->_tpl_vars['listing']['TotalYearsExperience']; ?>
 <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>years<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<div class="clr"><br/></div>
			<?php  endif; ?>
		
			<?php  if ($this->_tpl_vars['listing']['Skills']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Skills<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
				<?php  echo $this->_tpl_vars['listing']['Skills']; ?>

				<div class="clr"><br/></div>
			<?php  endif; ?>
		
			<?php  if ($this->_tpl_vars['listing']['DesiredSalary']['value']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Desired Salary<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
				<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'DesiredSalary'), $this);?>
 <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['DesiredSalaryType'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['DesiredSalaryType'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<div class="clr"><br/></div>
			<?php  endif; ?>
		
			<?php  if ($this->_tpl_vars['listing']['Occupations']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Occupations<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h3>
				<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'Occupations'), $this);?>

			    <div class="clr"><br/></div>
			<?php  endif; ?>
		    
						<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'facebook_like_button','listing' => $this->_tpl_vars['listing'],'type' => 'Resume'), $this);?>

						<?php  if ($this->_tpl_vars['GLOBALS']['plugins']['ShareThisPlugin']['active'] == 1 && $this->_tpl_vars['GLOBALS']['settings']['display_on_resume_page'] == 1): ?>
				<?php  echo $this->_tpl_vars['GLOBALS']['settings']['header_code']; ?>

				<?php  echo $this->_tpl_vars['GLOBALS']['settings']['code']; ?>

			<?php  endif; ?>
			
			<div class="clr"><br/></div>
		    	
			<?php  if ($this->_tpl_vars['acl']->isAllowed('add_resume_comments')): ?>
					<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listing_comments.tpl", 'smarty_include_vars' => array('listing' => $this->_tpl_vars['listing'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php  endif; ?>
			
			
			
			
			
		</div>
		<!--- END LISTING INFO BLOCK --->
	</div>
	
	<div id="endResults">
		<ul class="listingLinksBottom">	
			<?php  if ($this->_tpl_vars['searchId'] != "" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>
				<li class="paggingBottom">
					<p align="right" class="page_navigator">
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png" alt=""  border="0"/>
						<font color="#787878">
						<?php  if ($this->_tpl_vars['prev_next_ids']['prev']): ?>
							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>my-resume-details<?php  else: ?>display-resume<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['prev']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<?php  else: ?>
							<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php  endif; ?>
						&nbsp;
						<?php  if ($this->_tpl_vars['prev_next_ids']['next']): ?>
							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-resume-details"): ?>my-resume-details<?php  else: ?>display-resume<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['next']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<?php  else: ?>
							<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php  endif; ?>
						</font>	
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png" alt=""  border="0"/>
					</p>
				</li>
			<?php  endif; ?>
		</ul>
		<!--- END BOTTOM PAGGING --->
	</div>
	<?php  endif; ?>
</div>