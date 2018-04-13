<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:35:13
         compiled from prices.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'prices.tpl', 1, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rate Plans<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Rate Plans</h1>

<table>
	<thead class="">
	    <tr height="30" class="">
	        <th class="white_label">Name</th>

	        <th class="white_label">Price</th>

	    </tr>
    </thead>
        
    <tbody>
	    <?php  $_from = $this->_tpl_vars['membership_plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['membership_plan']):
?>
		    <?php  if ($this->_tpl_vars['membership_plan']['id'] != '40' && $this->_tpl_vars['membership_plan']['id'] != '39' && $this->_tpl_vars['membership_plan']['id'] != '135'): ?>
		    	<?php  if ($this->_tpl_vars['membership_plan']['id'] != '35'): ?>
			    	<tr class="evenrow prices_table_row">
			        	<td><b><?php  echo $this->_tpl_vars['membership_plan']['name']; ?>
</b></td>

			        	<td><?php  if ($this->_tpl_vars['membership_plan']['price'] == 0): ?>Free<?php  else:   echo $this->_tpl_vars['GLOBALS']['settings']['listing_currency'];   echo $this->_tpl_vars['membership_plan']['price'];   endif; ?></td>
			    	</tr>
			    	<?php  $_from = $this->_tpl_vars['plan_packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plan_package_field']):
?>
					<?php  if ($this->_tpl_vars['membership_plan']['id'] == $this->_tpl_vars['plan_package_field']['membership_plan_id'] && ( $this->_tpl_vars['plan_package_field']['plan_id'] == '40' || $this->_tpl_vars['plan_package_field']['plan_id'] == '41' || $this->_tpl_vars['plan_package_field']['plan_id'] == '42' )): ?>
						<tr class="oddrow prices_table_row">
							<td> - <?php  echo $this->_tpl_vars['plan_package_field']['name']; ?>
</td>

							<td><?php  if ($this->_tpl_vars['plan_package_field']['price'] == '0'): ?>Free<?php  else:   echo $this->_tpl_vars['GLOBALS']['settings']['listing_currency'];   echo $this->_tpl_vars['plan_package_field']['price'];   endif; ?></td>	
						</tr>
					<?php  endif; ?>
		    		 <?php  endforeach; endif; unset($_from); ?>
			    	
			<?php  else: ?> 				 <tr class="evenrow prices_table_row">
			        	<td><b>Job postings</b></td>

			        	<td></td>
			    	</tr>
				<?php  $_from = $this->_tpl_vars['plan_packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plan_package_field']):
?>
					<?php  if ($this->_tpl_vars['membership_plan']['id'] == $this->_tpl_vars['plan_package_field']['membership_plan_id'] && ( $this->_tpl_vars['plan_package_field']['plan_id'] == '40' || $this->_tpl_vars['plan_package_field']['plan_id'] == '41' || $this->_tpl_vars['plan_package_field']['plan_id'] == '42' )): ?>
						<tr class="oddrow prices_table_row">
							<td> - <?php  echo $this->_tpl_vars['plan_package_field']['name']; ?>
</td>

							<td><?php  if ($this->_tpl_vars['plan_package_field']['price'] == '0'): ?>	Free<?php  else:   echo $this->_tpl_vars['GLOBALS']['settings']['listing_currency'];   echo $this->_tpl_vars['plan_package_field']['price']; ?>
	<?php  endif; ?></td>								
						</tr>
					<?php  endif; ?>
		    		 <?php  endforeach; endif; unset($_from); ?>
		    		
			    	<tr class="oddrow prices_table_row">
					<td><i> - featured option</i></td>

					<td><i>$35</i></td>								
				</tr>
				<tr class="oddrow prices_table_row">
					<td><i> - priority option</i></td>

					<td><i>$35</i></td>								
				</tr>
				
			<?php  endif; ?>
				
			
		    <?php  endif; ?>
	    <?php  endforeach; endif; unset($_from); ?>
	    	
	</tbody>


</table>