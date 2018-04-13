<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:45:33
         compiled from payments.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'payments.tpl', 26, false),array('function', 'cycle', 'payments.tpl', 59, false),array('function', 'display', 'payments.tpl', 61, false),)), $this); ?>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
	<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['currentPage']): ?>
		<strong><?php  echo $this->_tpl_vars['page']; ?>
</strong>
	<?php  else: ?>
		<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['totalPages'] && $this->_tpl_vars['currentPage'] < $this->_tpl_vars['totalPages']-3): ?> ... <?php  endif; ?>
		<a href="?restore=1&page=<?php  echo $this->_tpl_vars['page'];   if ($this->_tpl_vars['sorting_field'] != null): ?>&sorting_field=<?php  echo $this->_tpl_vars['sorting_field'];   endif;   if ($this->_tpl_vars['sorting_order'] != null): ?>&sorting_order=<?php  echo $this->_tpl_vars['sorting_order'];   endif;   echo $this->_tpl_vars['searchFields'];   if ($this->_tpl_vars['online']): ?>&online=1<?php  endif; ?>"><?php  echo $this->_tpl_vars['page']; ?>
</a>
		<?php  if ($this->_tpl_vars['page'] == 1 && $this->_tpl_vars['currentPage'] > 4): ?> ... <?php  endif; ?>
	<?php  endif;   endforeach; endif; unset($_from); ?>

<form method="post" name="payments_form">
	<input type="hidden" name="action_name" id="action_name" value="" />
	
	<span class="greenButtonInEnd"><input type="button" name="action" value="Endorse" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to endorse selected payment(s)?') ) submitForm('endorse');"></span>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Open Invoices" class="greenButtonIn" onclick="location.href ='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/open_invoices';"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete selected payment(s)?') ) submitForm('delete');"></span>
	<div class="clr"><br/></div>
	
	<table>
		<thead>
		    <tr>
		        <th><input type="checkbox" id="all_checkboxes_control"></th>
		        <th>
		            <a href="?restore=1&sorting_field=sid&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'sid'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Invoice #</a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'sid'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
		        </th>
		        <th>
		            <a href="?restore=1&sorting_field=creation_date&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'creation_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Date</a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'creation_date'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
		        </th>
		        <th>Description</th>
		        <th>
		            <a href="?restore=1&sorting_field=username&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'username'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">User Name</a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'username'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
		        </th>
			    <th>
				    <a href="?restore=1&sorting_field=companyname&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'companyname'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Company</a>
			        <?php  if ($this->_tpl_vars['sorting_field'] == 'copanyname'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			    </th>
		        <th>
		            <a href="?restore=1&sorting_field=price&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'price'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Debit</a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'price'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
		        </th>
			    <th>
				    <a href="?restore=1&sorting_field=credit&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'price'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Credit</a>
			    <?php  if ($this->_tpl_vars['sorting_field'] == 'credit'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			    </th>
		        <th>
		            <a href="?restore=1&sorting_field=status&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'status'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Status</a>
					<?php  if ($this->_tpl_vars['sorting_field'] == 'status'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
		        </th>
			    <th>Print</th>
			    <th>Email</th>
		    </tr>
		</thead>
		<tbody>
			<?php  $_from = $this->_tpl_vars['found_payments_sids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['payments_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['payments_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['payment_sid']):
        $this->_foreach['payments_block']['iteration']++;
?>
			    <tr class="<?php  echo smarty_function_cycle(array('values' => "oddrow,evenrow"), $this);?>
">
			        <td><input type="checkbox" name="payments[<?php  echo $this->_tpl_vars['payment_sid']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['payments_block']['iteration']; ?>
" /></td>
			        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'sid','object_sid' => $this->_tpl_vars['payment_sid']), $this);?>
</td>
			        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'creation_date','object_sid' => $this->_tpl_vars['payment_sid']), $this);?>
</td>
			        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'name','object_sid' => $this->_tpl_vars['payment_sid']), $this);?>

			        	<?php  $_from = $this->_tpl_vars['listings_titles'][$this->_tpl_vars['payment_sid']]['title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingtitle']):
?>
			        		<br>- <?php  echo $this->_tpl_vars['listingtitle']; ?>

						<?php  endforeach; endif; unset($_from); ?>
			        </td>
						
			        <td>
			            <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'username','object_sid' => $this->_tpl_vars['payment_sid'],'assign' => 'username'), $this);?>

			            <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?username=<?php  echo $this->_tpl_vars['username']; ?>
"><?php  echo $this->_tpl_vars['username']; ?>
</a>
			        </td>
				    <td>
						    					    <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'compname','object_sid' => $this->_tpl_vars['payment_sid'],'assign' => 'compname'), $this);?>

		
					    <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?companyname=<?php  echo $this->_tpl_vars['companyname']; ?>
"><?php  echo $this->_tpl_vars['compname']; ?>
</a>
				    </td>
			        <td><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'price','object_sid' => $this->_tpl_vars['payment_sid']), $this);?>
</td>
				    <td><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'credit','object_sid' => $this->_tpl_vars['payment_sid']), $this);?>
</td>
			        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'status','object_sid' => $this->_tpl_vars['payment_sid'],'assign' => 'status'), $this);  echo $this->_tpl_vars['status']; ?>
</td>
				    <td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/print-invoice/?payment_sid=<?php  echo $this->_tpl_vars['payment_sid']; ?>
">Print</a></td>
				    <td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/print-invoice/?payment_sid=<?php  echo $this->_tpl_vars['payment_sid']; ?>
&send_email=1">Email</a></td>
			    </tr>
			<?php  endforeach; endif; unset($_from); ?>
		</tbody>
		<thead>
		    <tr>
		        <th colspan="6">Total Amount</th>
		        <th><?php  echo $this->_tpl_vars['GLOBALS']['settings']['transaction_currency'];   echo $this->_tpl_vars['total_price']; ?>
</th>
			    <th></th>
			    <th colspan="3">&nbsp;</th>
		    </tr>
	    </thead>
	</table>
	
	<div class="clr"><br/></div>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Endorse" class="greenButtonIn" onclick="if (confirm('Are you sure you want to endorse selected payment(s)?')) submitForm('endorse');"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if (confirm('Are you sure you want to delete selected payment(s)?')) submitForm('delete');"></span>
</form>

<script>
	var total=<?php  echo $this->_foreach['payments_block']['total']; ?>
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
		document.getElementById(\'action_name\').value = action;
		var form = document.payments_form;
		form.submit();
	}
	'; ?>

</script>