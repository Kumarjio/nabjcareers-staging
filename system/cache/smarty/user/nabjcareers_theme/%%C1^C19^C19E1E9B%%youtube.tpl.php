<?php  /* Smarty version 2.6.14, created on 2018-02-13 14:59:34
         compiled from ../field_types/display/youtube.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '../field_types/display/youtube.tpl', 2, false),array('modifier', 'replace', '../field_types/display/youtube.tpl', 7, false),)), $this); ?>
<?php  echo $this->_tpl_vars['v']; ?>

<?php  $this->assign('v', ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 17, "") : smarty_modifier_truncate($_tmp, 17, ""))); ?>

<object width="250" height="225">

<param name="movie" value='http://www.youtube.com/v/
<?php  if ($this->_tpl_vars['v'] == "https://youtu.be/"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "https://youtu.be/", "") : smarty_modifier_replace($_tmp, "https://youtu.be/", "")); ?>

<?php  elseif ($this->_tpl_vars['v'] == "http://www.youtub"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "http://www.youtube.com/watch?v=", "") : smarty_modifier_replace($_tmp, "http://www.youtube.com/watch?v=", "")); ?>

<?php  elseif ($this->_tpl_vars['v'] == "https://www.youtu"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "https://www.youtube.com/watch?v=", "") : smarty_modifier_replace($_tmp, "https://www.youtube.com/watch?v=", ""));   endif; ?>
&hl=ru&fs=1'></param>


<param name="allowFullScreen" value="true"></param>
<param name="allowscriptaccess" value="always"></param>
<embed src='http://www.youtube.com/v/
<?php  if ($this->_tpl_vars['v'] == "https://youtu.be/"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "https://youtu.be/", "") : smarty_modifier_replace($_tmp, "https://youtu.be/", "")); ?>

<?php  elseif ($this->_tpl_vars['v'] == "http://www.youtub"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "http://www.youtube.com/watch?v=", "") : smarty_modifier_replace($_tmp, "http://www.youtube.com/watch?v=", "")); ?>

<?php  elseif ($this->_tpl_vars['v'] == "https://www.youtu"):   echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, "https://www.youtube.com/watch?v=", "") : smarty_modifier_replace($_tmp, "https://www.youtube.com/watch?v=", ""));   endif; ?>
&hl=ru&fs=1' type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="250" height="225"></embed>
</object>