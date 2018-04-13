<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:50:14
         compiled from display_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'display_listing.tpl', 1, false),array('block', 'tr', 'display_listing.tpl', 95, false),array('function', 'cycle', 'display_listing.tpl', 65, false),array('function', 'display', 'display_listing.tpl', 72, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?restore=1">Manage Listings</a> &#187; Display Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Display Listing</h1>

<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error'] => $this->_tpl_vars['error_message']):
?>
		<?php  if ($this->_tpl_vars['error'] == 'LISTING_ID_ISNOT_SPECIFIED'): ?>
			<p class="error">Listing ID is not specified</p>
		<?php  elseif ($this->_tpl_vars['error'] == 'LISTING_DOESNOT_EXIST'): ?>
			<p class="error">Listing with specified ID does not exist</p>
		<?php  elseif ($this->_tpl_vars['error'] == 'NO_SUCH_FILE'): ?>
			<p class="error">File does not exist</p>
		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from);   else: ?>

	<p>
		<?php  if ($this->_tpl_vars['comments_total'] > 0): ?>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-comments/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
">Comments (<?php  echo $this->_tpl_vars['comments_total']; ?>
)</a>,
		<?php  else: ?>
			Comments (<?php  echo $this->_tpl_vars['comments_total']; ?>
),
		<?php  endif; ?>
		<?php  if ($this->_tpl_vars['rate']): ?>
			<a  href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-rating/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
">Rate (<?php  echo $this->_tpl_vars['rate']; ?>
)</a>
		<?php  else: ?>
			Rate (<?php  echo $this->_tpl_vars['rate']; ?>
)
		<?php  endif; ?>
	</p>

	<table>
		<thead>
		    <tr>
				<th colspan="2">Listing Details</th>
			</tr>
		</thead>
		<tr class="oddrow">
			<td>Listing ID</td>
			<td><?php  echo $this->_tpl_vars['listing']['id']; ?>
</td>
		</tr>
		<tr class="evenrow">
			<td>Listing Type</td>
			<td><?php  echo $this->_tpl_vars['listing']['type']['id']; ?>
</td>
		</tr>
		<tr class="oddrow">
			<td>Activation Date</td>
			<td><?php  echo $this->_tpl_vars['listing']['activation_date']; ?>
</td>
		</tr>
		<tr class="evenrow">
			<td>Expiration Date</td>
			<td><?php  echo $this->_tpl_vars['listing']['expiration_date']; ?>
</td>
		</tr>
		<tr class="oddrow">
			<td>Listing User</td>
			<td><a href="mailto:<?php  echo $this->_tpl_vars['listing']['user']['email']; ?>
"><?php  echo $this->_tpl_vars['listing']['user']['username']; ?>
</a></td>
		</tr>
		<tr class="evenrow">
			<td># of Views</td>
			<td><?php  echo $this->_tpl_vars['listing']['views']; ?>
</td>
		</tr>
		<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
						<?php  if (( ! isset ( $this->_tpl_vars['form_fields']['Resume'] ) && $this->_tpl_vars['form']['id'] == anonymous ) || ( $this->_tpl_vars['field']['id'] == 'company_name' && empty ( $this->_tpl_vars['listing']['company_name'] ) ) || ( $this->_tpl_vars['wait_approve'] == 0 && ( $this->_tpl_vars['field']['id'] == 'reject_reason' || $this->_tpl_vars['field']['id'] == 'status' ) )): ?>
			<?php  elseif ($this->_tpl_vars['field']['id'] == 'video' && empty ( $this->_tpl_vars['listing']['video']['file_url'] )): ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
				<td><?php  echo $this->_tpl_vars['field']['caption']; ?>
</td>
				<td></td>
			</tr>
			<?php  elseif ($this->_tpl_vars['field']['id'] == 'Salary' || $this->_tpl_vars['field']['id'] == 'DesiredSalary'): ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
				<td><?php  echo $this->_tpl_vars['field']['caption']; ?>
</td>
				<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['field']['id']), $this);?>
 <?php  echo $this->_tpl_vars['listing']['Salary']['currency_sign']; ?>
</td>
			</tr>
			<?php  elseif ($this->_tpl_vars['field']['id'] == 'ApplicationSettings'): ?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
					<td><?php  echo $this->_tpl_vars['field']['caption']; ?>
</td>
					<td><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['field']['id'],'template' => "application.settings.tpl"), $this);?>
</td>
				</tr>	
			<?php  elseif ($this->_tpl_vars['field']['id'] == 'access_type'): ?>
			<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
				<td><?php  echo $this->_tpl_vars['field']['caption']; ?>
</td>
				<td>
					<?php  $_from = $this->_tpl_vars['access_type_properties']->type->property_info['list_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['access_type']):
?>
						<?php  if ($this->_tpl_vars['access_type_properties']->value == $this->_tpl_vars['access_type']['id']): ?>
							<?php  echo $this->_tpl_vars['access_type']['caption']; ?>

						<?php  endif; ?>	
					<?php  endforeach; endif; unset($_from); ?>
				</td>
			</tr>
			<?php  else: ?>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'oddrow,evenrow'), $this);?>
">
					<td><?php  echo $this->_tpl_vars['field']['caption']; ?>
</td>
					<td>
						<?php  if ($this->_tpl_vars['field']['id'] == DesiredSalary): ?>
							<?php  if ($this->_tpl_vars['listing']['DesiredSalary']['value'] != 0):   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['DesiredSalary']['currency_sign'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['DesiredSalary']['currency_sign'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['DesiredSalary']['value'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['DesiredSalary']['value'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
						<?php  elseif ($this->_tpl_vars['field']['id'] == Salary): ?>
							<?php  if ($this->_tpl_vars['listing']['Salary']['value'] != 0):   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['Salary']['currency_sign'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['Salary']['currency_sign'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['Salary']['value'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['Salary']['value'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif; ?>
						<?php  else: ?>
							<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['field']['id']), $this);?>

						<?php  endif; ?>
					</td>
				</tr>
			<?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
	</table>
<?php  endif; ?>