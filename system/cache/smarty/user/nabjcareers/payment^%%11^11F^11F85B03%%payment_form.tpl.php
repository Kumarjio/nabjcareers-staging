<?php  /* Smarty version 2.6.14, created on 2014-10-22 23:55:29
         compiled from payment_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'payment_form.tpl', 1, false),array('function', 'search', 'payment_form.tpl', 14, false),)), $this); ?>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billing History<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<form method="post" action="" name="search_form">
<br/>
<table id="paymentPage">
	<thead>
		<tr>
			<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
			<th colspan="2"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Period<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
			<th><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><br/><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'id','parameters' => 'size="10"'), $this);?>
</td>
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>from<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'creation_date','template' => 'date.from.tpl'), $this);?>
</td>
			<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'creation_date','template' => 'date.to.tpl'), $this);?>
</td>
			<td><br/><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'status'), $this);?>
</td>
		</tr>
	</tbody>
	<tr align="right">
		<td colspan="4"><input type="hidden" name="action" value="filter" /><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><br/></td>
	</tr>
</table>
</form>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>

<script>

$( function () {
	var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
	<?php  echo '
	dFormat = dFormat.replace(\'%m\', "mm");
	dFormat = dFormat.replace(\'%d\', "dd");
	dFormat = dFormat.replace(\'%Y\', "yy");
	
	$("#creation_date_notless, #creation_date_notmore").datepicker({dateFormat: dFormat, showOn: \'button\', yearRange: \'-99:+99\', buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/calendar.gif<?php  echo '\', buttonImageOnly: true });
	
	'; ?>

});
</script>