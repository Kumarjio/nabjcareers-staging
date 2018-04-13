<?php  /* Smarty version 2.6.14, created on 2018-03-04 12:45:14
         compiled from copy_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'copy_listing.tpl', 2, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clone Job<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
	<?php  if ($this->_tpl_vars['errors']): ?>
		<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_id'] => $this->_tpl_vars['error_data']):
?>	
			<?php  if ($this->_tpl_vars['error_id'] == 'NOT_OWNER_OF_LISTING'): ?>
				<?php  $this->assign('listing_id', $this->_tpl_vars['error_data']); ?>
				<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are not the owner of the listing #$listing_id<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  else: ?>

	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fields marked with an asterisk (<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><font color="red">*</font><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>) are mandatory<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>

	<form method="post" action="" enctype="multipart/form-data" <?php  if ($this->_tpl_vars['form_fields']['ApplicationSettings']): ?>onsubmit="return validateForm('copyListingForm');"<?php  endif; ?> id='copyListingForm'>
	<input type="hidden" name="action" value="save_info" />
	<input type="hidden" name="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
" />
	<input type="hidden" name="listing_package_id" value="<?php  echo $this->_tpl_vars['listing_package_id']; ?>
_<?php  echo $this->_tpl_vars['contract_id']; ?>
" />
	<input type="hidden" id="listing_package_sid" value="<?php  echo $this->_tpl_vars['listing_package_id']; ?>
" />
	<input type="hidden" id="tmp_listing_id" name="tmp_listing_id" value="<?php  echo $this->_tpl_vars['tmp_listing_id']; ?>
" />
	<?php  $this->assign('package', $this->_tpl_vars['listing']['package']); ?>
	<?php  $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['editBlock'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['editBlock']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page'] => $this->_tpl_vars['form_fields']):
        $this->_foreach['editBlock']['iteration']++;
?>
		<?php  if ($this->_tpl_vars['countPages'] > 1): ?>
			<div class="page_button"><div class="page_icon">[+]</div><b><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['page'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></div>
			<div class="page_block" style="display: none">
		<?php  else: ?>
			<div>
		<?php  endif; ?>
			<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "input_form_default.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php  if (! ($this->_foreach['editBlock']['iteration'] == $this->_foreach['editBlock']['total'])): ?></div><?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>

	<?php  if ($this->_tpl_vars['pic_limit'] > 0): ?>
	<fieldset>
		<div class="inputName"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Pictures<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> </div>
		<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none; position: absolute;">
				<img class="progBarImg" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</div>
			<div id="UploadPics" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_package_id=<?php  echo $this->_tpl_vars['listing_package_id']; ?>
&listing_sid=<?php  echo $this->_tpl_vars['tmp_listing_id']; ?>
">
			</div>
			<br /><br />
		</div>			
	</fieldset>	
	<?php  endif; ?>
	</div>
	<table>
	<tr>
		<td>
			<input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />&nbsp
	    </td>
    </tr>
	</table>
	</form>
	<?php  endif; ?>

<?php  echo '
<script>

	$(document).ready(function() {
		url = $("#UploadPics").attr("value");
		$.ajax({ 
			url: url,
			beforeSend: function() {
				$("#loading").show();
				$("#UploadPics").hide();
		    },
			success: function(data){
		    	$("#loading").hide();
				$("#UploadPics").html(data);
				$("#UploadPics").show();				
	    }});

	    $("#loading").ajaxStart(function (){
		    $("#UploadPics").css({"opacity" : "0.3"});
		    $(this).show();
		})
		$("#loading").ajaxComplete(function (){
			$("#UploadPics").css({"opacity" : "1"});
		    $(this).hide();
		})
	});

	var progbar = "<img src=\'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif<?php  echo '\'>";
	$.ui.dialog.defaults.bgiframe = true;
	function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn) {
		$("#messageBox").dialog(\'destroy\');
		$("#messageBox").attr({title: "Loading"});
		$.get(url, function(data){
			$("#messageBox").dialog(\'destroy\').html(progbar);
			$("#messageBox").html(data).dialog({
				modal: true,
				title: title,
				width: 400,
				close: function(event, ui) {
				}
			});		  
		});
	}
	$(".page_button").click(function(){
		var butt = $(this);
		$(this).next(".page_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".page_icon").html("[-]");
				} else {
					butt.children(".page_icon").html("[+]");
				}
			});
	});
</script>
'; ?>