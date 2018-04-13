<?php  /* Smarty version 2.6.14, created on 2014-10-20 21:40:14
         compiled from apply_now_jobg8.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'apply_now_jobg8.tpl', 10, false),)), $this); ?>

<?php  if ($this->_tpl_vars['errors']): ?>

<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error']):
?>
<p class="error">
<?php  if ($this->_tpl_vars['error_code'] == 'UNDEFINED_LISTING_ID'):   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Undefined Listing ID for apply<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  elseif ($this->_tpl_vars['error_code'] == 'WRONG_LISTING_ID_SPECIFIED'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There is no listing in the system with the specified ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  endif; ?>
</p>
<?php  endforeach; endif; unset($_from); ?>


<?php  else: ?>

<center>
<h2>Apply Now</h2>
<!-- Jobg8 iframe -->
<iframe border="0" runat="server" height="450px" width="700px" frameborder="0"
src="<?php  echo $this->_tpl_vars['applicationURL']; ?>
">
</iframe>
<!-- /Jobg8 iframe -->
</center>

<?php  endif; ?>