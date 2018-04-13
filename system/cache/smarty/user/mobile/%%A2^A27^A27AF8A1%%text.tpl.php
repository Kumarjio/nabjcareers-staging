<?php  /* Smarty version 2.6.14, created on 2014-03-28 04:58:21
         compiled from ../field_types/input/text.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'WYSIWYGEditor', '../field_types/input/text.tpl', 9, false),)), $this); ?>
<?php  ob_start();   if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif;   $this->_smarty_vars['capture']['wysiwygName'] = ob_get_contents(); ob_end_clean(); ?>
<?php  ob_start(); ?>inputText<?php  if ($this->_tpl_vars['complexField']): ?> complexField<?php  endif;   $this->_smarty_vars['capture']['wysiwygClass'] = ob_get_contents(); ob_end_clean(); ?>
<?php  if ($this->_tpl_vars['complexField']): ?>
    <?php  $this->assign('wysiwygType', 'none'); ?>
<?php  else: ?>
    <?php  $this->assign('wysiwygType', 'fckeditor'); ?>
<?php  endif; ?>

<?php  echo smarty_function_WYSIWYGEditor(array('name' => $this->_smarty_vars['capture']['wysiwygName'],'class' => $this->_smarty_vars['capture']['wysiwygClass'],'width' => '555px','height' => '300','type' => $this->_tpl_vars['wysiwygType'],'value' => $this->_tpl_vars['value'],'conf' => 'Basic'), $this);?>