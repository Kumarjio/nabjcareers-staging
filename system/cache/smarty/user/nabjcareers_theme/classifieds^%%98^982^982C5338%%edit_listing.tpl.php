<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:48:45
         compiled from edit_listing.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'edit_listing.tpl', 2, false),array('function', 'module', 'edit_listing.tpl', 15, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<?php  if ($this->_tpl_vars['errors']): ?>
	<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_id'] => $this->_tpl_vars['error_data']):
?>
		<?php  if ($this->_tpl_vars['error_id'] == 'MAX_FILE_SIZE_EXCEEDED'): ?>
			<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Max Filesize Exceed<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Max available size<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo $this->_tpl_vars['post_max_size']; ?>
</p>
		<?php  elseif ($this->_tpl_vars['error_id'] == 'NOT_OWNER_OF_LISTING'): ?>
			<?php  $this->assign('listing_id', $this->_tpl_vars['error_data']); ?>
			<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are not the owner of the listing #<?php  echo $this->_tpl_vars['listing_id'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  elseif ($this->_tpl_vars['error_id'] == 'NO_SUCH_FILE'): ?><p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No such file<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
		<?php  elseif ($this->_tpl_vars['error_id'] == 'NOT_LOGGED_IN'): ?>
			<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are not logged in<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please log in to edit this posting. If you do not have an account, please<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/registration/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<br/><br/>
			<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login'), $this);?>

		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
<?php  else: ?>
	
	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php  if ($this->_tpl_vars['form_is_submitted'] && ! $this->_tpl_vars['errors'] && ! $this->_tpl_vars['field_errors']): ?>
		<p class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your changes were successfully saved<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><strong><u>Back</u></strong></a></p> 
	<?php  endif; ?>
		<?php  if ($this->_tpl_vars['socialAutoFillData']['allow']): ?>
	<div id="social_autoFill" class="<?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
_16">
		<?php  if ($this->_tpl_vars['socialAutoFillData']['logged'] && $this->_tpl_vars['socialAutoFillData']['network']): ?>
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
&amp;autofill" title=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Auto-fill resume from my <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<?php  elseif ($this->_tpl_vars['socialAutoFillData']['network']): ?>
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/social/?network=<?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login with <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 to Auto-fill resume from my <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<?php  endif; ?>
	</div>
	<?php  endif; ?>
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fields marked with an asterisk (<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><font color="red">*</font><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>) are mandatory<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
	<form method="post" action="" enctype="multipart/form-data" <?php  if ($this->_tpl_vars['listing']['ApplicationSettings']): ?>onsubmit="return validateForm('editListingForm');"<?php  endif; ?> id="editListingForm" class="inputForm">
		<input type="hidden" name="action" value="save_info" />
		<input type="hidden" name="listing_id" id="listing_id" value="<?php  echo $this->_tpl_vars['listing']['id']; ?>
" />

		<?php  if ($this->_tpl_vars['acl']->isAllowed('add_featured_listings') && ! $this->_tpl_vars['listing']['featured'] && $this->_tpl_vars['listing']['active']): ?><br/><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/make-featured/?listing_id=<?php  echo $this->_tpl_vars['listing']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upgrade to Featured<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
		<?php  if ($this->_tpl_vars['display_preview']): ?>
			<?php  if ($this->_tpl_vars['listing']['type']['id'] == 'Job'): ?>
				<?php  $this->assign('link', 'my-job-details'); ?>
			<?php  elseif ($this->_tpl_vars['listing']['type']['id'] == 'Resume'): ?>
				<?php  $this->assign('link', 'my-resume-details'); ?>
			<?php  endif; ?>
			<br/><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/<?php  echo $this->_tpl_vars['link']; ?>
/<?php  echo $this->_tpl_vars['listing']['id']; ?>
/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Preview Listing<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<?php  endif; ?>
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
			
			<?php  if (($this->_foreach['editBlock']['iteration'] <= 1)): ?>
				<?php  if ($this->_tpl_vars['pic_limit'] > 0): ?>
					<fieldset>
						<div class="inputName"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Pictures<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> </div>
						<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
						<div class="inputField" style="width:70%">
							<div id="loading" style="display:none;">
								<img class="progBarImg" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							</div>
							<div id="UploadPics" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_sid=<?php  echo $this->_tpl_vars['listing']['id']; ?>
">
							</div>
							<br /><br />
						</div>			
					</fieldset>
				<?php  endif; ?>
			<?php  endif; ?>
			<?php  if (! ($this->_foreach['editBlock']['iteration'] == $this->_foreach['editBlock']['total'])): ?></div><?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
		
		
		</div>
		
		<?php  if ($this->_tpl_vars['listing']['active'] == 0 && $this->_tpl_vars['GLOBALS']['user_page_uri'] != "/edit-listing/" && $this->_tpl_vars['GLOBALS']['user_page_uri'] != "/edit-job-preview/"): ?>
			<?php  $this->assign('addListingPackageChoiceTpl', true); ?>
			<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listing_package_choice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php  endif; ?>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputReq">&nbsp;</div>		
			<div class="inputField"><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" /></div>
		
		</fieldset>
	</form>
<?php  endif; ?>

<script>
<?php  echo '

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

	$.ui.dialog.defaults.bgiframe = true;
	
	var progbar = "<img src=\'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif<?php  echo '\'>";
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

	var planChosen = false;
	
	var titleName_elems = document.getElementsByName("Title");
	titleName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var category_elems = document.getElementsByName("JobCategory");
	category_elems[0].setAttribute("onChange","planSelectionCheck();");
	
	function isEmpty(str) {
		   for (var i = 0; i < str.length; i++)
		      if (" " != str.charAt(i))
		          return false;
		      return true;
		}

	function planSelectionCheck() {
		var obj_title = document.getElementsByName("Title");
		var obj_category = document.getElementsByName("JobCategory"); 
	}

'; ?>


</script>