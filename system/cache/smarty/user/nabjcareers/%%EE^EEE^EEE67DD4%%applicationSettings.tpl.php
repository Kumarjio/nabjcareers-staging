<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:55:15
         compiled from ../field_types/input/applicationSettings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/applicationSettings.tpl', 51, false),)), $this); ?>

<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
<?php  echo '
<script type="text/javascript"><!--

function displayInput(disableValue, disableId) {
/*	if (disableId != 0) {
		$("input[id^=\'ApplicationSettings\']").attr("disabled", "disabled");
		var appSettingsDiv = document.getElementById(disableId);
		$("input[id!=" + disableId + "][id^=\'ApplicationSettings\']").val(\'\');
		appSettingsDiv.disabled	= disableValue;
	} else {
		$("input[id^=\'ApplicationSettings\']").val(\'\');
		$("input[id^=\'ApplicationSettings\']").attr("disabled", "disabled");
	}
	*/
}

function emailChoosen() {
	$("#ApplicationSettings_2").attr("value", "");
	$("#ApplicationSettings_radio1").attr(\'checked\', true);
	$("#ApplicationSettings_1").attr(\'disabled\', false);
	$("#ApplicationSettings_2").attr(\'disabled\', "disabled");
}


function urlChoosen() {
	$("#ApplicationSettings_1").attr("value", "");
	$("#ApplicationSettings_radio2").attr(\'checked\', true);
	$("#ApplicationSettings_2").attr(\'disabled\', false);
	$("#ApplicationSettings_1").attr(\'disabled\', "disabled");
}


function validateForm(formName) {
	var form = document.getElementById(formName);
	var appSettingsRadio		= form.elements[\'';   echo $this->_tpl_vars['id'];   echo '[add_parameter]\'];
	var appSettingsEmailValue	= form.elements["';   echo $this->_tpl_vars['id'];   echo '_1"].value;
	var appSettingsWebValue		= form.elements["';   echo $this->_tpl_vars['id'];   echo '_2"].value;
	
	var radios_application = document.getElementsByName("ApplicationSettings[add_parameter]"); 
	
	for(var i = 0; i < appSettingsRadio.length; i++) {
		
		if($("#ApplyNowBtnChoice option:selected").val() == "Yes") {
					if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 1)
						var exp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\\.([a-zA-Z])+([a-zA-Z])+/;
						if( (appSettingsEmailValue != \'\') && !(appSettingsEmailValue.match(exp)) ) {
							error(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>"Application Settings" wrong Email format<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
							return false;
						}
						else if (appSettingsEmailValue == \'\' && appSettingsRadio[i].checked && appSettingsRadio[i].value == 1) {
							error(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>"Application Settings" empty Email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
							return false;
						}				
					else if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 2) {
								if(appSettingsWebValue == \'\') {
									error(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>"Application Settings" url is empty'<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo ');
									return false;
						//								} else if( !( appSettingsWebValue.match(/http:\\/\\//)) ) {
								} else if( !( appSettingsWebValue.match(/https?:\\/\\//)) ) {
									form.elements["';   echo $this->_tpl_vars['id'];   echo '_2"].value = \'http://\' + appSettingsWebValue;
									return true;
								}				
					}
					
					
					else if(!radios_application[0].checked && !radios_application[1].checked) {
							error(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose an "Application Settings" option'<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo ');
							return false;
					}
		}			 
		
	}
	return true;
}
function error(error_text) {
	$("#dialog").dialog( \'destroy\' ).html(error_text);
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		title: \'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\',
		buttons: {
			Ok: function() {
				$(this).dialog(\'close\');
			}
		}
	});
}

function getUrl(name) {
		var url = document.getElementById(name);
		if (url.value != \'\') {
			if (!(url.value.match(/https?:\\/\\//)) ) {
				url.value = \'http://\' + url.value;
			}
			window.open(url.value, "target");
		}
	}

--></script>
'; ?>



<?php  echo '
	<script type="text/javascript">

		$(document).ready(function(){
			var radios_application_opts = document.getElementsByName("ApplicationSettings[add_parameter]"); 
			var selectedValue= $("#ApplyNowBtnChoice option:selected").val();
	
			// initial show/hide
			if (selectedValue == "Yes" ) {
				 $("#ApplicationSettingsWarning").css("display", "none");
				 $("#ApplicationSettingsFieldset").css("display", "block");
				 
				 /* empty values after form resave- fix - 01 june 2014 					 
				if($listing.ApplicationSettings.add_parameter==1) {
					 emailChoosen();
				}
				else if ($listing.ApplicationSettings.add_parameter==2) { 
					 urlChoosen();  	
					} 	 
				 // END 01-june 2014 /
				 */
			}
			else if (selectedValue == "No" ) {
				 $("#ApplicationSettingsWarning").css("display", "block");
				 $("#ApplicationSettingsFieldset").css("display", "none");

			}
			
			else {
				$("#ApplicationSettingsWarning").css("display", "none");
				$("#ApplicationSettingsFieldset").css("display", "none");
			}
			
			$("#ApplyNowBtnChoice").bind("change", function (event) {	
				if ( $("#ApplyNowBtnChoice option:selected").val() == "Yes" ) {
					$("#ApplicationSettingsWarning").css({\'display\':\'none\'});
					$("#ApplicationSettingsFieldset").css({\'display\':\'block\'});
				}
				else if ( $("#ApplyNowBtnChoice option:selected").val() == "No" ) {
					$("#ApplicationSettingsWarning").css({\'display\':\'block\'});
					$("#ApplicationSettingsFieldset").css({\'display\':\'none\'});
					
					$("#ApplicationSettings_2").attr("value", "");
					$("#ApplicationSettings_radio1").attr(\'checked\', false);
					$("#ApplicationSettings_1").attr("value", "");
					$("#ApplicationSettings_radio2").attr(\'checked\', false);

				}				
				else {
					$("#ApplicationSettingsWarning").css({\'display\':\'none\'});
					$("#ApplicationSettingsFieldset").css({\'display\':\'none\'});
				}		
			});	
						
			// check fields
			var applSetVal1 = $("#ApplicationSettings_1").val();
			var applSetVal2 = $("#ApplicationSettings_2").val();
			
	
			if (applSetVal1 =="" && applSetVal2 =="" ) {
 				// clear radios
 				$(".ApplicationSettingsRadio").attr(\'checked\', false);
			}	
		});
	</script>
'; ?>


<div id="dialog"></div>
<table>
	<tr>
		<td colspan="2"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send applications online via web site<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	</tr>
	<tr>
		<td valign="top">
			<input id="<?php  echo $this->_tpl_vars['id']; ?>
_radio1" class="<?php  echo $this->_tpl_vars['id']; ?>
Radio inputRadio <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" 
			name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField'];   echo $this->_tpl_vars['id']; ?>
[add_parameter][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id']; ?>
[add_parameter]<?php  endif; ?>" 
			value="1" <?php  if ($this->_tpl_vars['value']['add_parameter'] == 1 || $this->_tpl_vars['value']['add_parameter'] == ''): ?>checked="checked"<?php  endif; ?> 
			onclick="emailChoosen(); displayInput(false, '<?php  echo $this->_tpl_vars['id']; ?>
_1');" onfocus="emailChoosen(); displayInput(false, '<?php  echo $this->_tpl_vars['id']; ?>
_1');"  type="radio" />&nbsp;<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send applications to this e-mail<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
		<td>
			<input value="<?php  if ($this->_tpl_vars['value']['add_parameter'] == 1):   echo $this->_tpl_vars['value']['value'];   endif; ?>" 
			class="inputString" style='width:250px;' name="<?php  echo $this->_tpl_vars['id']; ?>
[value]" 
			<?php  if ($this->_tpl_vars['value']['add_parameter'] == 2): ?>disabled="disabled"<?php  endif; ?> id="<?php  echo $this->_tpl_vars['id']; ?>
_1" 
			type="text" onclick="emailChoosen();" onfocus="emailChoosen();" /></td>
	</tr>
	<tr>
		<td valign="top">
		<input id="<?php  echo $this->_tpl_vars['id']; ?>
_radio2" class="inputRadio <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" 
		name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
[add_parameter][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id']; ?>
[add_parameter]<?php  endif; ?>" 
		value="2" <?php  if ($this->_tpl_vars['value']['add_parameter'] == 2): ?>checked="checked"<?php  endif; ?> 
		onfocus="urlChoosen(); displayInput(false, '<?php  echo $this->_tpl_vars['id']; ?>
_2');"  onclick="urlChoosen(); displayInput(false, '<?php  echo $this->_tpl_vars['id']; ?>
_2');" type="radio" /><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Redirect to this URL<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
		<td>
			<input value="<?php  if ($this->_tpl_vars['value']['add_parameter'] == 2):   echo $this->_tpl_vars['value']['value'];   endif; ?>" 
			class="inputString <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" 
			style='width:250px;' 
			name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][value]<?php  else:   echo $this->_tpl_vars['id']; ?>
[value]<?php  endif; ?>" 
			id="<?php  echo $this->_tpl_vars['id']; ?>
_2" <?php  if ($this->_tpl_vars['value']['add_parameter'] != 2): ?>disabled="disabled"<?php  endif; ?> 
			type="text" onclick="urlChoosen();"  />
			<input type="button" name="browse" value="Test URL" onclick="getUrl('<?php  echo $this->_tpl_vars['id']; ?>
_2')" />
			<br />
			<span style="font-size:11px"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use the following format:<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <i><b>http://</b>yoursite.com</i></span>
		</td>
	</tr>
</table>