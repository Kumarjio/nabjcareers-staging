<?php  /* Smarty version 2.6.14, created on 2014-07-30 19:36:38
         compiled from video_player.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'video_player.tpl', 8, false),)), $this); ?>
<div id="videoContainer_<?php  echo $this->_tpl_vars['field_id']; ?>
"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
<script type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/files/video/swfobject.js"></script>
<script type="text/javascript">
	var s1 = new SWFObject("<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/files/video/player.swf","ply","100%","250","9","#FFFFFF");
	s1.addParam("allowscriptaccess","always");
	s1.addParam("allowfullscreen","true");
	s1.addParam("wmode", "opaque");
	s1.addParam("flashvars","file=<?php  echo $this->_tpl_vars['listing'][$this->_tpl_vars['field_id']]['file_url']; ?>
&image=<?php  echo ((is_array($_tmp=$this->_tpl_vars['listing'][$this->_tpl_vars['field_id']]['file_url'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/flv/", 'png') : smarty_modifier_regex_replace($_tmp, "/flv/", 'png')); ?>
&fullscreen=true");
	s1.write("videoContainer_<?php  echo $this->_tpl_vars['field_id']; ?>
");
</script>