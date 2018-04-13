<?php  /* Smarty version 2.6.14, created on 2014-10-20 01:18:26
         compiled from browse_items_and_results.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'browse_items_and_results.tpl', 2, false),array('block', 'title', 'browse_items_and_results.tpl', 4, false),array('block', 'keywords', 'browse_items_and_results.tpl', 5, false),array('block', 'description', 'browse_items_and_results.tpl', 6, false),array('modifier', 'escape', 'browse_items_and_results.tpl', 22, false),)), $this); ?>
<div class="browse">
<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['user_page_uri']; ?>
"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['TITLE'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
<?php  $_from = $this->_tpl_vars['browse_navigation_elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav_elements'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_elements']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['element']):
        $this->_foreach['nav_elements']['iteration']++;
?>
<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['element']['metadata'],'mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['element']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('keywords', array()); $_block_repeat=true;$this->_plugins['block']['keywords'][0][0]->_tpl_keywords($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['element']['metadata'],'mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['element']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['keywords'][0][0]->_tpl_keywords($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('description', array()); $_block_repeat=true;$this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['element']['metadata'],'mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['element']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['description'][0][0]->_tpl_description($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
 / 
  <?php  if (($this->_foreach['nav_elements']['iteration'] == $this->_foreach['nav_elements']['total'])): ?> 	
  	<?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['element']['metadata'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['element']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 	
  <?php  else: ?>
  	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['element']['uri']; ?>
"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['element']['metadata'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['element']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
  <?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
</div>

<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  if (empty ( $this->_tpl_vars['listings'] )): ?>
<table width=100% cellpadding="5px"><tr valign=top>

<?php  $this->assign('columnCount', '5'); ?>
<?php  $_from = $this->_tpl_vars['browseItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['browseItems'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['browseItems']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['browseItem']):
        $this->_foreach['browseItems']['iteration']++;
?>  
	<td><a href="<?php  echo ((is_array($_tmp=$this->_tpl_vars['browseItem']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
/"><?php  $this->_tag_stack[] = array('tr', array('domain' => 'Property_JobCategory')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['browseItem']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php  echo $this->_tpl_vars['browseItem']['count']; ?>
)</a></td>
	<?php  if ($this->_foreach['browseItems']['iteration'] % $this->_tpl_vars['columnCount'] == 0): ?></tr><tr><?php  endif; ?>
<?php  endforeach; else: ?>
	<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no listings with requested parameters in the system.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
<?php  endif; unset($_from); ?>
</tr></table>

<?php  else: ?>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "search_results_jobs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  endif; ?>