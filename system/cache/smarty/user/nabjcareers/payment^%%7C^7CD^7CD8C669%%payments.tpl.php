<?php  /* Smarty version 2.6.14, created on 2014-10-22 23:55:31
         compiled from payments.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'payments.tpl', 7, false),array('function', 'image', 'payments.tpl', 8, false),array('function', 'cycle', 'payments.tpl', 39, false),array('function', 'display', 'payments.tpl', 41, false),)), $this); ?>
<div class="clr"><br/></div>
<table>
	<thead>
	    <tr>
	    	<th class="tableLeft"> </th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=id&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'id'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'id'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="" /><?php  endif;   endif; ?>
	        </th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=creation_date&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'creation_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'creation_date'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="" /><?php  endif;   endif; ?>
	        </th>
			<?php  if ($this->_tpl_vars['subuser']): ?>
	        <th nowrap>
		            <a href="?restore=1&sorting_field=subusername&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'subusername'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Payer</a>
		            <?php  if ($this->_tpl_vars['sorting_field'] == 'subusername'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png"><?php  endif;   endif; ?>
	        </th>
			<?php  endif; ?>
	        <th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	        <th>
	            <a href="?restore=1&amp;sorting_field=price&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'price'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Debit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'price'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow." alt="" /><?php  endif;   endif; ?>
	        </th>
		    <th>
			    <a href="?restore=1&amp;sorting_field=credit&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'credit'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Credit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			    <?php  if ($this->_tpl_vars['sorting_field'] == 'credit'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow." alt="" /><?php  endif;   endif; ?>
		    </th>

	        <th>
	            <a href="?restore=1&amp;sorting_field=status&amp;sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'status'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'status'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.png" alt="" /><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.png" alt="" /><?php  endif;   endif; ?>
	        </th>
	        <th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Action<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	        <th class="tableRight"> </th>
	    </tr>
	   </thead>
	<?php  $_from = $this->_tpl_vars['found_payments_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['payment_id']):
?>
	    <tr class="<?php  echo smarty_function_cycle(array('values' => "oddrow,evenrow"), $this);?>
">
	    	<td></td>
	        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'id','object_id' => $this->_tpl_vars['payment_id']), $this);?>
</td>
	        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'creation_date','object_id' => $this->_tpl_vars['payment_id']), $this);?>
</td>
	        <?php  if ($this->_tpl_vars['subuser'] > 0): ?>
		        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'subusername','object_sid' => $this->_tpl_vars['payment_id']), $this);?>
</td>
	        <?php  endif; ?>
	        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'name','object_id' => $this->_tpl_vars['payment_id']), $this);?>
</td>
	        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'price','object_id' => $this->_tpl_vars['payment_id']), $this);?>
</td>
		    <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'credit','object_id' => $this->_tpl_vars['payment_id'],'assign' => 'credit'), $this);  echo $this->_tpl_vars['credit']; ?>
</td>
	        <td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => 'status','object_id' => $this->_tpl_vars['payment_id'],'assign' => 'status'), $this);?>

		        <?php  if (( $this->_tpl_vars['credit'] == 0 )): ?>
	                <?php  if ($this->_tpl_vars['status'] == 'Completed'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Paid<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  elseif ($this->_tpl_vars['status'] == 'Pending'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unpaid<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   else:   echo $this->_tpl_vars['status'];   endif; ?>
		        <?php  endif; ?>
	        </td>
	        <td><?php  if (( $this->_tpl_vars['credit'] == 0 )):   if ($this->_tpl_vars['status'] != 'Completed'): ?><a href="?action=Complete&amp;payments[<?php  echo $this->_tpl_vars['payment_id']; ?>
]=1"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Complete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif;   endif; ?></td>
	        <td></td>
	    </tr>
	<?php  endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="9" class="separateListing"><br/></td>
	</tr>
    <tr>
        <td colspan="4"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Amount<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></td>
        <td><strong><?php  echo $this->_tpl_vars['total_debit_price']; ?>
</strong></td>
	    <td><strong><?php  echo $this->_tpl_vars['total_credit_price']; ?>
</strong></td>
	    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
    </tr>
</table>