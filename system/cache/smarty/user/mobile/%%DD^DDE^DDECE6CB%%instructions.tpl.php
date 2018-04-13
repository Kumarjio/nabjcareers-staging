<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:50
         compiled from instructions.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'instructions.tpl', 6, false),)), $this); ?>
<div class="instruction">
	<div class="instr_icon" onmouseover="javascript:$(this).next('.instr_block').show();" onmouseout="javascript:$(this).next('.instr_block').hide();"></div>
    <div class="instr_block" id="instruction_<?php  echo $this->_tpl_vars['form_field']['id']; ?>
">
		<div class="instr_arrow"></div>
		<div class="instr_cont">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['instructions'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
    <div class="clr"></div>
</div>