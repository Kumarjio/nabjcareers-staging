<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:47:18
         compiled from manage_listings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'manage_listings.tpl', 1, false),array('function', 'search', 'manage_listings.tpl', 13, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Listings<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Manage Listings</h1>

<?php  if ($this->_tpl_vars['show_search_form'] == 0): ?>
	<div class="setting_button" id="mediumButton">Click to modify search criteria<div class="setting_icon"><div id="accordeonClosed"></div></div></div>
	<div class="setting_block" style="display: none" id="clearTable">
<?php  else: ?>
	<div class="setting_block" id="clear">
<?php  endif; ?>
		<form method="post" name="search_form">
			<input type="hidden" name="action" value="search" />
			<table  width="100%">
				<tr><td>Listing ID: </td>		<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'id'), $this);?>
</td></tr>
				<tr><td>Listing Type: </td>		<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'listing_type'), $this);?>
</td></tr>
				<tr><td>Category: </td>			<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'JobCategory'), $this);?>
</td></tr>
				<tr><td>Activation Date:</td>	<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'activation_date'), $this);?>
</td></tr>
				<tr><td>Expiration Date:</td>	<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'expiration_date'), $this);?>
</td></tr>
				<tr><td>Username: </td>			<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'username'), $this);?>
</td></tr>
				<tr><td>Keyword: </td>			<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'keywords'), $this);?>
</td></tr>
				<?php  if ($this->_tpl_vars['showApprovalStatusField'] != false): ?>
					<tr><td>Approval Status: </td>	<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'status'), $this);?>
</td></tr>
				<?php  endif; ?>
				<tr><td>Featured: </td>			<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'featured'), $this);?>
</td></tr>
				<tr><td>Status: </td>			<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'active'), $this);?>
</td></tr>
				<tr><td>Data Source: </td>		<td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'data_source'), $this);?>
</td></tr>
				<tr><td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Find" class="greenButton" /></span></td></tr>
			</table>
		</form>
	</div>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>

<script>
	var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
	<?php  echo '
	dFormat = dFormat.replace(\'%m\', "mm");
	dFormat = dFormat.replace(\'%d\', "dd");
	dFormat = dFormat.replace(\'%Y\', "yy");
	
	$( function() {
		$("#activation_date_notless, #activation_date_notmore").datepicker({
			dateFormat: dFormat, 
			showOn: \'button\', 
			buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/calendar.gif<?php  echo '\',
			yearRange: \'-99:+99\',
			buttonImageOnly: true 
		});
		
		$("#expiration_date_notless, #expiration_date_notmore").datepicker({
			dateFormat: dFormat, 
			showOn: \'button\', 
			buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/calendar.gif<?php  echo '\',
			yearRange: \'-99:+99\',
			buttonImageOnly: true 
		});
	
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("<div id=\'accordeonOpen\'></div>");
						butt.children("b").text("Click to hide search criteria");
					} else {
						butt.children(".setting_icon").html("<div id=\'accordeonClosed\'></div>");
						butt.children("b").text("Click to modify search criteria");
					}
				});
		});
		
	});
	'; ?>

</script>