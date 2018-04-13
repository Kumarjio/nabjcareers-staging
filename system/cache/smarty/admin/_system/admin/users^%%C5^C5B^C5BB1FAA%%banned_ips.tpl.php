<?php  /* Smarty version 2.6.14, created on 2018-04-01 03:13:16
         compiled from banned_ips.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'banned_ips.tpl', 1, false),array('block', 'tr', 'banned_ips.tpl', 31, false),array('function', 'image', 'banned_ips.tpl', 57, false),array('function', 'cycle', 'banned_ips.tpl', 63, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Banned IPs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Banned IPs</h1>
<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_data']):
?>
		<?php  if ($this->_tpl_vars['error'] == 'WRONG_FORMAT'): ?><p class="error">IP format is not valid</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error'] == 'IP_ALREADY_EXIST'): ?><p class="error">IP already banned</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error'] == 'IP_WAS_NOT_BANNED'): ?><p class="error">IP was not banned</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error'] == 'ID_NOT_FOUND'): ?><p class="error">IP not found</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error'] == 'IP_NOT_ENABLED'): ?><p class="error">IP was not unbanned</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error'] == 'IP_NOT_BANNED'): ?><p class="error">IP is not banned</p><?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
<?php  elseif ($this->_tpl_vars['action'] == 'ban'): ?>
	<p class="message">IP was banned</p>
<?php  elseif ($this->_tpl_vars['action'] == 'unban'): ?>
	<p class="message">IP was unbanned</p>
<?php  endif; ?>

<fieldset>
	<legend>Ban IP</legend>
	<form method="post" name="ban_ip_form">
		<input type="hidden" name="action" value="ban" />
		<input type="hidden" name="ip_per_page" value="<?php  echo $this->_tpl_vars['ip_per_page']; ?>
" />
		<input type="text" name="banned_ip" class="inputText"  />
		<span class="greenButtonEnd"><input type="submit" name='bun' value='Ban' class="greenButton" /></span><br/>
		<small>* wildcard for replacing one or several digits. E.g.: 192.168.*.*</small>
	</form>
</fieldset>

<div class="clr"><br/></div>
<div class="actionSelected">
	<strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of ips per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong>
	<select id="ip_per_page" name="ip_per_page" onchange="window.location = '?ip_per_page='+this.value;" class="perPage">
		<option value="10" <?php  if ($this->_tpl_vars['ip_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
		<option value="20" <?php  if ($this->_tpl_vars['ip_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
		<option value="50" <?php  if ($this->_tpl_vars['ip_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
		<option value="100" <?php  if ($this->_tpl_vars['ip_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
	</select>	
</div>
<div class="numberPerPage">
	<?php  $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
		<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['currentPage']): ?>
			<strong><?php  echo $this->_tpl_vars['page']; ?>
</strong>
		<?php  else: ?>
			<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['totalPages'] && $this->_tpl_vars['currentPage'] < $this->_tpl_vars['totalPages']-3): ?> ... <?php  endif; ?>
			<a href="?page=<?php  echo $this->_tpl_vars['page'];   if ($this->_tpl_vars['sort']['field'] != null): ?>&sort[field]=<?php  echo $this->_tpl_vars['sort']['field'];   endif;   if ($this->_tpl_vars['sort']['order'] != null): ?>&sort[order]=<?php  echo $this->_tpl_vars['sort']['order'];   endif; ?>&ip_per_page=<?php  echo $this->_tpl_vars['ip_per_page']; ?>
"><?php  echo $this->_tpl_vars['page']; ?>
</a>
			<?php  if ($this->_tpl_vars['page'] == 1 && $this->_tpl_vars['currentPage'] > 4): ?> ... <?php  endif; ?>
		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
</div>
<div class="clr"><br/></div>

<table>
	<thead>
		<tr>
			<th>
				<a href="?sort[field]=value&sort[order]=<?php  if ($this->_tpl_vars['sort']['order'] == 'ASC' && $this->_tpl_vars['sort']['field'] == 'value'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&ip_per_page=<?php  echo $this->_tpl_vars['ip_per_page']; ?>
">IP</a>
				<?php  if ($this->_tpl_vars['sort']['field'] == 'value'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
				</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<?php  $_from = $this->_tpl_vars['bannedIPs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ip']):
?>
		<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><?php  echo $this->_tpl_vars['ip']['value']; ?>
</td>
			<td><span class="greenButtonEnd"><input type="button" name="button" value="Unban" class="greenButton" onclick="window.location='?id=<?php  echo $this->_tpl_vars['ip']['id']; ?>
&action=unban&page=<?php  echo $this->_tpl_vars['page']; ?>
&ip_per_page=<?php  echo $this->_tpl_vars['ip_per_page']; ?>
'" /></span></td>
		</tr>
	<?php  endforeach; endif; unset($_from); ?>
</table>