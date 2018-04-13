<?php  /* Smarty version 2.6.14, created on 2014-03-07 05:39:13
         compiled from ../field_types/search/text.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '../field_types/search/text.tpl', 2, false),array('block', 'tr', '../field_types/search/text.tpl', 5, false),)), $this); ?>
<?php  if ($this->_tpl_vars['templateParams']['type'] == 'bool'): ?>
<input type="text" value="<?php  if ($this->_tpl_vars['value']['exact_phrase']):   echo ((is_array($_tmp=$this->_tpl_vars['value']['exact_phrase'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));   elseif ($this->_tpl_vars['value']['all_words']):   echo ((is_array($_tmp=$this->_tpl_vars['value']['all_words'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));   elseif ($this->_tpl_vars['value']['any_words']):   echo ((is_array($_tmp=$this->_tpl_vars['value']['any_words'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));   elseif ($this->_tpl_vars['value']['boolean']):   echo ((is_array($_tmp=$this->_tpl_vars['value']['boolean'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));   else:   echo ((is_array($_tmp=$this->_tpl_vars['value']['like'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));   endif; ?>" class="searchText" name="<?php  echo $this->_tpl_vars['id']; ?>
[like]"  id="<?php  echo $this->_tpl_vars['id']; ?>
" /><br/>
<div style="display: inline-block; float: left;">
<select size="1" id="searchType-<?php  echo $this->_tpl_vars['id']; ?>
">
    <option value="exact_phrase" <?php  if ($this->_tpl_vars['value']['exact_phrase']): ?>selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Match exact phrase<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
    <option value="all_words" <?php  if ($this->_tpl_vars['value']['all_words']): ?>selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Match all words<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
    <option value="any_words" <?php  if ($this->_tpl_vars['value']['any_words']): ?>selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Match any words<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
    <option value="boolean" <?php  if ($this->_tpl_vars['value']['boolean']): ?>selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Boolean<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
</select>
</div>
<div id="helplink"></div>
<div style="display: inline-block; margin: 0 0 0 10px">
	<?php  if ($this->_tpl_vars['templateParams']['listingType'] == 'Job'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search job title only<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   elseif ($this->_tpl_vars['templateParams']['listingType'] == 'Resume'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search resume title only<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search by title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
	<input type="checkbox" value="Title" id="titleOnly-<?php  echo $this->_tpl_vars['id']; ?>
" <?php  if ($this->_tpl_vars['title']): ?>checked="checked"<?php  endif; ?> />
</div>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>

<script>
<?php  echo '
	//FIXME: будет вываливаться на одной форме будет несколько полей типа bool
$.ui.dialog.defaults.bgiframe = true;
	
	function setBoolSearch(id) {
		var where = id;
		var fieldId = \'#\' + id;
		var stId = "#searchType-" + id;
		var toId = "#titleOnly-" + id;
		$(fieldId).attr(\'name\', where+\'[\'+$(stId).val()+\']\');
		$(stId).change(function() {
			$(fieldId).attr(\'name\', where+\'[\'+$(stId).val()+\']\');
			if($(stId).val()=="boolean"){
				$("#helplink").html("<a href=\'#\'  onclick=\'showHelp();\'>"+'; ?>
'<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Boolean search description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'<?php  echo '+"</a>");
			}else{
				$("#helplink").html("");
			}
		}).change();
		
		if($(stId).val()=="boolean"){
			$("#helplink").html("<a href=\'#\'  onclick=\'showHelp();\'>"+'; ?>
'<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Boolean search description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'<?php  echo '+"</a>");
		}else{
			$("#helplink").html("");
		}

		$(toId).change(function() {
			where = id;
			if ($(toId).is(\':checked\'))
				where = "Title";
			$(fieldId).attr(\'name\', where+\'[\'+$(stId).val()+\']\');
		}).change();
	}
	setBoolSearch(\'';   echo $this->_tpl_vars['id'];   echo '\');

	function showHelp(){
		$.get(\'';   echo $this->_tpl_vars['GLOBALS']['site_url'];   echo '/boolean-search/\',function(data){
			$("#messageBox").dialog( \'destroy\' ).html(data);
			$("#messageBox").dialog({
				width: 500,
				height: 400,
				modal: true,
				title: '; ?>
'<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Boolean search description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'<?php  echo '
				
			}).dialog( \'open\' );
		});
		
		return false;
	}

</script>
'; ?>
	

<?php  else: ?>
	<input type="text" value="<?php  echo $this->_tpl_vars['value']['like']; ?>
" class="searchText" name="<?php  echo $this->_tpl_vars['id']; ?>
[like]"  id="<?php  echo $this->_tpl_vars['id']; ?>
" />
<?php  endif; ?>