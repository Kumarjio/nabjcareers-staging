<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:51
         compiled from ../field_types/input/complex.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/complex.tpl', 11, false),array('function', 'input', '../field_types/input/complex.tpl', 13, false),)), $this); ?>
<?php  $this->assign('complexField', $this->_tpl_vars['form_field']['id']); ?> <div id='complexFields_<?php  echo $this->_tpl_vars['complexField']; ?>
' class="complex">
    <?php  $_from = $this->_tpl_vars['complexElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['complexElementKey'] => $this->_tpl_vars['complexElementItem']):
?>
            <?php  if ($this->_tpl_vars['complexElementKey'] != 1): ?>
            <div id='complexFieldsAdd_<?php  echo $this->_tpl_vars['complexField']; ?>
_<?php  echo $this->_tpl_vars['complexElementKey']; ?>
' class="complex">
        <?php  endif; ?>
        <?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
            <?php  if ($this->_tpl_vars['form_field']['id'] == 'video' || $this->_tpl_vars['form_field']['id'] == 'youtube'): ?>
                <?php  if ($this->_tpl_vars['package']['video_allowed']): ?>
                    <fieldset>
                        <div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                        <div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
                        <div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</div>
						<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
                    </fieldset>
                <?php  endif; ?>
            <?php  elseif ($this->_tpl_vars['listing_type_id'] == 'Job' && $this->_tpl_vars['form_field']['id'] == 'anonymous'): ?>
                            <?php  elseif ($this->_tpl_vars['form_field']['id'] == 'access_type'): ?>
                <?php  if ($this->_tpl_vars['listing_type_id'] != 'Job' && $this->_tpl_vars['listing']['type']['id'] != 'Job'): ?>                    <fieldset>
                        <div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                        <div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
                        <div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'resume_access.tpl','complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</div>
						<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
                    </fieldset>
                <?php  endif; ?>
            <?php  elseif (( $this->_tpl_vars['listing_type_id'] == 'Job' || $this->_tpl_vars['listing']['type']['id'] == 'Job' ) && $this->_tpl_vars['form_field']['id'] == 'ApplicationSettings'): ?>
                <fieldset>
                    <div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                    <div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
                    <div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'applicationSettings.tpl','complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</div>
					<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
                </fieldset>
            <?php  else: ?>
                <fieldset>
                    <div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                    <div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
                    <div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</div>
					<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
                </fieldset>
            <?php  endif; ?>
        <?php  endforeach; endif; unset($_from); ?>
        <?php  if ($this->_tpl_vars['complexElementKey'] == 1): ?>
            </div><div id='complexFieldsAdd_<?php  echo $this->_tpl_vars['complexField']; ?>
'>
        <?php  else: ?>
            <a href='' class="remove" onclick='removeComplexField_<?php  echo $this->_tpl_vars['complexField']; ?>
(<?php  echo $this->_tpl_vars['complexElementKey']; ?>
); return false;' ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></div>
        <?php  endif; ?>
    <?php  endforeach; endif; unset($_from); ?>
</div>
<a href='#' class="add" onclick='addComplexField_<?php  echo $this->_tpl_vars['complexField']; ?>
(); return false;' ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>

<script>

	var i_<?php  echo $this->_tpl_vars['complexField']; ?>
 = <?php  echo $this->_tpl_vars['complexElementKey']; ?>
 + 1;

	var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");

	function addComplexField_<?php  echo $this->_tpl_vars['complexField']; ?>
() {
		var id = "complexFieldsAdd_<?php  echo $this->_tpl_vars['complexField']; ?>
_" + i_<?php  echo $this->_tpl_vars['complexField']; ?>
;
		var newField = $('#complexFields_<?php  echo $this->_tpl_vars['complexField']; ?>
').clone();
		newField.append('<a class="remove" href="" onclick="removeComplexField_<?php  echo $this->_tpl_vars['complexField']; ?>
(' + i_<?php  echo $this->_tpl_vars['complexField']; ?>
 + '); return false;"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br/>');
		$("<div id='" + id + "' />").appendTo("#complexFieldsAdd_<?php  echo $this->_tpl_vars['complexField']; ?>
");
		newField.appendTo('#' + id);
		$('#'+ id +' input[type=text]').val('');
		$('#'+ id +' input[type=file]').val('');
		$('#'+ id +' select').val('');
		$('#'+ id +' textarea').val('');
		$('#'+ id +' .complexField').each(function() {
				$(this).attr( 'name',  $(this).attr( 'name' ).replace('[1]', '['+i_<?php  echo $this->_tpl_vars['complexField']; ?>
+']'));
			}
		);
		$('#'+ id +' .complex-view-file-caption').remove();

		var img = $('#'+ id +' input').next('.ui-datepicker-trigger');
		var el = img.prev('.input-date');
		el.removeAttr('id').removeClass('hasDatepicker').unbind();
		el.datepicker(<?php  echo '{
                dateFormat: dFormat,
                showOn: \'button\',
                changeMonth: true,
                changeYear: true,
                minDate: new Date(1940, 1 - 1, 1),
                maxDate: \'+0m +0w\',
                yearRange: \'-99:+99\',
                buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/calendar.gif<?php  echo '\',
                buttonImageOnly: true
            });
            img.remove();
		if(typeof window.instructionFunc == \'function\') {
			instructionFunc();
		}
        '; ?>

		i_<?php  echo $this->_tpl_vars['complexField']; ?>
++;

	}

    function removeComplexField_<?php  echo $this->_tpl_vars['complexField']; ?>
(id) {
        $('#complexFieldsAdd_<?php  echo $this->_tpl_vars['complexField']; ?>
_' + id).remove();
	}

</script>

<?php  $this->assign('complexField', false); ?> 