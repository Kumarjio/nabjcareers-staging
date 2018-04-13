<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:44:41
         compiled from flag_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'flag_listing.tpl', 5, false),array('function', 'input', 'flag_listing.tpl', 40, false),)), $this); ?>
<?php  if (( $this->_tpl_vars['listing_type_id'] == 'job' && $this->_tpl_vars['acl']->isAllowed('flag_job') ) || ( $this->_tpl_vars['listing_type_id'] == 'resume' && $this->_tpl_vars['acl']->isAllowed('flag_resume') )): ?>

<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error']):
?>
	<?php  if ($this->_tpl_vars['error_code'] == 'EMPTY_VALUE'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter Security code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['error_code'] == 'NOT_VALID'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Security code is not valid<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  endif;   endforeach; endif; unset($_from); ?>

	<form method="post" id="flagForm" action="" onsubmit="sendFlagForm();return false;" >
	<input type="hidden" name="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
">
	<input type="hidden" name="action" value="flag">
	
	<table>
	<?php  if (count ( $this->_tpl_vars['flag_types'] )): ?>
		<tr>
			<td>Select Flag Type </td>
			<td>
				<select name="reason">
			<?php  $_from = $this->_tpl_vars['flag_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
					<option value="<?php  echo $this->_tpl_vars['type']['sid']; ?>
" <?php  if ($this->_tpl_vars['reason'] == $this->_tpl_vars['type']['sid']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['type']['value']; ?>
</option>
			<?php  endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
	<?php  endif; ?>
	
		<tr>
			<td>Comment:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="comment" cols="42" rows="3"><?php  echo $this->_tpl_vars['comment']; ?>
</textarea></td>
		</tr>
		
	<?php  if ($this->_tpl_vars['is_captcha'] == 1): ?>
		<tr>
			<td><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['captcha']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['captcha']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
			<td align="right"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['captcha']['id']), $this);?>
</td>
		</tr>
	<?php  endif; ?>
	
		<tr>
			<td colspan="2" align="right"><input type="submit" name="sendForm" value="Send" class="button"></td>
		</tr>
		
	</table>
	</form>

<?php  elseif ($this->_tpl_vars['listing_type_id'] == ''): ?>

	<p class="error">Listing not exists</p>

<?php  else: ?>

	<p class="error">You do not have permissions to flag this listing</p>

<?php  endif; ?>