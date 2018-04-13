<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:45
         compiled from browseCompany.tpl */ ?>
<?php  if ($this->_tpl_vars['GLOBALS']['user_page_uri'] != "/browse-by-company-admin/"): ?>
	<?php  $_from = $this->_tpl_vars['alphabets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['alphabet'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['alphabet']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['alphabet']):
        $this->_foreach['alphabet']['iteration']++;
?>  
	<div>
		<div class="browseCompanyAB">
			<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company/?first_char=any_char">#</a>
		</div>
		<?php  $_from = $this->_tpl_vars['alphabet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['char'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['char']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['char']):
        $this->_foreach['char']['iteration']++;
?>  
		<div class="browseCompanyAB">
			<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company/?first_char=<?php  echo $this->_tpl_vars['char']; ?>
"><?php  echo $this->_tpl_vars['char']; ?>
</a>
		</div>
		<?php  endforeach; endif; unset($_from); ?>
		<div class="clr"></div>
	</div>
	<?php  endforeach; endif; unset($_from); ?>
	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "searchFormByCompany.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  else: ?>
	<b>Browse Company Name:</b>
	<?php  $_from = $this->_tpl_vars['alphabets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['alphabet'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['alphabet']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['alphabet']):
        $this->_foreach['alphabet']['iteration']++;
?>  
		<div>
			<div class="browseCompanyAB">
				<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company-admin/?first_char=any_char">#</a>
			</div>
			<?php  $_from = $this->_tpl_vars['alphabet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['char'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['char']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['char']):
        $this->_foreach['char']['iteration']++;
?>  
			<div class="browseCompanyAB">
				<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company-admin/?first_char=<?php  echo $this->_tpl_vars['char']; ?>
"><?php  echo $this->_tpl_vars['char']; ?>
</a>
			</div>
			<?php  endforeach; endif; unset($_from); ?>
			<div class="clr"></div>
		</div>
	<?php  endforeach; endif; unset($_from); ?>
<?php  endif; ?>