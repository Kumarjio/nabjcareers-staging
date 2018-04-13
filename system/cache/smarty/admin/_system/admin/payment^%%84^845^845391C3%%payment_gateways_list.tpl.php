<?php  /* Smarty version 2.6.14, created on 2018-03-09 13:57:59
         compiled from payment_gateways_list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'payment_gateways_list.tpl', 1, false),array('function', 'cycle', 'payment_gateways_list.tpl', 14, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Payment Gateways<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Payment Gateways</h1>

<table>
	<thead>
		<tr>
			<th>Name<br><small>click to configure<small></th>
			<th>Status</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['gateways']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gateway_id'] => $this->_tpl_vars['gateway']):
?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => "oddrow,evenrow"), $this);?>
">
				<td><a href=<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/configure-gateway/?gateway=<?php  echo $this->_tpl_vars['gateway']['id']; ?>
 title="set up gateway"> <?php  echo $this->_tpl_vars['gateway']['caption']; ?>
 </a></td>
				<td><?php  if ($this->_tpl_vars['gateway']['active']): ?> Active <?php  else: ?> Inactive <?php  endif; ?> </td>
				<td>
					<?php  if ($this->_tpl_vars['gateway']['active']): ?>
						<a href="?action=deactivate&gateway=<?php  echo $this->_tpl_vars['gateway']['id']; ?>
">Deactivate</a>
					<?php  else: ?>
						<a href="?action=activate&gateway=<?php  echo $this->_tpl_vars['gateway']['id']; ?>
">Activate</a>
					<?php  endif; ?>
				</td>
			</tr>
		<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>