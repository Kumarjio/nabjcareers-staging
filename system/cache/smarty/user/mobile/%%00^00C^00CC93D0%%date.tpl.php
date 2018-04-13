<?php  /* Smarty version 2.6.14, created on 2017-06-24 09:11:54
         compiled from ../field_types/input/date.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/date.tpl', 2, false),)), $this); ?>
<input type="text" class="input-date displayDate <?php  if ($this->_tpl_vars['complexField']): ?>complexField <?php  echo $this->_tpl_vars['id'];   endif; ?>" 
name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" value="<?php  $this->_tag_stack[] = array('tr', array('type' => 'date')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php  if ($this->_tpl_vars['mysql_date'] && ! $this->_tpl_vars['complexField']):   echo $this->_tpl_vars['mysql_date'];   else:   echo $this->_tpl_vars['value'];   endif;   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />

<div id="sampleDate"><i ><b>format:</b> mm.dd.yyyy</i></div>


<script>

var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
<?php  echo '
dFormat = dFormat.replace(\'%m\', "mm");
dFormat = dFormat.replace(\'%d\', "dd");
dFormat = dFormat.replace(\'%Y\', "yy");

$(document).ready(function() {
    '; ?>
$(".input-date").datepicker(<?php  echo '{ 
		dateFormat: dFormat,
		showOn: \'button\',
		changeMonth: true,
		changeYear: true,
		minDate: new Date(1940, 1 - 1, 1),
		maxDate: \'+10y\',
		yearRange: \'-99:+99\',
		buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/calendar.gif<?php  echo '\',
		buttonImageOnly: true
	});
});
'; ?>

</script>