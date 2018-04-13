<?php  /* Smarty version 2.6.14, created on 2014-06-02 21:27:28
         compiled from news_rss.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'news_rss.tpl', 24, false),)), $this); ?>
<?php  echo '<?xml'; ?>
 version="1.0" encoding="utf-8" <?php  echo '?>'; ?>

	<rss version="2.0">
		<channel>
		    <title>Asiamediajobs news feed</title>
		    <link><![CDATA[<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
]]></link>
		    <description><![CDATA[<?php  echo $this->_tpl_vars['DESCRIPTION']; ?>
]]></description>
		    <language><?php  echo $this->_tpl_vars['GLOBALS']['current_language']; ?>
-us</language>
		    <pubDate><?php  echo $this->_tpl_vars['lastBuildDate']; ?>
 GMT</pubDate>
		  <lastBuildDate><?php  echo $this->_tpl_vars['lastBuildDate']; ?>
 GMT</lastBuildDate>
		    <docs><![CDATA[<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['GLOBALS']['user_page_uri']; ?>
?feedId=<?php  echo $this->_tpl_vars['feed']['sid']; ?>
]]></docs>
		    <generator>Weblog Editor 2.0</generator>
		    <managingEditor>editor@example.com</managingEditor>
		    <webMaster>webmaster@example.com</webMaster>
			
			<?php  $_from = $this->_tpl_vars['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listings_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listings_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['listings_block']['iteration']++;
?>
			   	<item>
					<title><![CDATA[<?php  echo $this->_tpl_vars['item']['title']; ?>
]]></title>
					<description><![CDATA[<?php  echo $this->_tpl_vars['item']['brief']; ?>
]]></description>
					<pubDate><![CDATA[<?php  echo $this->_tpl_vars['item']['date']; ?>
]]></pubDate>
					<source><![CDATA[<?php  echo $this->_tpl_vars['item']['link']; ?>
]]></source>
					
			   		<link><![CDATA[<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/news/<?php  echo $this->_tpl_vars['item']['sid']; ?>
/<?php  echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-") : smarty_modifier_regex_replace($_tmp, "/[\\/\\\:*?\"<>|%#$\s]/", "-")); ?>
.html]]></link>
								
				</item>
			<?php  endforeach; endif; unset($_from); ?>
		</channel>
	</rss>