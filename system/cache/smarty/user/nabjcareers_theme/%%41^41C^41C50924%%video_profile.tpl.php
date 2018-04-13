<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:56:53
         compiled from ../field_types/input/video_profile.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', '../field_types/input/video_profile.tpl', 10, false),array('block', 'tr', '../field_types/input/video_profile.tpl', 15, false),)), $this); ?>
<?php  if ($this->_tpl_vars['value']['file_url']): ?>
	<div id="container"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
	<script type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/files/video/swfobject.js"></script>
	<div>
        <script type="text/javascript">
            var s1 = new SWFObject("<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/files/video/player.swf","ply","250","250","9","#FFFFFF");
            s1.addParam("allowscriptaccess","always");
            s1.addParam("allowfullscreen","true");
            s1.addParam("wmode", "opaque");
            s1.addParam("flashvars","file=<?php  echo $this->_tpl_vars['value']['file_url']; ?>
&image=<?php  echo ((is_array($_tmp=$this->_tpl_vars['value']['file_url'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/flv/", 'png') : smarty_modifier_regex_replace($_tmp, "/flv/", 'png')); ?>
&fullscreen=true");
            s1.write("container");
        </script>
        <br />
        |
        <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/delete-uploaded-file/?field_id=<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
	<br />
<?php  endif; ?>
<input type="file" class="inputVideo" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" />