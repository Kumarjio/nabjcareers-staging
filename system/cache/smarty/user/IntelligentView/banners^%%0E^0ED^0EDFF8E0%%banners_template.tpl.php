<?php  /* Smarty version 2.6.14, created on 2014-10-26 01:31:45
         compiled from banners_template.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'banners_template.tpl', 2, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['current_banners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['current_banner']):
?>
	<?php  if (((is_array($_tmp=$this->_tpl_vars['GLOBALS']['settings']['task_scheduler_last_executed_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) > $this->_tpl_vars['current_banner']['start_date'] && ((is_array($_tmp=$this->_tpl_vars['GLOBALS']['settings']['task_scheduler_last_executed_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")) < $this->_tpl_vars['current_banner']['end_date']): ?>
		<?php  if ($this->_tpl_vars['current_banner']['type'] == 'application/x-shockwave-flash'): ?>
		
			<div style="width: 100%; text-align: center;">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" ID="banner"" WIDTH="<?php  echo $this->_tpl_vars['current_banner']['width']; ?>
" HEIGHT="<?php  echo $this->_tpl_vars['current_banner']['height']; ?>
">
				<param name="movie" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['current_banner']['image_path']; ?>
">
				<param name="quality" value="high">
				<param name="loop" value="false">
				<param name="banner_link" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/go-link/?bannerId=<?php  echo $this->_tpl_vars['current_banner']['id']; ?>
">
				<embed src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['current_banner']['image_path']; ?>
" loop="false" quality="high" WIDTH="<?php  echo $this->_tpl_vars['current_banner']['width']; ?>
" HEIGHT="<?php  echo $this->_tpl_vars['current_banner']['height']; ?>
" TYPE="application/x-shockwave-flash"  PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
				</embed>
				</object>
			</div>
		
		<?php  else: ?>
			<div class="banner">
				<?php  if ($this->_tpl_vars['current_banner']['bannerType'] == 'file'): ?>
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/go-link/?bannerId=<?php  echo $this->_tpl_vars['current_banner']['id']; ?>
" target="<?php  echo $this->_tpl_vars['current_banner']['openBannerIn']; ?>
">
					<img src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['current_banner']['image_path']; ?>
" width="<?php  echo $this->_tpl_vars['current_banner']['width']; ?>
" height="<?php  echo $this->_tpl_vars['current_banner']['height']; ?>
" title="<?php  echo $this->_tpl_vars['current_banner']['title']; ?>
" border="0"/>
				</a>
				<?php  else: ?>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/go-link/?bannerId=<?php  echo $this->_tpl_vars['current_banner']['id']; ?>
" target="<?php  echo $this->_tpl_vars['current_banner']['openBannerIn']; ?>
">
						<?php  echo $this->_tpl_vars['current_banner']['code']; ?>

					</a>
				<?php  endif; ?>
			</div><br>
		<?php  endif; ?>
	<?php  endif; ?>	
<?php  endforeach; endif; unset($_from); ?>