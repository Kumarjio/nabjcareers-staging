<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:50
         compiled from input_form_default.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'input_form_default.tpl', 5, false),array('function', 'input', 'input_form_default.tpl', 7, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
	<?php  if ($this->_tpl_vars['form_field']['id'] == 'video' || $this->_tpl_vars['form_field']['id'] == 'youtube'): ?>
		<?php  if ($this->_tpl_vars['package']['video_allowed']): ?>
			<fieldset>
				<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</div>
				<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
			</fieldset>
		<?php  endif; ?>
	<?php  elseif (( $this->_tpl_vars['listing_type_id'] == 'Job' || $this->_tpl_vars['listing']['type']['id'] == 'Job' ) && $this->_tpl_vars['form_field']['id'] == 'anonymous'): ?>
			
	<?php  elseif (( $this->_tpl_vars['listing_type_id'] == 'Resume' || $this->_tpl_vars['listing']['type']['id'] == 'Resume' ) && $this->_tpl_vars['form_field']['id'] == 'Title'): ?>
		<fieldset>
		<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Desired Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</div>
				<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1'); ?>


<div class="instruction">
	<div class="instr_icon" onmouseover="javascript:$(this).next('.instr_block').show();" onmouseout="javascript:$(this).next('.instr_block').hide();"></div>
    <div class="instr_block" id="instruction_<?php  echo $this->_tpl_vars['form_field']['id']; ?>
">
		<div class="instr_arrow"></div>
		<div class="instr_cont">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter the desired jobs you want. This will be displayed at the top of your resume. Example: Reporter, On-Air Talent, Producer, Copy Editor etc.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
    <div class="clr"></div>
</div>



<?php  endif; ?>
		</fieldset> 
	
	<?php  elseif (( $this->_tpl_vars['listing_type_id'] == 'Resume' || $this->_tpl_vars['listing']['type']['id'] == 'Resume' ) && $this->_tpl_vars['form_field']['id'] == 'anonymous'): ?>
			<fieldset>
				<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</div>
				<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
			</fieldset>
	<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'access_type'): ?>
		<?php  if ($this->_tpl_vars['listing_type_id'] != 'Job' && $this->_tpl_vars['listing']['type']['id'] != 'Job'): ?>			<fieldset>
				<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'resume_access.tpl'), $this);?>
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
			<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'applicationSettings.tpl'), $this);?>
</div>
			<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
		</fieldset>
	<?php  else: ?>
		<fieldset>
			<?php  $this->assign('fixInstructionsForComplexField', false); ?>
			<?php  if ($this->_tpl_vars['form_field']['type'] != 'complex'): ?>
				<?php  $this->assign('fixInstructionsForComplexField', true); ?>
			<?php  endif; ?>
			<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
			<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
			<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</div>
			<?php  if ($this->_tpl_vars['form_field']['instructions'] && $this->_tpl_vars['fixInstructionsForComplexField']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
		</fieldset>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
<?php  if ($this->_tpl_vars['instructionsExist']): ?>
	<?php  echo '
		<script type="text/javascript">
			function instructionFunc() {
				var elem = $(".instruction").prev();
				elem.children().focus(function() {
					$(this).parent().next(".instruction").children(".instr_block").show();
				});
				elem.children().blur(function() {
					$(this).parent().next(".instruction").children(".instr_block").hide();
				});
			}
			$("document").ready(function() {
				instructionFunc();
			});
			function FCKeditor_OnComplete(editorInstance) {
				editorInstance.Events.AttachEvent( \'OnFocus\', function() {
						$("#instruction_"+editorInstance.Name).show();
					});
				editorInstance.Events.AttachEvent( \'OnBlur\', function() {
						$("#instruction_"+editorInstance.Name).hide();
					});
				return;
			}
		</script>
	'; ?>

<?php  endif; ?>

