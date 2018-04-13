<?php  /* Smarty version 2.6.14, created on 2018-03-02 22:49:37
         compiled from saved_listings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'saved_listings.tpl', 9, false),array('function', 'cycle', 'saved_listings.tpl', 57, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
<?php  echo '
$.ui.dialog.defaults.bgiframe = true;
function popUpWindow(url, widthWin, heightWin, title){
	reloadPage = false;
	newPageReload = false;
	$("#messageBox").dialog( \'destroy\' ).html(\''; ?>
<img style="vertical-align: middle;" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if(newPageReload == true) {
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
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Listings<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actions With Selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
<form name="SavedListingForm" action="">
	<input id="action" type="hidden" name="action" value="" />
	<input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"	class="button" onclick="if (confirm('<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure you want to delete this listing?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')) submitForm('delete');" /><br/><br/>
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="1"><input type="checkbox" id="all_checkboxes_control"></th>
				<th width="85%"><strong><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></th>
				<th><?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
			<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings_block']['iteration']++;
?>
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
				<?php  $this->assign('link', 'display-job'); ?>
			<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>
				<?php  $this->assign('link', 'display-resume'); ?>
			<?php  endif; ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => false), $this);?>
">
				<td> </td>
				<td><input type="checkbox" name="listing_id[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['listings_block']['iteration']; ?>
"/></td>
				<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  echo $this->_tpl_vars['link']; ?>
/<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</a></td>
				<td><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['activation_date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['activation_date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
				<td> </td>
			</tr>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
				<td> </td>
				<td> </td>
				<td colspan="2">
					<ul>
						<li>
							<span id='notes_<?php  echo $this->_tpl_vars['listing']['id']; ?>
'>
							<?php  if ($this->_tpl_vars['listing']['saved_listing']['note'] != ''): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
'); return false;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  else: ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
'); return false;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
							<?php  endif; ?>
							</span>
						</li>
						<li><a href="?action=delete&amp;listing_id[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  echo $this->_tpl_vars['link']; ?>
/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View details<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<?php  if ($this->_tpl_vars['listing']['video']['file_url']): ?>
						<li><a style="cursor: hand;" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
', 282, 300, 'VideoPlayer'); return false;"  href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Watch a video<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						<?php  endif; ?>
						<li></li>
						<li></li>
					</ul>
					<span id = 'formNote_<?php  echo $this->_tpl_vars['listing']['id']; ?>
'>
					<?php  if ($this->_tpl_vars['listing']['saved_listing']['note'] != ''): ?>
						<div style='color: #787878;'><b><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> <?php  echo $this->_tpl_vars['listing']['saved_listing']['note']; ?>
</div>
					<?php  endif; ?>
					</span>
				</td>
				<td> </td>
			</tr>
			<tr>
				<td colspan="5" class="separateListing"> </td>
			</tr>
			<?php  endforeach; else: ?>
				<tr>
					<td> </td>
					<td colspan="3"><center><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no saved listings<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></center></td>
					<td> </td>
				</tr>
			<?php  endif; unset($_from); ?>
		</tbody>
	</table>
</form>

<script type="text/javascript">
var total = <?php  echo $this->_foreach['listings_block']['total']; ?>
;
<?php  echo '

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById(\'checkbox_\' + i))
			checkbox.checked = param;
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});

function submitForm(action) {
	document.getElementById(\'action\').value = action;
	var form = document.applicationForm;
	form.submit();
}
</script>
'; ?>
	
	