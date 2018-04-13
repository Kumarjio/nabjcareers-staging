<?php  /* Smarty version 2.6.14, created on 2014-03-28 04:58:21
         compiled from ../field_types/input/video.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/video.tpl', 10, false),)), $this); ?>
<?php  if ($this->_tpl_vars['value']['file_name'] != null && $this->_tpl_vars['url'] != '/add-listing/'): ?>
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
	<script type="text/javascript" language="JavaScript">
	<?php  echo '
	$.ui.dialog.defaults.bgiframe = true;
	function popUpWindow(url, widthWin, heightWin, title){
	
		$("#messageBox").dialog( \'destroy\' ).html(\''; ?>
<img align="absmiddle" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif"/> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title
		}).dialog( \'open\' );
		
		$.get(url, function(data){
			$("#messageBox").html(data);  
		});
		return false;
	}
	'; ?>

	</script>
	
	<a onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
', 282, 300, 'VideoPlayer'); return false;" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/video-player/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Watch a video<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	|
	<?php  if ($this->_tpl_vars['copy_listing'] != null): ?> 
	    <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/clone-job/?listing_id=<?php  echo $this->_tpl_vars['listing_id']; ?>
&amp;action=delete&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	    <input type="hidden" name="<?php  echo $this->_tpl_vars['id']; ?>
_hidden<?php  if ($this->_tpl_vars['complexField']): ?>[<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  endif; ?>" value="1" />
	<?php  else: ?>
	    <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/delete-uploaded-file/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<?php  endif; ?>
	<br/><br/>
<?php  endif; ?>
<input type="file" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" />