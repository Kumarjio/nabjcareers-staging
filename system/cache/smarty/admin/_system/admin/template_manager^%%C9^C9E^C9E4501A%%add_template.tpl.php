<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:35:39
         compiled from add_template.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'add_template.tpl', 22, false),)), $this); ?>
<div class="clr"><br/></div>
<?php  $_from = $this->_tpl_vars['tpl_error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['theError']):
?>
    <?php  if ($this->_tpl_vars['theError'] == 'FILE_EXISTS'): ?>
        <p class="error">such template already exists</p>
    <?php  elseif ($this->_tpl_vars['theError'] == 'MODULE_ERROR'): ?>
        <p class="error">there is no such module in system</p>
    <?php  elseif ($this->_tpl_vars['theError'] == 'NOT_VALID_FILENAME_FORMAT'): ?>
        <p class="error">not valid filename format</p>
    <?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
<div class="clr"><br/></div>
<form action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/" method="post">
    <fieldset  style="max-width: 660px;">
        <legend><?php  if ($this->_tpl_vars['template_name']): ?>Edit Template<?php  else: ?>Add a New Template<?php  endif; ?></legend>
        <label for="templ_name">Template Name</label>
        <input type="text" value="<?php  echo $this->_tpl_vars['template_name']; ?>
" name="templ_name" id="templ_name"/>
        <label for="templ_module">Module Name</label>
        <select name="templ_module" id="templ_module">
            <?php  $_from = $this->_tpl_vars['module_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['system_module_name'] => $this->_tpl_vars['module_info']):
?>
            <option <?php  if ($this->_tpl_vars['system_module_name'] == $this->_tpl_vars['module_name']): ?>selected<?php  endif; ?> value="<?php  echo $this->_tpl_vars['system_module_name']; ?>
"><?php  echo $this->_tpl_vars['module_info']['display_name']; ?>
</option>
            <?php  endforeach; else: ?>
            <option value=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No module is available<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <?php  endif; unset($_from); ?>
        </select>
        <?php  if ($this->_tpl_vars['template_name']): ?>
	        <input type="hidden" name="action" value="edit"/>
	        <input type="hidden" name="templ_module_or" value="<?php  echo $this->_tpl_vars['module_name']; ?>
"/>
	        <input type="hidden" name="templ_name_or" value="<?php  echo $this->_tpl_vars['template_name']; ?>
"/>
	        <span class="greenButtonEnd"><input type="submit" value="Save" name="edit_template" onclick="return confirm('Changing Template name may affect the front-end pages work. Are you sure you want to rename/move this Template?');" class="greenButton" /></span>
        <?php  else: ?>
	        <input type="hidden" name="action" value="add"/>
	        <span class="greenButtonEnd"><input type="submit" value="Add" name="add_template" class="greenButton"/></span>
        <?php  endif; ?>
    </fieldset>
</form>