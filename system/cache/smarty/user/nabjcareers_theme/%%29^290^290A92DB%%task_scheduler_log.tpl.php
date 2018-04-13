<?php  /* Smarty version 2.6.14, created on 2018-03-04 23:58:18
         compiled from task_scheduler_log.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'task_scheduler_log.tpl', 1, false),)), $this); ?>
*****	<?php  echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
	*****

Expired Listings: <?php  $_from = $this->_tpl_vars['expired_listings_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['expired_listings'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['expired_listings']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['listing_id']):
        $this->_foreach['expired_listings']['iteration']++;
  echo $this->_tpl_vars['listing_id'];   if ($this->_foreach['expired_listings']['iteration'] < $this->_foreach['expired_listings']['total']): ?>, <?php  endif;   endforeach; else: ?>none<?php  endif; unset($_from); ?>


Expired Contracts: <?php  $_from = $this->_tpl_vars['expired_contracts_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['expired_contracts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['expired_contracts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['contract_id']):
        $this->_foreach['expired_contracts']['iteration']++;
  echo $this->_tpl_vars['contract_id'];   if ($this->_foreach['expired_contracts']['iteration'] < $this->_foreach['expired_contracts']['total']): ?>, <?php  endif;   endforeach; else: ?>none<?php  endif; unset($_from); ?>


Notified Saved Searches: <?php  $_from = $this->_tpl_vars['notified_saved_searches_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['searches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['searches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['search_id']):
        $this->_foreach['searches']['iteration']++;
  echo $this->_tpl_vars['search_id'];   if ($this->_foreach['searches']['iteration'] < $this->_foreach['searches']['total']): ?>, <?php  endif;   endforeach; else: ?>none<?php  endif; unset($_from); ?>


Activated jobs : <?php  $_from = $this->_tpl_vars['activated_listings_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activated_listings'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['activated_listings']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['activated_listing_id']):
        $this->_foreach['activated_listings']['iteration']++;
  echo $this->_tpl_vars['activated_listing_id'];   if ($this->_foreach['activated_listings']['iteration'] < $this->_foreach['activated_listings']['total']): ?>, <?php  endif;   endforeach; else: ?>none<?php  endif; unset($_from); ?>

***********   ***************