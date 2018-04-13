<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:49:02
         compiled from deleted_jobs_display_results.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'deleted_jobs_display_results.tpl', 37, false),array('function', 'image', 'deleted_jobs_display_results.tpl', 114, false),array('function', 'cycle', 'deleted_jobs_display_results.tpl', 241, false),array('modifier', 'regex_replace', 'deleted_jobs_display_results.tpl', 254, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
<?php  echo '
	<script type="text/javascript">
		$.ui.dialog.defaults.bgiframe = true;
		var progBar = "<img src=\'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/progbar.gif<?php  echo '\'>";
		
		$(function() {
			
			$("input[id=rejectButton]").click(function(){
					$("#dialog").dialog(\'destroy\');
					$("#dialog").attr({title: "Enter Reject Reason:"});
					$("#dialog").dialog();
					return false;
			});
			
			$("#submitReject").click(function(){
				val = $("textarea[name=\'reason\']").val();
				$("input[name=\'rejectReason\']").val( val );
				$("input[name=\'action_name\']").val(\'reject\');
	
				$("form[name=\'resultsForm\']").submit();
			});
	
	
			$("input[id=modify_date_button]").click(function() {
				$("#modify_date_dialog").dialog(\'destroy\');
				$("#modify_date_dialog").attr({title: "Modify Expiration Date"});
				$("#modify_date_dialog").dialog();
			});
	
			$("#modify_send_button").click(function(){
				val = $("#days").val();
				$("#days_to_change").val( val );
				$("input[name=\'action_name\']").val(\'datemodify\');
				$("#modify_date_dialog").dialog(\'destroy\').html("';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please wait...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '" + progBar).dialog( {width: 250});
				$("form[name=\'resultsForm\']").submit();
			});
			
		});
	</script>
'; ?>



<p>
	<form id="listings_per_page_form" method="get" action="?">
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
">&#171; Previous</a><?php  else: ?> &#171; Previous<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?>&nbsp;<a href="?restore=1&amp;page=1">1</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>&nbsp;...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
		<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;...<?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
">Next &#187;</a><?php  else: ?>Next &#187;<?php  endif; ?>
	
		<span style="padding-left:50px">Number of listings per page:</span>
		<select name="listings_per_page" onchange="submit()" class="perPage">
			<option value="10" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 10): ?>selected<?php  endif; ?>>10</option>
			<option value="20" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 20): ?>selected<?php  endif; ?>>20</option>
			<option value="50" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 50): ?>selected<?php  endif; ?>>50</option>
			<option value="100" <?php  if ($this->_tpl_vars['listing_search']['listings_per_page'] == 100): ?>selected<?php  endif; ?>>100</option>
		</select>
	
		<input type="hidden" name="restore" value="1" />
		<input type="hidden" name="page" value="1" />
	</form>
</p>

<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-actions/" name="resultsForm">
	<input type="hidden" name="action_name" id="action_name" value="">
	<input type="hidden" name="rejectReason" value="">
	<input type="hidden" name="days_to_change" id="days_to_change" value="">
	
	<div id="dialog" style="display: none">
		<textarea name="reason" cols="30" rows="4"></textarea>
		<span class="greenButtonEnd"><input type="submit" value="Submit Reject" class="greenButton" id="submitReject" /></span>
	</div>

	<div id="modify_date_dialog" style="display: none">
		Modify Expiration Date for <input type="text" size="2" id="days" name="days"> days
		<div class="clr"><br/></div>
		<span class="greenButtonEnd"><input type="submit" id="modify_send_button" name="modify_send_button" value="Modify" class="greenButton" /></span>
	</div>

	<!-- p>
		Actions with Selected:<br/>
		<span class="greenButtonInEnd"><input type="submit" value="Activate" class="greenButtonIn" onclick="submitForm('activate');"></span>
				<span class="deleteButtonEnd"><input type="submit" value="Delete Permanently" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete permanently this listing?') ) submitForm('delete');"></span>
		<?php  if ($this->_tpl_vars['showApprovalStatusField'] == 1): ?>
			<span class="greenButtonInEnd"><input type="submit" value="Approve" class="greenButtonIn" onclick="submitForm('approve');"></span>
			<span class="greenButtonInEnd"><input type="submit" value="Reject" class="greenButtonIn" id="rejectButton"></span>
		<?php  endif; ?>
		<span class="greenButtonInEnd"><input type="button" id="modify_date_button" name="modify_date_button" value="Modify Expiration Date" class="greenButtonIn" /></span>
	</p -->

<div class="clr"><br/></div>

<table>
	<thead>
		<tr>
			<th><input type="checkbox" id="all_checkboxes_control"></th>
			
			
									<th>
										<a href="?restore=1&amp;sorting_field=username&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'username'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Listing User</a>
										<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'username'): ?>
											<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
												<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
											<?php  else: ?>
												<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
											<?php  endif; ?>
										<?php  endif; ?>
									</th>
			
					<th>
				<a href="?restore=1&amp;sorting_field=Title&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'Title'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Job Title</a>
				<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'Title'): ?>
					<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
					<?php  else: ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
					<?php  endif; ?>
				<?php  endif; ?>
			</th>
						<th>
				<a href="?restore=1&amp;sorting_field=activation_date&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'activation_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Posting Date</a>
				<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'activation_date'): ?>
					<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
					<?php  else: ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
					<?php  endif; ?>
				<?php  endif; ?>
			</th>
			
			
			
			<th>
				<a href="?restore=1&amp;sorting_field=expiration_date&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'expiration_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Expiration Date</a>
				<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'expiration_date'): ?>
					<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
					<?php  else: ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
					<?php  endif; ?>
				<?php  endif; ?>
			</th>
			
			
			
							
							<th>
								<a href="?restore=1&amp;sorting_field=expiration_date&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'expiration_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Company Name</a>
								<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'company_name'): ?>
									<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
										<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
									<?php  else: ?>
										<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
									<?php  endif; ?>
								<?php  endif; ?>
							</th>
							
							
			
		
			<th>
				<a href="?restore=1&amp;sorting_field=views&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'views'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Views</a>
				<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'views'): ?>
					<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC'): ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
					<?php  else: ?>
						<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
					<?php  endif; ?>
				<?php  endif; ?>
			</th>
					<?php  if ($this->_tpl_vars['showApprovalStatusField'] != false): ?>
				<th>
					<a href="?restore=1&amp;sorting_field=status&amp;sorting_order=<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'ASC' && $this->_tpl_vars['listing_search']['sorting_field'] == 'status'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>">Approval Status</a>
					<?php  if ($this->_tpl_vars['listing_search']['sorting_field'] == 'status'): ?>
						<?php  if ($this->_tpl_vars['listing_search']['sorting_order'] == 'DESC'): ?>
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif" alt="Up" />
						<?php  else: ?>
							<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif" alt="Down" />
						<?php  endif; ?>
					<?php  endif; ?>
				</th>
			<?php  endif; ?>
			<th colspan=3 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings_block']['iteration']++;
?>			
			<?php  if ($this->_tpl_vars['listing']['deleted'] == 1 && $this->_tpl_vars['listing']['type']['id'] == 'Job'): ?> 				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td><input type="checkbox" name="listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['listings_block']['iteration']; ?>
" /></td>
					
					<td><a href="mailto:<?php  echo $this->_tpl_vars['listing']['user']['email']; ?>
"><?php  echo $this->_tpl_vars['listing']['user']['username']; ?>
</a></td>
					
										<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><b><?php  echo $this->_tpl_vars['listing']['Title']; ?>
</b></a></td>
										<td><span title="<?php  echo $this->_tpl_vars['listing']['activation_date']; ?>
"><?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['activation_date'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/\s.*/", "") : smarty_modifier_regex_replace($_tmp, "/\s.*/", "")); ?>
</span></td>
					<td><span title="<?php  echo $this->_tpl_vars['listing']['expiration_date']; ?>
"><?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['expiration_date'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/\s.*/", "") : smarty_modifier_regex_replace($_tmp, "/\s.*/", "")); ?>
</span></td>
					
							<td><span title="<?php  echo $this->_tpl_vars['listing']['CompanyName']; ?>
"><?php  echo $this->_tpl_vars['listing']['CompanyName']; ?>
</span></td>
					
					<td><?php  echo $this->_tpl_vars['listing']['views']; ?>
</td>
								        <?php  if ($this->_tpl_vars['showApprovalStatusField'] != false): ?>
			            <td <?php  if ($this->_tpl_vars['listing']['reject_reason'] != ''): ?>title="Reason: <?php  echo $this->_tpl_vars['listing']['reject_reason']; ?>
"<?php  endif; ?>>
			                <?php  $_from = $this->_tpl_vars['listingsTypesInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listingTypeInfo']):
?>
			                    <?php  if ($this->_tpl_vars['listingTypeInfo']['id'] == $this->_tpl_vars['listing']['type']['id'] && $this->_tpl_vars['listingTypeInfo']['waitApprove']): ?>
			                        <?php  echo $this->_tpl_vars['listing']['approveStatus']; ?>

			                    <?php  endif; ?>
			                <?php  endforeach; endif; unset($_from); ?>
			            </td>
			        <?php  endif; ?>
			       			        
			        
			        			        <td><a href="?restore=restore_job&amp;restore_listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;action=search&listing_type%5Bequal%5D=Job&deleted%5Bequal%5D=1" title="Restore"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
restore.png" border=0 alt="Restore"></a></td>
			        			        
										<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/listing-actions/?action_name=Delete&amp;listings[<?php  echo $this->_tpl_vars['listing']['id']; ?>
]=1" onclick="return confirm('Are you sure you want to delete permanently this job?')" title="Delete Permanently"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
delete.png" border="0" alt="Delete"></a></td>
				</tr>
			<?php  endif; ?> 		<?php  endforeach; endif; unset($_from); ?>
	</tbody>
</table>








<p>
	Actions with Selected:<br/>
	<span class="greenButtonInEnd"><input type="submit" value="Activate" class="greenButtonIn" onclick="submitForm('activate');" /></span>
		<span class="deleteButtonEnd"><input type="submit" value="Delete Permanently" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete permanently this job?') ) submitForm('delete');" /></span>
	<?php  if ($this->_tpl_vars['showApprovalStatusField'] == 1): ?>
		<span class="greenButtonInEnd"><input type="submit" value="Approve" class="greenButtonIn" onclick="submitForm('approve');" /></span>
		<span class="greenButtonInEnd"><input type="submit" value="Reject" class="greenButtonIn" id="rejectButton" /></span>
	<?php  endif; ?>
	
</p>












</form>

<div class="clr"><br/></div>
<p>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
">&#171; Previous</a><?php  else: ?>&#171; Previous<?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 0): ?>&nbsp;<a href="?restore=1&amp;page=1">1</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-3 > 1): ?>&nbsp;...<?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-2 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-2; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']-1 > 0): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']-1; ?>
</a><?php  endif; ?>
	<strong><?php  echo $this->_tpl_vars['listing_search']['current_page']; ?>
</strong>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']+2 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
"><?php  echo $this->_tpl_vars['listing_search']['current_page']+2; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;...<?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']+3 < $this->_tpl_vars['listing_search']['pages_number'] + 1): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
"><?php  echo $this->_tpl_vars['listing_search']['pages_number']; ?>
</a><?php  endif; ?>
	<?php  if ($this->_tpl_vars['listing_search']['current_page']+1 <= $this->_tpl_vars['listing_search']['pages_number']): ?>&nbsp;<a href="?restore=1&amp;page=<?php  echo $this->_tpl_vars['listing_search']['current_page']+1; ?>
">Next &#187;</a><?php  else: ?>Next &#187;<?php  endif; ?>
</p>

<script>
	var total=<?php  echo $this->_foreach['listings_block']['total']; ?>
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
		var form = document.resultsForm;
		form.submit();
	}
	'; ?>

</script>