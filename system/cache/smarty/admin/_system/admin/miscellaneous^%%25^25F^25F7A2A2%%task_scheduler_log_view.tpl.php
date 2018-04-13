<?php  /* Smarty version 2.6.14, created on 2018-02-28 00:56:12
         compiled from task_scheduler_log_view.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'task_scheduler_log_view.tpl', 1, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/task-scheduler-settings/">Task Scheduler Settings</a> &#187; Log View<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Log View</h1>
<p>Show last 30 records from logs</p>
<textarea class="text" style="width:100%;height:400px;font-size:0.9em;" readonly="readonly"><?php  $_from = $this->_tpl_vars['log_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['record']):
  echo $this->_tpl_vars['record'];   endforeach; endif; unset($_from); ?></textarea>