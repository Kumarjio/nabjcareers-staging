<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:50
         compiled from ../field_types/input/file.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/file.tpl', 8, false),)), $this); ?>
<?php  if ($this->_tpl_vars['complexField'] && $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_name'] != null): ?>
	<div class="complex-view-file-caption">
		<?php  if ($this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['saved_file_name']): ?>
			<a href="?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;filename=<?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['saved_file_name']; ?>
"><?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_name']; ?>
</a>
		<?php  else: ?>
			<a href="<?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_url']; ?>
"><?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_name']; ?>
</a>
		<?php  endif; ?>
		| <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/delete-complex-file/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>

		<br/><br/>
    </div>
	<input type="hidden" id="hidden_<?php  echo $this->_tpl_vars['complexField']; ?>
_<?php  echo $this->_tpl_vars['id']; ?>
_<?php  echo $this->_tpl_vars['complexStep']; ?>
" name="<?php  echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]" value="<?php  echo $this->_tpl_vars['filesInfo'][$this->_tpl_vars['complexStep']]['file_id']; ?>
" class="complexField"/>
<?php  endif; ?>
<?php  if (! $this->_tpl_vars['complexField'] && $this->_tpl_vars['value']['file_name'] != null): ?>

	<?php  if ($this->_tpl_vars['form_field']['id'] == 'Resume'): ?><span style="color: orange;">Current uploaded resume : </span><?php  endif; ?>
    <?php  if ($this->_tpl_vars['value']['saved_file_name']): ?>
        <a href="?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;filename=<?php  echo $this->_tpl_vars['value']['saved_file_name']; ?>
"><?php  echo $this->_tpl_vars['value']['file_name']; ?>
</a>
    <?php  else: ?>
        <a href="<?php  echo $this->_tpl_vars['value']['file_url']; ?>
"><?php  echo $this->_tpl_vars['value']['file_name']; ?>
</a>
    <?php  endif; ?>
    <?php  if ($this->_tpl_vars['form_field']['id'] == 'Resume'): ?><br/><br/><span style="color: orange;">Click here to delete uploaded resume</span><?php  endif; ?>
    | <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/classifieds/delete-uploaded-file/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    <br/><br/>
<?php  endif; ?>
<?php  if ($this->_tpl_vars['form_field']['id'] == 'Resume' && $this->_tpl_vars['value']['file_name'] != null): ?>
<span style="color: orange;">or replace uploaded resume: </span>
<?php  endif; ?>
<input type="file" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" 
class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>"/>

<span style="color: orange;">(doc,docx, pdf files are accepted)</span>