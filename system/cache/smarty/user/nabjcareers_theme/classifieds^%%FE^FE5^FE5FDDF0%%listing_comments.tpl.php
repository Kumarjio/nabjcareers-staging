<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:54:48
         compiled from listing_comments.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'listing_comments.tpl', 3, false),)), $this); ?>
<?php  if ($this->_tpl_vars['show_comments'] != 0): ?>
<div>
<div class="comment"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</div>
<a name="comment_1"></a><div class="comment_holder">
<?php  $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['each_comment'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['each_comment']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['comment']):
        $this->_foreach['each_comment']['iteration']++;
?>
<a name="comment_<?php  echo $this->_tpl_vars['comment']['id']; ?>
"></a>
<?php  $this->assign('iteration_last', $this->_foreach['each_comment']['iteration']); ?>	
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listing_comments_item.tpl", 'smarty_include_vars' => array('listing' => $this->_tpl_vars['listing'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  endforeach; endif; unset($_from); ?>
</div>
<script language="JavaScript" type="text/javascript">
id_form	= <?php  echo $this->_tpl_vars['iteration_last']+1; ?>
;
</script>
 	<div id="prop_form_box" ></div>
	<div id="ProgBar" style="display: none">
		<img style="vertical-align: middle;" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
	<br />	
	<div id="FormBar" >
	<?php  if ($this->_tpl_vars['user_logged_in']): ?>
	<div class="comment"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add your comment<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	<form method="post" action="" onsubmit="return false">
		<input type="hidden" name="listing_id" id="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
" />
		<input type="hidden" name="total" value="<?php  echo $this->_tpl_vars['comments_total']; ?>
" id="total" />
		<textarea name="message" id="message" cols="60" rows="3"></textarea><br/>
		<input type="button" id="but_send" name="send" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button"/>
	</form>
	<?php  else: ?>
	<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/login"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sign in<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>to add comments!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  endif; ?>
	</div>
</div>
<?php  echo '
<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
	var ajax_url = "';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/ajax/<?php  echo '";
	var listing_id = "';   echo $this->_tpl_vars['listing_id'];   echo '";
	$("#but_send").click(function(){
			var mess = $.trim($("#message").val());
			if (mess == "") alert("';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message empty!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '");
			else {
				$("#ProgBar").show();
				$.post(ajax_url, {action: "comment", listing: listing_id, message: mess}, function(data){
							if ($(".comment_item").size() > 0)
									$(".comment_item:last").after(data);
								else 
									$(".comment_holder").html(data);
					$("#message").val("");
					$("#ProgBar").hide();
					});
				}
		});
	
});

</script>
'; ?>

<?php  endif; ?>