<?php  /* Smarty version 2.6.14, created on 2015-05-19 14:17:37
         compiled from ../email_templates/apply_now.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/apply_now.tpl', 1, false),array('block', 'message', '../email_templates/apply_now.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Application to job posting #<?php  echo $this->_tpl_vars['listing']['id'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	You've got an application to job posting "<?php  echo $this->_tpl_vars['listing']['Title']; ?>
" from the following user:<br />
	Name: <?php  echo $this->_tpl_vars['seller_request']['name']; ?>
<br />
	Email: <?php  echo $this->_tpl_vars['seller_request']['email']; ?>
<br />
	Cover Letter (optional): <?php  echo $this->_tpl_vars['seller_request']['comments']; ?>
<br/>
	<?php  if ($this->_tpl_vars['questionnaire']): ?>---------------------------------------------------<br/>
	Screening Questionnaire "<?php  echo $this->_tpl_vars['questionnaireInfo']['name']; ?>
":<br/>
	<?php  $_from = $this->_tpl_vars['questionnaire']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['questionnaireLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['questionnaireLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['question'] => $this->_tpl_vars['answer']):
        $this->_foreach['questionnaireLoop']['iteration']++;
?>
	<?php  echo $this->_tpl_vars['question']; ?>
: <?php  if (is_array ( $this->_tpl_vars['answer'] )):   $_from = $this->_tpl_vars['answer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['answerLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['answerLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['answr']):
        $this->_foreach['answerLoop']['iteration']++;
  echo $this->_tpl_vars['answr'];   if (! ($this->_foreach['answerLoop']['iteration'] == $this->_foreach['answerLoop']['total'])): ?>,<?php  endif;   endforeach; endif; unset($_from);   else:   echo $this->_tpl_vars['answer'];   endif;   if (! ($this->_foreach['questionnaireLoop']['iteration'] == $this->_foreach['questionnaireLoop']['total'])): ?><br/><?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?><br/>
	Score: <?php  echo $this->_tpl_vars['score']; ?>
 (<?php  echo $this->_tpl_vars['questionnaireInfo']['passing_score']; ?>
)
	<br/><?php  endif; ?>
	<?php  if ($this->_tpl_vars['data_resume']): ?>User resume: <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['data_resume']['sid']; ?>
/"><?php  echo $this->_tpl_vars['data_resume']['Title']; ?>
</a><br/><?php  endif; ?>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>