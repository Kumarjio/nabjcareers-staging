<?php  /* Smarty version 2.6.14, created on 2016-07-15 16:42:21
         compiled from list_inbox.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', 'list_inbox.tpl', 9, false),array('modifier', 'date_format', 'list_inbox.tpl', 38, false),array('block', 'tr', 'list_inbox.tpl', 16, false),array('function', 'cycle', 'list_inbox.tpl', 25, false),array('function', 'image', 'list_inbox.tpl', 40, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
	<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['GLOBALS']['current_language']): ?>
		<?php  $this->assign('dateFormat', $this->_tpl_vars['language']['date_format']); ?>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
<form action="" method="post" id="pm_form">
<input type="hidden" id="pm_action" name="pm_action" value="">
	<?php  $_from = $this->_tpl_vars['navigate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page'] => $this->_tpl_vars['one']):
?>
		<?php  if (((is_array($_tmp=$this->_tpl_vars['one'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) == 0):   echo $this->_tpl_vars['page'];   else: ?><a href="?page=<?php  echo $this->_tpl_vars['one']; ?>
"><?php  echo $this->_tpl_vars['page']; ?>
</a><?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="1"><input type="checkbox" id="pm_all_check"></th>
				<th width="30%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
				<th width="40%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
				<th width="15%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
				<th> </th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
		<?php  $_from = $this->_tpl_vars['message_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['one']):
?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow','advance' => true), $this);?>
">
				<td> </td>
				<td><input type="checkbox" name="pm_check[]" value="<?php  echo $this->_tpl_vars['one']['id']; ?>
" class="pm_checkbox"></td>
				<td>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/inbox/read/?id=<?php  echo $this->_tpl_vars['one']['id']; ?>
">
					<?php  if ($this->_tpl_vars['one']['anonym'] && $this->_tpl_vars['one']['anonym'] != $this->_tpl_vars['GLOBALS']['current_user']['id']): ?>
						<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php  else: ?>
						<?php  echo $this->_tpl_vars['one']['from_first_name']; ?>
 <?php  echo $this->_tpl_vars['one']['from_last_name']; ?>

					<?php  endif; ?>
					</a>
				</td>
				<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/inbox/read/?id=<?php  echo $this->_tpl_vars['one']['id']; ?>
"><?php  if ($this->_tpl_vars['one']['status'] == 0): ?><b><?php  echo $this->_tpl_vars['one']['subject']; ?>
</b><?php  else:   echo $this->_tpl_vars['one']['subject'];   endif; ?></a></td>
				<td><?php  echo ((is_array($_tmp=$this->_tpl_vars['one']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormat']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormat'])); ?>
 <?php  echo ((is_array($_tmp=$this->_tpl_vars['one']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</td>
				<td>
					<?php  if ($this->_tpl_vars['one']['status'] == 0): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
f_norm.gif" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unread<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
					<?php  elseif ($this->_tpl_vars['one']['status'] == 1): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
f_norm_no.gif" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Read<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
					<?php  elseif ($this->_tpl_vars['one']['status'] == 2): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
f_norm_re.gif" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Replied<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
					<?php  endif; ?>
				</td>
				<td> </td>
			</tr>
			<tr>
				<td colspan="7" class="separateListing"> </td>
			</tr>
		<?php  endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	<div class="clr"><br/></div>
	<input type="button" class="button" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Read<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="pm_controll_mark"> <input type="button" class="button" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="pm_controll_delete">
	<div class="clr"></div>
	<?php  $_from = $this->_tpl_vars['navigate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page'] => $this->_tpl_vars['one']):
?>
	 <?php  if (((is_array($_tmp=$this->_tpl_vars['one'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) == 0):   echo $this->_tpl_vars['page'];   else: ?><a href="?page=<?php  echo $this->_tpl_vars['one']; ?>
"><?php  echo $this->_tpl_vars['page']; ?>
</a><?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
</form>