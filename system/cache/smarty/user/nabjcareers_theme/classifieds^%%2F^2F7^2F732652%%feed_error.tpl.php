<?php  /* Smarty version 2.6.14, created on 2018-02-10 16:25:11
         compiled from feed_error.tpl */ ?>
<?php  echo '<?xml'; ?>
 version="1.0"<?php  echo '?>'; ?>

<rss version="2.0">
  <channel>
    <title>RSS Error</title>
    <link><?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
</link>
    <description><?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?> <?php  echo $this->_tpl_vars['error']; ?>
 <?php  endforeach; endif; unset($_from); ?></description>
    <language><?php  echo $this->_tpl_vars['GLOBALS']['current_language']; ?>
-us</language>
    <pubDate></pubDate>
	<lastBuildDate></lastBuildDate>
    <docs><?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
</docs>
    <generator></generator>
    <managingEditor></managingEditor>
    <webMaster></webMaster>
   	<item></item>
  </channel>
</rss>