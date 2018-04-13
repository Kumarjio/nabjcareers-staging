<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:16:56
         compiled from open_invoices.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'display', 'open_invoices.tpl', 23, false),array('block', 'tr', 'open_invoices.tpl', 32, false),)), $this); ?>
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
		<a href="?restore=1&page=<?php  echo $this->_tpl_vars['page'];   if ($this->_tpl_vars['sorting_field'] != null): ?>&sorting_field=<?php  echo $this->_tpl_vars['sorting_field'];   endif;   if ($this->_tpl_vars['sorting_order'] != null): ?>&sorting_order=<?php  echo $this->_tpl_vars['sorting_order'];   endif;   echo $this->_tpl_vars['searchFields']; ?>
"><?php  echo $this->_tpl_vars['page']; ?>
</a>
		<?php  if ($this->_tpl_vars['page'] == 1 && $this->_tpl_vars['currentPage'] > 4): ?> ... <?php  endif; ?>
	<?php  endif;   endforeach; endif; unset($_from); ?>

	<div class="clr"><br/></div>

	<?php  $_from = $this->_tpl_vars['found_open_invoices_sids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['open_invoices_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['open_invoices_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['open_invoice_sid']):
        $this->_foreach['open_invoices_block']['iteration']++;
?>
	<form method="post" name="open_invoices_form_<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
" id="open_invoices_form_<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
">
		<input type="hidden" name="action" id="action_<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
" value="" />
		<input type="hidden" name="open_invoice_sid" id="<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
" value="" />
		<fieldset>
		    <table width="100%" cellspacing="0" cellpadding="3" border="0" bgcolor="#ffffff">
			    <thead>
				    <tr>
					    <th>
						    <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'username','object_sid' => $this->_tpl_vars['open_invoice_sid'],'assign' => 'username'), $this);?>

						    <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?username=<?php  echo $this->_tpl_vars['username']; ?>
"><?php  echo $this->_tpl_vars['username']; ?>
 - </a>
						

						    <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'compname','object_sid' => $this->_tpl_vars['open_invoice_sid'],'assign' => 'compname'), $this);?>

							<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?username=<?php  echo $this->_tpl_vars['username']; ?>
"><?php  echo $this->_tpl_vars['compname']; ?>
</a>
							
					    </th>
					    <th>
						    <a name="delete" onclick="submitForm('delete', <?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
);" href="#"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>[delete invoice<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>]</a>
						    <a name="close" onclick="submitForm('close', <?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
);" href="#"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>[close invoice<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>]</a>
					    </th>
				    </tr>
			    <thead>
			    <tbody>
			        <tr>
				        <td width="60%">
				            <br>Invoice ID: <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'payment_sid','object_sid' => $this->_tpl_vars['open_invoice_sid'],'assign' => 'payment_sid'), $this);  echo $this->_tpl_vars['payment_sid']; ?>

                            <br>Date: <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'creation_date','object_sid' => $this->_tpl_vars['open_invoice_sid']), $this);?>

                            <br>Amount: <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'amount','object_sid' => $this->_tpl_vars['open_invoice_sid']), $this);?>

                            <br>Description: <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'name','object_sid' => $this->_tpl_vars['open_invoice_sid']), $this);?>

					        <?php  $_from = $this->_tpl_vars['listings_titles'][$this->_tpl_vars['open_invoice_sid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['title']):
?>
					            <br>&nbsp;-&nbsp;<?php  echo $this->_tpl_vars['title']; ?>

							<?php  endforeach; endif; unset($_from); ?>
	                    </td>
					    <td>
						    <span><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter credit to apply below<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
						    <input type="text" name="amount" id="amount_<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
"/>
						    <span class="greenButtonInEnd"><input type="button" class="greenButtonIn" name="action" value="Apply Credit" onclick="submitForm('apply_credit', <?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
);"></span>
					    </td>
					    					    
					    
			    
    <td>
	    <span><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter new amount<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
	    <input type="text" name="new_amount" id="new_amount_<?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
"/>
	    <span class="greenButtonInEnd"><input type="button" class="greenButtonIn" name="action" value="Change amount" onclick="submitForm('change_amount', <?php  echo $this->_tpl_vars['open_invoice_sid']; ?>
);"></span>
    </td>
  
			    

					    
			        </tr>
			    </tbody>
		    </table>
		</fieldset>
	</form>
	<?php  endforeach; endif; unset($_from); ?>


<script>
	var total=<?php  echo $this->_foreach['open_invoices_block']['total']; ?>
;
	<?php  echo '
	
	function submitForm(action, id) {
		document.getElementById(\'action_\'+id).value = action;
		document.getElementById(id).value = id;

		var form = document.getElementById(\'open_invoices_form_\'+id);
		form.submit();
	}
	'; ?>

</script>