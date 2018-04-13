<?php  /* Smarty version 2.6.14, created on 2014-10-26 01:39:35
         compiled from company_profile.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'company_profile.tpl', 2, false),)), $this); ?>
<?php  $this->assign('listing', $this->_tpl_vars['tmp_listing']); ?>
<center><h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1></center>
<!--- PROFILE BLOCK --->
<div class="userInfo">
	<div class="compProfileTitle"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	<div class="compProfileInfo">
		<?php  if (isset ( $_GET['userProfile'] )): ?>				
			<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listing_profiles'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listing_profiles']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing_key'] => $this->_tpl_vars['listing_profile']):
        $this->_foreach['listing_profiles']['iteration']++;
?>
				
				<?php  if ($this->_tpl_vars['listing_profile']['user']['id'] == $_GET['userProfile']): ?>
					<?php  if ($this->_tpl_vars['listing_profile']['user']['Logo']['file_url']): ?>
						<center><img src="<?php  echo $this->_tpl_vars['listing_profile']['user']['Logo']['file_url']; ?>
" alt="" /></center><br/>
					<?php  endif; ?>
	
					<strong><?php  if (isset ( $_GET['company_name'] )):   echo $_GET['company_name']['equal'];   else:   echo $this->_tpl_vars['listing_profile']['user']['CompanyName'];   endif; ?> </strong>
					<br /><?php  echo $this->_tpl_vars['listing_profile']['user']['Address']; ?>

					<br /><?php  if ($this->_tpl_vars['listing_profile']['user']['City']):   echo $this->_tpl_vars['listing_profile']['user']['City']; ?>
, <?php  endif;   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing_profile']['user']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing_profile']['user']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
					<?php  if ($this->_tpl_vars['listing_profile']['user']['Country']): ?>(<?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_Country')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing_profile']['user']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<?php  endif; ?>
					<br/><br/>
					
					<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
						<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['listing_profile']['user']['PhoneNumber']; ?>
<br/>
						<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Web<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <a href="<?php  if (strpos ( $this->_tpl_vars['listing_profile']['user']['WebSite'] , 'http://' ) === false): ?>http://<?php  endif;   echo $this->_tpl_vars['listing_profile']['user']['WebSite']; ?>
" target="_blank"><?php  echo $this->_tpl_vars['listing_profile']['user']['WebSite']; ?>
</a><br /><br />
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['listing_profile']['user']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['listing_profile']['user']['id']; ?>
', 560, 420, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<br/>
					<?php  endif; ?>
					
					<?php  if ($this->_tpl_vars['listing_profile']['user']['video']['file_url'] != ""): ?>
						<br/><center><?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_player_profile.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center><br/>
					<?php  endif; ?>
							
					
					<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
					<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
					<script language="JavaScript" type="text/javascript"><!--
						<?php  echo '
							$.ui.dialog.defaults.bgiframe = true;
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

					--></script>
				
								
								
					<div class="compProfileBottom">&nbsp;</div>
					<center>
						<?php  $_from = $this->_tpl_vars['listing']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picimages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picimages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['picture']):
        $this->_foreach['picimages']['iteration']++;
?>
							<a target="_black" href="<?php  echo $this->_tpl_vars['picture']['picture_url']; ?>
"> <img src="<?php  echo $this->_tpl_vars['picture']['thumbnail_url']; ?>
" border="0" title="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" alt="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" /></a><br />
						<?php  endforeach; endif; unset($_from); ?>
					</center>
				
					<!--- END PROFILE BLOCK --->
					
					<div class="listingInfo">
						<h2><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h2>
						<?php  echo $this->_tpl_vars['listing_profile']['user']['CompanyDescription']; ?>

					</div>
					
					<?php  break; ?>
				<?php  endif; ?>
			<?php  endforeach; endif; unset($_from); ?>
			
			
			
				
		<?php  else: ?>
			<?php  if ($this->_tpl_vars['userInfo']['Logo']['file_url']): ?>
				<center><img src="<?php  echo $this->_tpl_vars['userInfo']['Logo']['file_url']; ?>
" alt="" /></center><br/>
			<?php  endif; ?>
							<strong><?php  if (isset ( $_GET['company_name'] )):   echo $_GET['company_name']['equal'];   else:   echo $this->_tpl_vars['userInfo']['CompanyName'];   endif; ?> </strong>
				<br /><?php  echo $this->_tpl_vars['userInfo']['Address']; ?>

				<br /><?php  if ($this->_tpl_vars['userInfo']['City']):   echo $this->_tpl_vars['userInfo']['City']; ?>
, <?php  endif;   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['userInfo']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['userInfo']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  if ($this->_tpl_vars['userInfo']['Country']): ?>(<?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_Country')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['userInfo']['Country'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<?php  endif; ?>
				<br/><br/>
			
				<?php  if (! $this->_tpl_vars['listing']['company_name']): ?>
					<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <?php  echo $this->_tpl_vars['userInfo']['PhoneNumber']; ?>
<br/>
					<strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Web<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>: <a href="<?php  if (strpos ( $this->_tpl_vars['userInfo']['WebSite'] , 'http://' ) === false): ?>http://<?php  endif;   echo $this->_tpl_vars['userInfo']['WebSite']; ?>
" target="_blank"><?php  echo $this->_tpl_vars['userInfo']['WebSite']; ?>
</a><br /><br />
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['userInfo']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['userInfo']['id']; ?>
', 560, 420, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<br/>
				<?php  endif; ?>
			
				<?php  if ($this->_tpl_vars['userInfo']['video']['file_url'] != ""): ?>
					<br/><center><?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_player_profile.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center><br/>
				<?php  endif; ?>
	
				<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
				<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>

				<script language="JavaScript" type="text/javascript"><!--
					<?php  echo '
						$.ui.dialog.defaults.bgiframe = true;
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

				--></script>
		
			
				<div class="compProfileBottom">&nbsp;</div>
				<center>
					<?php  $_from = $this->_tpl_vars['listing']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picimages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picimages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['picture']):
        $this->_foreach['picimages']['iteration']++;
?>
						<a target="_black" href="<?php  echo $this->_tpl_vars['picture']['picture_url']; ?>
"> <img src="<?php  echo $this->_tpl_vars['picture']['thumbnail_url']; ?>
" border="0" title="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" alt="<?php  echo $this->_tpl_vars['picture']['caption']; ?>
" /></a><br />
					<?php  endforeach; endif; unset($_from); ?>
				</center>
			
			<!--- END PROFILE BLOCK --->
	
				<div class="listingInfo">
					<h2><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company Description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</h2>
					<?php  echo $this->_tpl_vars['userInfo']['CompanyDescription']; ?>

				</div>
		<?php  endif; ?>
	</div>
</div>
<div class="clr"><br /></div>