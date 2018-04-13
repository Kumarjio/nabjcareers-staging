<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:55:15
         compiled from input_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'input_form.tpl', 4, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<?php  if ($this->_tpl_vars['nextPage'] || $this->_tpl_vars['prevPage']): ?>
<?php  $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['page_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['page_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page']):
        $this->_foreach['page_block']['iteration']++;
?>
	<div style="float:left;"><?php  if ($this->_tpl_vars['page']['sid'] == $this->_tpl_vars['pageSID']): ?><b><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['page']['page_name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b><?php  else:   if ($this->_tpl_vars['page']['order'] <= $this->_tpl_vars['currentPage']['order']): ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/<?php  echo $this->_tpl_vars['listing_type_id']; ?>
/<?php  echo $this->_tpl_vars['page']['page_id']; ?>
/<?php  echo $this->_tpl_vars['listingSID']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['page']['page_name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  else:   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['page']['page_name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   endif;   endif;   if (! ($this->_foreach['page_block']['iteration'] == $this->_foreach['page_block']['total'])): ?> -&gt; <?php  endif; ?>&nbsp;</div>
<?php  endforeach; endif; unset($_from); ?>
<?php  endif; ?>
<div class="clr"></div>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['currentPage']['page_name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<div><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['currentPage']['description'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
<?php  if ($this->_tpl_vars['socialAutoFillData']['allow']): ?>
<div id="social_autoFill" class="<?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
_16">
	<?php  if ($this->_tpl_vars['socialAutoFillData']['logged']): ?>
	<?php  if ($this->_tpl_vars['currentPage'] && $this->_tpl_vars['listing_sid']): ?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/<?php  echo $this->_tpl_vars['listing_type_id']; ?>
/<?php  echo $this->_tpl_vars['currentPage']['page_id']; ?>
/<?php  echo $this->_tpl_vars['listing_sid']; ?>
/?autofill" title=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Auto-fill resume from my <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<?php  else: ?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=<?php  echo $this->_tpl_vars['listing_type_id']; ?>
&amp;listing_package_id=<?php  echo $this->_tpl_vars['listing_package_id']; ?>
_<?php  echo $this->_tpl_vars['contract_id']; ?>
&amp;autofill" title=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Auto-fill resume from my <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<?php  endif; ?>
	<?php  else: ?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/social/?network=<?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login with Linkedin to Auto-fill resume from my <?php  echo $this->_tpl_vars['socialAutoFillData']['network']; ?>
 profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	<?php  endif; ?>
</div>
<?php  endif; ?>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fields marked with an asterisk (<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><font color="red">*</font><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>) are mandatory<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/<?php  echo $this->_tpl_vars['listing_type_id']; ?>
/<?php  echo $this->_tpl_vars['currentPage']['page_id']; ?>
/<?php  echo $this->_tpl_vars['listingSID']; ?>
" enctype="multipart/form-data" <?php  if ($this->_tpl_vars['form_fields']['ApplicationSettings']): ?>onsubmit="return validateForm('addListingForm');"<?php  endif; ?> id="addListingForm" class="inputForm">
<input type="hidden" name="listing_package_id" value="<?php  echo $this->_tpl_vars['listing_package_id']; ?>
_<?php  echo $this->_tpl_vars['contract_id']; ?>
" />
<input type="hidden" id="listing_package_sid" value="<?php  echo $this->_tpl_vars['listing_package_id']; ?>
" />

<input type="hidden" name="listing_type_id" value="<?php  echo $this->_tpl_vars['listing_type_id']; ?>
" />
<input type="hidden" id="listing_id" name="listing_id" value="<?php  echo $this->_tpl_vars['listing_id']; ?>
" />



<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "input_form_default.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<?php  if ($this->_tpl_vars['pic_limit'] > 0 && ! $this->_tpl_vars['prevPage'] && ! $this->_tpl_vars['listing_sid']): ?>
<br />
	<fieldset>
		<div class="inputName"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Pictures<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> </div>
		<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none;">
				<img class="progBarImg" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</div>
			<div id="UploadPics" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_package_id=<?php  echo $this->_tpl_vars['listing_package_id']; ?>
&listing_sid=<?php  echo $this->_tpl_vars['listing_id']; ?>
">
			</div>
			<br /><br />
		</div>	
	</fieldset>
<?php  elseif ($this->_tpl_vars['pic_limit'] > 0 && ! $this->_tpl_vars['prevPage'] && $this->_tpl_vars['listing_sid']): ?>
<br />
	<fieldset>
		<div class="inputName"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Pictures<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> </div>
		<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none;">
				<img class="progBarImg" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</div>
			
			<div id="UploadPics" value="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/manage-pictures/?listing_sid=<?php  echo $this->_tpl_vars['listing_sid']; ?>
">
			</div>
			<br /><br />
		</div>			
	</fieldset>
<?php  endif; ?>
<?php  $this->assign('addListingPackageChoiceTpl', true); ?>
<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'JobSeeker'):   else:   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listing_package_choice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>


<fieldset><br /><br />
	<div class="inputName">&nbsp;</div>
	<div class="inputReq">&nbsp;</div>
	<?php  if ($this->_tpl_vars['listing_type_id'] == 'Job'): ?>
		
		
				<div id="inactiveSubmitListingButton" class="inputField">

		<a class="button">Submit</a> 
		</div>
		<div id="submitlistingbutton" class="inputField">
			<?php  if ($this->_tpl_vars['prevPage']): ?><input type="button" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="window.location = '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/<?php  echo $this->_tpl_vars['listing_type_id']; ?>
/<?php  echo $this->_tpl_vars['prevPage']; ?>
/<?php  echo $this->_tpl_vars['listingSID']; ?>
'" />&nbsp;&nbsp;&nbsp;<?php  endif; ?>

			<?php  if ($this->_tpl_vars['nextPage']): ?>
		    <input type="submit" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
		<?php  else: ?>
            <input id="submitlistingbutton"  type="submit" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
		<?php  endif; ?>
		</div>
                <?php  else: ?>
		<div class="inputField"><?php  if ($this->_tpl_vars['prevPage']): ?><input type="button" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="window.location = '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/<?php  echo $this->_tpl_vars['listing_type_id']; ?>
/<?php  echo $this->_tpl_vars['prevPage']; ?>
/<?php  echo $this->_tpl_vars['listingSID']; ?>
'" />&nbsp;&nbsp;&nbsp;<?php  endif; ?>
<?php  if ($this->_tpl_vars['nextPage']): ?>
		    <input type="submit" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
		<?php  else: ?>
            <input type="submit" name="action_add" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
		<?php  endif; ?>

<?php  endif; ?>
</fieldset>
</form>




<?php  echo '
<script language="JavaScript" type="text/javascript">

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
		    $(this).addClass("uploadProgress");

		})
		$("#loading").ajaxComplete(function (){
			$("#UploadPics").css({"opacity" : "1"});
		    $(this).removeClass("uploadProgress");
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


//  customisation 02/10/2011 by Eldar	
	// hide submitlisting button
	document.getElementById("submitlistingbutton").style.visibility="hidden";
	
	';   if ($this->_tpl_vars['package']['id'] == 59):   echo '
		var planChosen = false;
	'; ?>

	<?php  endif;   echo '
	var companyName_elems = document.getElementsByName("CompanyName");
	companyName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var titleName_elems = document.getElementsByName("Title");
	titleName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var category_elems = document.getElementsByName("JobCategory[]");
	category_elems[0].setAttribute("onChange","planSelectionCheck();");

	var application_elems = document.getElementsByName("ApplicationSettings[add_parameter]");
	application_elems[0].setAttribute("onChange","planSelectionCheck();");
		
	function isEmpty(str) {
		   for (var i = 0; i < str.length; i++)
		      if (" " != str.charAt(i))
		          return false;
		      return true;
		}

	function planSelectionCheck() {
		var obj_title = document.getElementsByName("Title");
		var obj_category = document.getElementsByName("JobCategory[]"); 
		var obj_CompanyName = document.getElementsByName("CompanyName");
		var obj_application = document.getElementsByName("ApplicationSettings[add_parameter]"); 
						
		// if required fields are filled - display Submit button 
		if (!isEmpty(obj_title[0].value) && obj_category[0].value && obj_application[0].value && !isEmpty(obj_CompanyName[0].value) && planChosen) {
			document.getElementById("inactiveSubmitListingButton").style.display="none";
			document.getElementById("submitlistingbutton").style.visibility="visible";	
		}
	}
	
	
	'; ?>

	
		<?php  if ($this->_tpl_vars['package']['id'] != 59): ?>
		<?php  echo '
			document.getElementById("inactiveSubmitListingButton").style.display="none";
			document.getElementById("submitlistingbutton").style.visibility="visible";	
			document.getElementById("plans_containers").style.display="none";
		'; ?>

	<?php  endif; ?>
	<?php  echo '
		
// END OF customisation 02/10/2011 by Eldar
	
</script>
'; ?>