<?php  /* Smarty version 2.6.14, created on 2018-02-20 11:28:45
         compiled from edit_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'edit_listing.tpl', 1, false),array('block', 'tr', 'edit_listing.tpl', 62, false),array('function', 'input', 'edit_listing.tpl', 64, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listings/?restore=1">Manage Listings</a> &#187; Edit Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Edit Listing</h1>

<?php  if ($this->_tpl_vars['GLOBALS']['is_ajax']): ?>
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	    
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.form.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.bgiframe.js"></script>
	<script language="javascript">
	
	var url = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/";
	
	<?php  echo '
		$("#editListingForm").submit(function() {
			var options = {
				target: "#messageBox",
	            url:  url,
	            succes: function(data) {
					$("#messageBox").html(data).dialog({width: 200});
				}
	        };
	        $(this).ajaxSubmit(options);
	        return false;
		});
	'; ?>

	</script>
<?php  endif; ?>

<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<p>
<?php  if ($this->_tpl_vars['comments_total'] > 0): ?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-comments/?listing_id=<?php  echo $this->_tpl_vars['listing_id']; ?>
">Comments (<?php  echo $this->_tpl_vars['comments_total']; ?>
)</a>,
<?php  else: ?>
	Comments (<?php  echo $this->_tpl_vars['comments_total']; ?>
),
<?php  endif; ?>
<?php  if ($this->_tpl_vars['rate']): ?>
	<a  href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-rating/?listing_id=<?php  echo $this->_tpl_vars['listing_id']; ?>
">Rate (<?php  echo $this->_tpl_vars['rate']; ?>
)</a>
<?php  else: ?>
	Rate (<?php  echo $this->_tpl_vars['rate']; ?>
)
<?php  endif; ?>
</p>

<fieldset>
	<legend>&nbsp;Edit Listing</legend>
	<form method="post" enctype="multipart/form-data" action="" <?php  if ($this->_tpl_vars['form_fields']['ApplicationSettings']): ?>onsubmit="return validateForm('editListingForm');"<?php  endif; ?> id='editListingForm'>
		<input type="hidden" name="action" value="save_info"/>
		<input type="hidden" name="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
"/>
		<table>
			<tr>
				<td colspan="3"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_id=<?php  echo $this->_tpl_vars['listing_id']; ?>
">Edit Pictures</a></td>
			</tr>
				<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
									<?php  if ($this->_tpl_vars['form_field']['id'] == 'reject_reason' || $this->_tpl_vars['form_field']['id'] == 'status' || ( ! isset ( $this->_tpl_vars['form_fields']['Resume'] ) && $this->_tpl_vars['form_field']['id'] == anonymous )): ?>
					<?php  elseif (! isset ( $this->_tpl_vars['form_fields']['Resume'] ) && $this->_tpl_vars['form_field']['id'] == 'ApplicationSettings'): ?>
					<tr>
						<td valign="top" width="20%"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
						<td valign="top">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
						<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'applicationSettings.tpl'), $this);?>
</td>
					</tr>
					<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'access_type'): ?>
						<?php  if ($this->_tpl_vars['listing_type_id'] == 'Job' || $this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>						<?php  else: ?>
							<tr>
								<td valign="top" width="20%"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
								<td valign="top">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
								<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'resume_access.tpl'), $this);?>
</td>
							</tr>
						<?php  endif; ?>
					<?php  else: ?>
						<tr>
							<td valign="top"><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
</td>
							<td valign="top">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
							<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</td>
						</tr>
					<?php  endif; ?>
				<?php  endforeach; endif; unset($_from); ?>
			<tr>
				<td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>