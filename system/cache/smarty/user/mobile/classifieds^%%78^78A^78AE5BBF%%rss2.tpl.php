<?php  /* Smarty version 2.6.14, created on 2014-08-03 03:30:14
         compiled from rss2.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'rss2.tpl', 6, false),array('modifier', 'regex_replace', 'rss2.tpl', 19, false),)), $this); ?>
<?php  echo '<?xml'; ?>
 version="1.0"<?php  echo '?>'; ?>

<rss version="2.0">
  <channel>
    <title><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['TITLE'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></title>
    <link><?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
</link>
    <description><?php  echo $this->_tpl_vars['DESCRIPTION']; ?>
</description>
    <language><?php  echo $this->_tpl_vars['GLOBALS']['current_language']; ?>
-us</language>
    <pubDate><?php  echo $this->_tpl_vars['lastBuildDate']; ?>
 GMT</pubDate>
  <lastBuildDate><?php  echo $this->_tpl_vars['lastBuildDate']; ?>
 GMT</lastBuildDate>
    <docs><?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['GLOBALS']['user_page_uri']; ?>
</docs>
    <generator>Weblog Editor 2.0</generator>
    <managingEditor>editor@example.com</managingEditor>
    <webMaster>webmaster@example.com</webMaster>
   <?php  $_from = $this->_tpl_vars['listings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing']):
        $this->_foreach['listings_block']['iteration']++;
?>
   	<item>
		<title><![CDATA[<?php  echo $this->_tpl_vars['listing']['Title']; ?>
]]></title>
		<link><?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-job/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html</link>
		<description><![CDATA[<?php  echo $this->_tpl_vars['listing']['City']; ?>
, <?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['listing']['State'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['listing']['State'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php  echo $this->_tpl_vars['listing']['user']['CompanyName']; ?>
<br/>
		<?php  echo $this->_tpl_vars['listing']['JobDescription']; ?>
]]></description>
		<pubDate><?php  echo $this->_tpl_vars['listing']['formatted_date']; ?>
 GMT</pubDate>
		<guid><?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-job/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing']['Title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html</guid>
	</item>
	<?php  endforeach; endif; unset($_from); ?>
  </channel>
</rss>
