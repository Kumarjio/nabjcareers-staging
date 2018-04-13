<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:39
         compiled from display_job.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', 'display_job.tpl', 2, false),array('block', 'keywords', 'display_job.tpl', 3, false),array('block', 'description', 'display_job.tpl', 4, false),array('block', 'tr', 'display_job.tpl', 8, false),array('modifier', 'escape', 'display_job.tpl', 38, false),array('modifier', 'replace', 'display_job.tpl', 192, false),array('function', 'image', 'display_job.tpl', 144, false),array('function', 'module', 'display_job.tpl', 204, false),)), $this); ?>
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
				<?php  elseif ($this->_tpl_vars['error_code'] == 'LISTING_IS_NOT_ACTIVE'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This Job is no longer available<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
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
		<script type="text/javascript"><!---
		$.ui.dialog.defaults.bgiframe = true;
		function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
			reloadPage = false;
			$("#messageBox").dialog( \'destroy\' ).html('; ?>
'<?php  ob_start(); ?><img style="vertical-align: middle;" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $this->_smarty_vars['capture']['displayJobProgressBar'] = ob_get_contents(); ob_end_clean();   echo ((is_array($_tmp=$this->_smarty_vars['capture']['displayJobProgressBar'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
'<?php  echo ');
			$("#messageBox").dialog({
				width: widthWin,
				height: heightWin,
				modal: true,
				title: title,
				close: function(event, ui) {
					if (parentReload == true && !userLoggedIn && reloadPage == true) {
						parent.document.location.reload();
					}
				}
			}).dialog( \'open\' );
	
			$.get(url, function(data){
				$("#messageBox").html(data);
			});
	
			return false;
		}
		function windowMessage() {
			$("#messageBox").dialog( \'destroy\' ).html(\'You already applied\');
			$("#messageBox").dialog({
				bgiframe: true,
				modal: true,
				title: \'Error\',
				buttons: {
					Ok: function() {
						$(this).dialog(\'close\');
					}
				}
			});
		}
	
	
		'; ?>

		var link = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/";
		<?php  echo '
	
		// send flagForm and show result
		function sendFlagForm() {
	
			$("#flagForm").ajaxSubmit({
				url: link,
				success: function(response, status) {
					$("#messageBox").html(response);
				}
			});
	
			return false;
		}
	
		--></script>
		'; ?>

	
	<div class="results">
		<div id="topResults">
			<!-- SAVE LISTING / PRINT LISTING -->
			<div class="searchResultsHeaderLineNew">
				<ul>
					<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] != "/my-job-details"): ?>
						<li class="panelSavedIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-ads/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&displayForm=1', 350, 300, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save this Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<li class="panelViewDitailsIco">
							<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>
								<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-jobs" class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Saved Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?>
								<a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings/?listing_type_id=job', 350, 300, 'Saved jobs'); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-listings"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Saved Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  endif; ?>
						</li>
					<?php  endif; ?>
					<li class="printListingIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/tell-friends/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/tell-friends/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
', 400, 470, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tell a Friend<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" id="message_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tell a Friend<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<?php  if ($this->_tpl_vars['acl']->isAllowed('flag_job')): ?>
						<li class="printListingIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/flag-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
', 400, 350, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Flag Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'); return false;" id="message_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Flag This Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
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
			<div class="underQuickLinks">
				<div class="ModResults">&nbsp;
					<?php  if ($this->_tpl_vars['searchId'] != "" && $this->_tpl_vars['GLOBALS']['user_page_uri'] != "/my-job-details"): ?>
						<ul>
							<li class="arrow"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['search_uri']; ?>
?action=search&amp;searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
#listing_<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Results<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
							<li class="modifySearchIco"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/find-jobs/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modify Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						</ul>
					<?php  endif; ?>
				</div>
				<div class="Rating">&nbsp;
					<?php  if ($this->_tpl_vars['show_rates'] != 0 && $this->_tpl_vars['acl']->isAllowed('add_job_ratings')): ?>
						<ul>
							<li class="ratingPanel"><p style="float:left; margin-top: 0px; padding: 0px;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rate This Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "rating.tpl", 'smarty_include_vars' => array('listing' => $this->_tpl_vars['listing'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p></li>
						</ul>
					<?php  endif; ?>
				</div>
				<div class="Comments">&nbsp;
					<?php  if ($this->_tpl_vars['show_comments'] != 0 && $this->_tpl_vars['acl']->isAllowed('add_resume_comments')): ?>
						<ul><li class="comments"><a href="#comment_1"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (+<?php  echo $this->_tpl_vars['listing']['comments_num']; ?>
)</a></li></ul>
					<?php  endif; ?>
				</div>
				<div class="Pagging">&nbsp;
					<?php  if ($this->_tpl_vars['searchId'] != "" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>
						<ul>
							<li class="pagging">
								<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png"  style="margin-right:2px;" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0" />
								<?php  if ($this->_tpl_vars['prev_next_ids']['prev']): ?>
									<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>my-job-details<?php  else: ?>display-job<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['prev']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp;
								<?php  else: ?>
									<?php  if (! $this->_tpl_vars['prev_next_ids']['prev'] && ! $this->_tpl_vars['prev_next_ids']['next']):   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &nbsp;<?php  endif; ?>
								<?php  endif; ?>
								<?php  if ($this->_tpl_vars['prev_next_ids']['next']): ?>
									<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>my-job-details<?php  else: ?>display-job<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['next']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
								<?php  else: ?>
									<?php  if (! $this->_tpl_vars['prev_next_ids']['prev'] && ! $this->_tpl_vars['prev_next_ids']['next']):   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
								<?php  endif; ?>
								<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png"  style="margin-left:2px;" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0"/>
							</li>
						</ul>
					<?php  endif; ?>
				</div>
			</div>
			<!-- END MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
		</div>
	</div>
	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo">
			<div id="blockTop"></div>
			<div class="compProfileTitle"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="compProfileInfo">
				<?php  if ($this->_tpl_vars['listing']['anonymous'] != 1 || $this->_tpl_vars['applications']['anonymous'] === 0): ?>
					<?php  if ($this->_tpl_vars['listing']['user']['Logo']['file_url']): ?>
						<center><img src="<?php  echo $this->_tpl_vars['listing']['user']['Logo']['file_url']; ?>
" alt="" /></center><br/>
					<?php  endif; ?>
										<strong>
<?php  if ($this->_tpl_vars['listing']['company_name']):   echo $this->_tpl_vars['listing']['company_name'];   else:   echo $this->_tpl_vars['listing']['CompanyName'];   endif; ?>
</strong>
					<br /><?php  echo $this->_tpl_vars['listing']['user']['Address']; ?>

					<br /><?php  if ($this->_tpl_vars['listing']['user']['City']):   echo $this->_tpl_vars['listing']['user']['City']; ?>
, <?php  endif;   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['user']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['user']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  if ($this->_tpl_vars['listing']['user']['Country']): ?>(<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['user']['Country'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['user']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<?php  endif; ?>
					<br/><br/>
					
										<?php  if ($this->_tpl_vars['listing']['company_name']): ?>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&amp;username[equal]=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
&company_name[equal]=<?php  echo $this->_tpl_vars['listing']['company_name']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  else: ?>
						<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['listing']['user']['PhoneNumber']; ?>
<br/>
						<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Web<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <a href="<?php  if (strpos ( $this->_tpl_vars['listing']['user']['WebSite'] , 'http://' ) === false): ?>http://<?php  endif;   echo $this->_tpl_vars['listing']['user']['WebSite']; ?>
" target="_blank"><?php  echo $this->_tpl_vars['listing']['user']['WebSite']; ?>
</a><br/><br/>
						<?php  if (strpos ( $this->_tpl_vars['listing']['user']['CompanyName'] , '-' ) !== false): ?>
							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&amp;username[equal]=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br/>
						<?php  else: ?>
							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/company/<?php  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['listing']['user']['CompanyName'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', "-") : smarty_modifier_replace($_tmp, ' ', "-")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br/>
						<?php  endif; ?>
					<?php  endif; ?>
	
					<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id'];   if ($this->_tpl_vars['listing']['subuser']): ?>&amp;cc=<?php  echo $this->_tpl_vars['listing']['subuser']['id'];   endif; ?>" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['listing']['user']['id']; ?>
&ajaxRelocate=1<?php  if ($this->_tpl_vars['listing']['subuser']): ?>&cc=<?php  echo $this->_tpl_vars['listing']['subuser']['id'];   endif; ?>', 560, 400, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;"  class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  endif; ?>
				<?php  else: ?>
					<center><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></center>
				<?php  endif; ?>
				<br/>
								<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'company_insider_widget','companyName' => $this->_tpl_vars['listing']['user']['CompanyName']), $this);?>

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
				<br/>
				
				<?php  if ($this->_tpl_vars['listing']['youtube']): ?>
					<br/>
					<center><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>youtube<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong></center>
									<?php  endif; ?>
				<br/>
				
				<center>
					<?php  $_from = $this->_tpl_vars['listing']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picimages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picimages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['picture']):
        $this->_foreach['picimages']['iteration']++;
?>
						<br/><a target="_black" href ="<?php  echo $this->_tpl_vars['picture']['picture_url']; ?>
"> <img src="<?php  echo $this->_tpl_vars['picture']['thumbnail_url']; ?>
" border="0" title="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" alt="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" /></a>
					<?php  endforeach; endif; unset($_from); ?>
				</center>
				<br/>
			</div>
			<div class="compProfileBottom"></div>
		</div>
		<!--- END PROFILE BLOCK --->
	</div>
	
	<div id="listingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2><?php  echo $this->_tpl_vars['listing']['Title']; ?>

				<?php  if ($this->_tpl_vars['acl']->isAllowed('apply_for_a_job') && $this->_tpl_vars['listing']['ApplicationSettings'] != ""): ?>
					<div style="float: right"><input type="button" class="buttonApply" style="float: right;" <?php  if ($this->_tpl_vars['isApplied']): ?>onclick="windowMessage();"<?php  else:   if ($this->_tpl_vars['listing']['ApplicationSettings']['add_parameter'] && $this->_tpl_vars['listing']['ApplicationSettings']['add_parameter'] == 2): ?>onclick="javascript:window.open('<?php  if ($this->_tpl_vars['listing']['company_name']):   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/apply-now-external/?listing_id=<?php  echo $this->_tpl_vars['listing']['id'];   else:   echo $this->_tpl_vars['listing']['ApplicationSettings']['value'];   endif; ?>');"<?php  else: ?>onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/apply-now/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&ajaxRelocate=1', 520, 480, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Apply now<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')"<?php  endif;   endif; ?>  value='<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Apply now<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>' /></div>
				<?php  endif; ?>
			</h2>
			<div class="clr"><br/></div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['id'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['id'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Views<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['listing']['views']; ?>
</div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Location<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  if ($this->_tpl_vars['listing']['City']):   echo $this->_tpl_vars['listing']['City']; ?>
,<?php  endif; ?> <?php  if ($this->_tpl_vars['listing']['State'] != 'Outside The US (No State)'):   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>, <?php  endif;   $this->_tag_stack[] = array('tr', array('domain' => 'Property_Country')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Zip Code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  echo $this->_tpl_vars['listing']['ZipCode']; ?>
</div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Category<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  echo $this->_tpl_vars['listing']['JobCategory']; ?>
</div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Employment Type<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  echo $this->_tpl_vars['listing']['EmploymentType']; ?>
</div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Salary<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  echo $this->_tpl_vars['listing']['Salary']['value']; ?>
 <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['SalaryType'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['SalaryType'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="smallListingInfo"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="clr"><br/></div>
	
			<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
				<?php  if ($this->_tpl_vars['listing']['Occupations']): ?>
					<h3><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Occupations<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
					<?php  echo $this->_tpl_vars['listing']['Occupations']; ?>

					<div class="clr"><br/></div>
				<?php  endif; ?>
			<?php  endif; ?>
	
			<?php  if ($this->_tpl_vars['listing']['JobDescription']): ?>
				<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
				<?php  echo $this->_tpl_vars['listing']['JobDescription']; ?>

				<div class="clr"><br/></div>
			<?php  endif; ?>
	
			<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
				<?php  if ($this->_tpl_vars['listing']['JobRequirements']): ?>
					<h3><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Requirements<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
					<?php  echo $this->_tpl_vars['listing']['JobRequirements']; ?>

					<div class="clr"><br/></div>
				<?php  endif; ?>
			<?php  endif; ?>
	
			<?php  if ($this->_tpl_vars['GLOBALS']['plugins']['ShareThisPlugin']['active'] == 1 && $this->_tpl_vars['GLOBALS']['settings']['display_on_job_page'] == 1): ?>
				<?php  echo $this->_tpl_vars['GLOBALS']['settings']['header_code']; ?>

				<?php  echo $this->_tpl_vars['GLOBALS']['settings']['code']; ?>

			<?php  endif; ?>
		    			<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'facebook_like_button','listing' => $this->_tpl_vars['listing'],'type' => 'Job'), $this);?>

		    		    			<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'linkedin_share_button','listing' => $this->_tpl_vars['listing']), $this);?>

		    			<div class="clr"><br/></div>
	
			<?php  if ($this->_tpl_vars['acl']->isAllowed('add_job_comments')): ?>
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
			<?php  if ($this->_tpl_vars['searchId'] != "" || $this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>
				<li class="paggingBottom">
					<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
prev_btn.png"  style="margin-right:5px;" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0" />
					<?php  if ($this->_tpl_vars['prev_next_ids']['prev']): ?>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>my-job-details<?php  else: ?>display-job<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['prev']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp;
					<?php  else: ?>
						<?php  if (! $this->_tpl_vars['prev_next_ids']['prev'] && ! $this->_tpl_vars['prev_next_ids']['next']):   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &nbsp;<?php  endif; ?>
					<?php  endif; ?>
					<?php  if ($this->_tpl_vars['prev_next_ids']['next']): ?>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] == "/my-job-details"): ?>my-job-details<?php  else: ?>display-job<?php  endif; ?>/<?php  echo $this->_tpl_vars['prev_next_ids']['next']; ?>
/?searchId=<?php  echo $this->_tpl_vars['searchId']; ?>
&amp;page=<?php  echo $this->_tpl_vars['page']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  else: ?>
						<?php  if (! $this->_tpl_vars['prev_next_ids']['prev'] && ! $this->_tpl_vars['prev_next_ids']['next']):   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
					<?php  endif; ?>
					<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
next_btn.png"  style="margin-left:5px;" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  border="0"/>
				</li>
			<?php  endif; ?>
		</ul>
	</div>
	<?php  endif; ?>
</div>