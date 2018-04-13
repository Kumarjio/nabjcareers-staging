<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:12
         compiled from show_breadcrumbs.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'show_breadcrumbs.tpl', 3, false),)), $this); ?>
<?php  if ($this->_tpl_vars['navCount'] == '0'):   else: ?> 
<div class="BreadCrumbs">
	<p><?php  $_from = $this->_tpl_vars['navArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['navForeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['navForeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['navItem']):
        $this->_foreach['navForeach']['iteration']++;
?> <?php  if ($this->_foreach['navForeach']['iteration'] < $this->_tpl_vars['navCount']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['navItem']['uri']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['navItem']['name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &#187; <?php  else: ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['navItem']['name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  endif; ?> <?php  endforeach; endif; unset($_from); ?> </p>
</div>
<?php  endif; ?>