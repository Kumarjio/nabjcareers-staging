<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:15:58
         compiled from featured_profiles.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'featured_profiles.tpl', 6, false),array('modifier', 'escape', 'featured_profiles.tpl', 6, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['profiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['profile_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['profile_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['profile']):
        $this->_foreach['profile_block']['iteration']++;
?>
	<div class="FeaturedCompaniesLogo">
		<?php  if (strpos ( $this->_tpl_vars['profile']['CompanyName'] , '-' ) !== false): ?>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-results-jobs/?action=search&amp;username[equal]=<?php  echo $this->_tpl_vars['profile']['id']; ?>
"><img src="<?php  echo $this->_tpl_vars['profile']['Logo']['thumb_file_url']; ?>
" alt="<?php  echo $this->_tpl_vars['profile']['WebSite']; ?>
" border="0" /></a>
		<?php  else: ?>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/company/<?php  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['profile']['CompanyName'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', "-") : smarty_modifier_replace($_tmp, ' ', "-")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="<?php  echo $this->_tpl_vars['profile']['Logo']['thumb_file_url']; ?>
" border="0" alt="<?php  echo $this->_tpl_vars['profile']['WebSite']; ?>
"/></a>
		<?php  endif; ?>
	</div>
	<?php  if (!($this->_foreach['profile_block']['iteration'] % $this->_tpl_vars['number_of_cols'])): ?>
		<div class="clr"></div>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>