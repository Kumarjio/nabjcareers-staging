<?php  /* Smarty version 2.6.14, created on 2018-02-08 19:57:09
         compiled from manage_pictures.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'manage_pictures.tpl', 4, false),array('modifier', 'truncate', 'manage_pictures.tpl', 77, false),array('function', 'image', 'manage_pictures.tpl', 78, false),)), $this); ?>
<br/>
<?php  $_from = $this->_tpl_vars['field_errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_caption'] => $this->_tpl_vars['error']):
?>
	<?php  if ($this->_tpl_vars['error'] == 'FILE_NOT_SPECIFIED'): ?>
		<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>file not specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'NOT_SUPPORTED_IMAGE_FORMAT'): ?>
		<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>not supported image format<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'PICTURES_LIMIT_EXCEEDED'): ?>
		<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>limit exceeded<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'UPLOAD_ERR_INI_SIZE'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File size exceeds system limit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'UPLOAD_ERR_FORM_SIZE'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File size exceeds system limit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'UPLOAD_ERR_PARTIAL'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There was an error during file upload<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error'] == 'UPLOAD_ERR_NO_FILE'): ?>
		<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>file not specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
<?php  if ($this->_tpl_vars['errors'] != ''): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_message']):
?>
	
		<?php  if ($this->_tpl_vars['error'] == 'WRONG_PARAMETERS_SPECIFIED'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Wrong parameters are specified<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	
		<?php  elseif ($this->_tpl_vars['error'] == 'PARAMETERS_MISSED'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The system cannot proceed as some key parameters are missed<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	
		<?php  elseif ($this->_tpl_vars['error'] == 'NOT_OWNER'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are not owner of this listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  endif; ?>
		
	<?php  endforeach; endif; unset($_from); ?>

<?php  else: ?>
	<?php  if ($this->_tpl_vars['number_of_picture'] < $this->_tpl_vars['number_of_picture_allowed']): ?>
		<form id="uploadForm" method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/" enctype="multipart/form-data" onsubmit="return UploadSubmit();">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" id="listing_id" name="listing_sid" value="<?php  echo $this->_tpl_vars['listing']['id']; ?>
" />
			<table>
				<tr>
					<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Caption<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
					<td><input type="text" name="caption" value="" /></td>
				</tr>
				<tr>
					<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Picture<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
					<td><input type="file" name="picture" /></td>
				</tr>
				<tr>
		        <td></td>
				<td colspan="2">
	          <br/>
					<input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Picture<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button"/>
					</td>
				</tr>
			</table>
		</form>
		
	<?php  else: ?>
	
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You've reached the limit of number of listings allowed by your plan<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
	<?php  endif; ?>
	
	<br />
	
	<table cellpadding="5">
		<?php  if ($this->_tpl_vars['pictures']): ?>
		<tr>
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thumbnail<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Caption<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
			<td colspan="4"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Actions<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
		</tr>
		<?php  $_from = $this->_tpl_vars['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pictures_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pictures_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['picture']):
        $this->_foreach['pictures_block']['iteration']++;
?>
		
		<tr>
			<td><img src="<?php  echo $this->_tpl_vars['picture']['thumbnail_url']; ?>
" alt="" /></td>
			<td><?php  echo ((is_array($_tmp=$this->_tpl_vars['picture']['caption'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15) : smarty_modifier_truncate($_tmp, 15)); ?>
</td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-picture/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;picture_id=<?php  echo $this->_tpl_vars['picture']['id']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/classifieds/edit-picture/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;picture_id=<?php  echo $this->_tpl_vars['picture']['id']; ?>
', 560, 400, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Picture<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;" class="edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_edit.gif" border="0" alt="" /></a></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;action=delete&amp;picture_id=" onclick="Delete('<?php  echo $this->_tpl_vars['picture']['id']; ?>
'); return false;" id="delete_picture" style="cursor:pointer;"><img src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/templates/_system/main/images/b_drop.gif"></a></td>
		</tr>
		<?php  endforeach; endif; unset($_from); ?>
		<?php  endif; ?>
	</table>
<?php  endif; ?>
<?php  echo '
<script>

	function UploadSubmit() {
		var browser=navigator.appName.toLowerCase();
		var options = {
			target: "#UploadPics",
			url:  $("#uploadForm").attr("action") + "?listing_sid=" + ';   echo $this->_tpl_vars['listing']['id'];   echo ',
			success: function(data) {
				if (browser == \'microsoft internet explorer\') {
					$("#UploadPics").load(url);
				}
			}
		};
		$("#uploadForm").ajaxSubmit(options);
		return false;
	}
	
	function Delete(picture_id){
		if ( confirm(\'Are you sure?\') ) {
			var options = {
				target: "#UploadPics",
				url:  $("#delete_picture").attr("href") + picture_id
			};
			$("#messageBox").ajaxSubmit(options);
		}
	};
	
</script>
'; ?>