<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:16:56
         compiled from open_invoices_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'open_invoices_form.tpl', 1, false),array('function', 'search', 'open_invoices_form.tpl', 9, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open Invoices<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Open Invoices</h1>
<form method="POST" name="search_form">
	<fieldset>
		<legend>Select Dates</legend>
		<table>
			<tbody>
				<tr>
					<td>from <?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'creation_date','template' => 'date.from.tpl'), $this);?>
</td>
					<td>to <?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'creation_date','template' => 'date.to.tpl'), $this);?>
</td>
					<td>
						<input type="hidden" name="action" value="filter">
						<span class="greenButtonEnd"><input type="submit" class="greenButton" value="Get open invoices" /></span>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>
<div class="clr"><br/></div>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
<script>
	$( function () {
	
		var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
		<?php  echo '
		dFormat = dFormat.replace(\'%m\', "mm");
		dFormat = dFormat.replace(\'%d\', "dd");
		dFormat = dFormat.replace(\'%Y\', "yy");
		
		$("#creation_date_notless, #creation_date_notmore").datepicker({dateFormat: dFormat, showOn: \'button\', yearRange: \'-99:+99\', buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/calendar.gif<?php  echo '\', buttonImageOnly: true });
		
		'; ?>

	});
</script>