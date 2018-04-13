<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:35:40
         compiled from admin_left_menu.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'admin_left_menu.tpl', 39, false),array('modifier', 'replace', 'admin_left_menu.tpl', 99, false),)), $this); ?>
<script language="JavaScript" type="text/javascript">
<?php  echo '
function trim(str)
{
	while(str.substring(0,1) == " ")
	    str = str.substring(1,str.length);
	while(str.substring(str.length,1) == " ")
	    str = str.substr(0,str.length - 1);
	return str;
}

function get_cookie(rname)
{
	var tmp = "" + document.cookie;
	var newcookie = "";
	var result = "";
	while(tmp.length)
	{
	    splitter = tmp.indexOf(";");
	    if(splitter < 0)
	            splitter = tmp.length + 1;
	    subject = tmp.substring(0, splitter);
	    if(unescape(trim(subject.substring(0,subject.indexOf(\'=\')))) == rname)
	            result = subject.substring(subject.indexOf(\'=\')+1,subject.length);
	    tmp = tmp.substring(splitter + 1, tmp.length);
	}
	return result;
}

function set_cookie(name, value)
{
	document.cookie = escape(name) + "=" + escape(value) + "; path=/;";
}

function Show(cur_id)
{
	set_cookie(cur_id,\'v\');
	document.getElementById(\'v\'+cur_id).style.display = \'block\';
	document.getElementById(\'s\'+cur_id).innerHTML = "<img src=\'';   echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
menu_opened.png<?php  echo '\' style=\'margin-top:13px; margin-left:10px;\' border=\'0\' alt=\'\'/>&nbsp;";
	document.getElementById(\'ImgId\'+cur_id).className = "leftMenuOpen";
}
	
function highlight_menu_title(title_id) 
{
	document.getElementById(title_id).style.color = \'#fffff\';//\'#CA1641\';
}

function Hide(cur_id)
{
	set_cookie(cur_id,\'h\');
	document.getElementById(\'v\'+cur_id).style.display = \'none\';
	document.getElementById(\'s\'+cur_id).innerHTML = "<img src=\'';   echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
menu_closed.png<?php  echo '\' style=\'margin-top:13px\' border=\'0\' alt=\'\'/>&nbsp;";
	document.getElementById(\'ImgId\'+cur_id).className = "leftMenu";
}

function ShowHide(cur_id, obj)
{
	if(document.getElementById(\'v\'+cur_id).style.display != \'none\') {
	    Hide(cur_id);
	    $(obj).removeClass(\'leftMenuOpen\');
		$(obj).addClass(\'leftMenu\');
	}	else {
		Show(cur_id);
		$(obj).removeClass(\'leftMenu\');
		$(obj).addClass(\'leftMenuOpen\');
	}
}

function Restore(cur_id, hide_def)
{
	if(get_cookie(cur_id)==\'h\')
	    Hide(cur_id);
	else
	if(get_cookie(cur_id)==\'v\')
	    Show(cur_id);
	else
	{
	    if(hide_def)
	            Hide(cur_id);
	    else
	            Show(cur_id);
	}
}
'; ?>


</script>

<?php  $_from = $this->_tpl_vars['left_admin_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['section'] => $this->_tpl_vars['section_items']):
        $this->_foreach['menu_block']['iteration']++;
?>
	<div onclick="ShowHide('<?php  echo $this->_tpl_vars['section_items']['id']; ?>
', this)" id="ImgId<?php  echo $this->_tpl_vars['section_items']['id']; ?>
" class="leftMenu">
		<span id="st<?php  echo $this->_tpl_vars['section_items']['id']; ?>
" class="menuName"><span class="borders"><?php  echo $this->_tpl_vars['section']; ?>
</span></span>
		<span id="s<?php  echo $this->_tpl_vars['section_items']['id']; ?>
" class="menuArrow"></span>
	</div>
	
	<div id="v<?php  echo $this->_tpl_vars['section_items']['id']; ?>
">
	  <div class="menuItems">
			<?php  $_from = $this->_tpl_vars['section_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<?php  if (! $this->_tpl_vars['item']['id']): ?>
                    <?php  $this->assign('div_id', $this->_tpl_vars['item']['title']); ?>
					<?php  if ($this->_tpl_vars['item']['title'] != ""): ?><div class="<?php  if ($this->_tpl_vars['item']['active']): ?>lmsih<?php  else: ?>lmsi<?php  endif; ?>" id="<?php  echo ((is_array($_tmp=$this->_tpl_vars['div_id'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '_') : smarty_modifier_replace($_tmp, ' ', '_')); ?>
"><a href="<?php  echo $this->_tpl_vars['item']['reference']; ?>
"><?php  echo $this->_tpl_vars['item']['title']; ?>
</a></div><?php  endif; ?>
				<?php  endif; ?>
			<?php  endforeach; endif; unset($_from); ?>

			<?php  if ($this->_tpl_vars['section_items']['id'] == 'Users'): ?>
					<div class="lmsi"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/resume-plans/">Resume plans</a></div>
					<div class="lmsi"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/job_fairs/?field_sid=334">Manage Job fairs</a></div>
			<?php  endif; ?>

			<?php  if ($this->_tpl_vars['section_items']['id'] == 'Payments'): ?>
					<div class="lmsi"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/payments/">Invoice Log</a></div>
					<div class="lmsi"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/open_invoices">Open Invoices</a></div>
			<?php  endif; ?>
			
			<?php  if ($this->_tpl_vars['section_items']['id'] == 'Listing_Management'): ?>
					<div class="lmsi"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/deleted-listings/?action=search&listing_type%5Bequal%5D=Job&deleted%5Bequal%5D=1&sorting_field=username&sorting_order=ASC">Deleted jobs</a></div>
								<?php  endif; ?>
	  </div>
	</div>
	<?php  if ($this->_foreach['menu_block']['iteration'] != $this->_foreach['menu_block']['total']):   endif; ?>
	<script type="text/javascript">Restore('<?php  echo $this->_tpl_vars['section_items']['id']; ?>
',true);	</script>
	<?php  if ($this->_tpl_vars['section_items']['active']): ?><script type="text/javascript">Show('<?php  echo $this->_tpl_vars['section_items']['id']; ?>
')</script><?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>