<?php  /* Smarty version 2.6.14, created on 2018-02-09 12:31:36
         compiled from save_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'save_listing.tpl', 24, false),)), $this); ?>

<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<?php  echo '
<script>
	function Submit() {
		var options = {
				  target: "#messageBox",
				  url:  $("#notesForm").attr("action")
				}; 
		$("#notesForm").ajaxSubmit(options);
		return false;
	}
	function addNote() {
		document.getElementById(\'add_notes_block\').style.display = \'block\';
	}
</script>
'; ?>

<?php  if ($this->_tpl_vars['error']): ?>
<div style='color:red;'>
	<b>
		<?php  if ($this->_tpl_vars['error'] == 'LISTING_ID_NOT_SPECIFIED'): ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing ID not specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php  elseif ($this->_tpl_vars['error'] == 'DENIED_SAVE_LISTING'): ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have no permission to save an ad<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php  endif; ?>
	</b>
</div>
<?php  else: ?>
	<?php  if (! $this->_tpl_vars['from_login'] && ! $this->_tpl_vars['displayForm']): ?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_id=<?php  echo $this->_tpl_vars['listing_sid']; ?>
" onclick="SaveAd('formNote_<?php  echo $this->_tpl_vars['listing_sid']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?listing_sid=<?php  echo $this->_tpl_vars['listing_sid']; ?>
'); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
	<?php  else: ?>
		<?php  if ($this->_tpl_vars['error'] == null): ?>
			<?php  if ($this->_tpl_vars['listing_type'] == 'resume'): ?>
			<p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume has been saved<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  else: ?>
			<p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job has been saved<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  endif; ?>
			<?php  if ($this->_tpl_vars['displayForm']): ?><a href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes' onclick='addNote();return false;'><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<div id='add_notes_block' style='display:none;'>
			<form id='notesForm' action='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/' onsubmit="return Submit()">
				<input type="hidden" name="actionNew" value='save'/>
				<input type="hidden" name="listing_sid" value='<?php  echo $this->_tpl_vars['listing_sid']; ?>
'/>
				<textarea style='width:100%; height:120px' name='note'></textarea>
				<input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
			</form>
			</div>
			<?php  endif; ?>
		<?php  elseif ($this->_tpl_vars['error'] == 'LISTING_ID_NOT_SPECIFIED'): ?>
		
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Listing ID not specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php  elseif ($this->_tpl_vars['error'] == 'DENIED_SAVE_LISTING'): ?>
		
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You're not allowed to open this page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php  endif; ?>
		<?php  echo '
			<script>
				var reloadPage = true;
			</script>
		'; ?>

	<?php  endif; ?>
<?php  endif; ?>