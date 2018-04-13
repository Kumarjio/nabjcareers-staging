<?php  /* Smarty version 2.6.14, created on 2017-08-11 08:23:27
         compiled from ../field_types/display/complex.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'display', '../field_types/display/complex.tpl', 5, false),array('block', 'tr', '../field_types/display/complex.tpl', 33, false),)), $this); ?>
<?php  $this->assign('complexField', $this->_tpl_vars['id']); ?> <?php  if ($this->_tpl_vars['complexField'] == 'Education'): ?>
	<?php  $_from = $this->_tpl_vars['complexElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['complexElementKey'] => $this->_tpl_vars['complexElementItem']):
?>
		<div class="leftDisplaySIde">
			<strong><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['EntranceDate']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
 - <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['GraduationDate']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</strong>
		</div>
		<div class="rightDisplaySIde">
			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['InstitutionName']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
<br/>
			<strong><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['Major']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</strong><br/>
			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['DegreeLevel']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>

			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['testFile']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>

		</div>
		<div class="clrBorder"><br/></div>
	<?php  endforeach; endif; unset($_from); ?>
<?php  elseif ($this->_tpl_vars['complexField'] == 'WorkExperience'): ?>
	<?php  $_from = $this->_tpl_vars['complexElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['complexElementKey'] => $this->_tpl_vars['complexElementItem']):
?>
		<div class="leftDisplaySIde">
				<strong><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['JobTitle']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</strong>
				
		</div>
		<div class="rightDisplaySIde workdates">
			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['StartDate']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
 - <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['EndDate']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
<br/>
			<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['CompanyName']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
 | <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['Industry']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
<br/>
			<span class="workdescrip"><?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_fields']['Description']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>
</span>
		</div>
		<div class="clrBorder"><br/></div>
	<?php  endforeach; endif; unset($_from); ?>
<?php  else: ?>
	<?php  $_from = $this->_tpl_vars['complexElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['complexElementKey'] => $this->_tpl_vars['complexElementItem']):
?>
		<div class="complexField">
			<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
				<fieldset>
					<strong> <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;</strong>
					<?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_field']['id'],'complexParent' => $this->_tpl_vars['complexField'],'complexStep' => $this->_tpl_vars['complexElementKey']), $this);?>

				</fieldset>
			<?php  endforeach; endif; unset($_from); ?>
		</div>
	<?php  endforeach; endif; unset($_from); ?>
<?php  endif; ?>
<?php  $this->assign('complexField', false); ?> 