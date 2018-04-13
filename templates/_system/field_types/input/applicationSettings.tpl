
<link type="text/css" href="{$GLOBALS.user_site_url}/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
{literal}
<script type="text/javascript"><!--

function displayInput(disableValue, disableId) {
/*	if (disableId != 0) {
		$("input[id^='ApplicationSettings']").attr("disabled", "disabled");
		var appSettingsDiv = document.getElementById(disableId);
		$("input[id!=" + disableId + "][id^='ApplicationSettings']").val('');
		appSettingsDiv.disabled	= disableValue;
	} else {
		$("input[id^='ApplicationSettings']").val('');
		$("input[id^='ApplicationSettings']").attr("disabled", "disabled");
	}
	*/
}

function emailChoosen() {
	$("#ApplicationSettings_2").attr("value", "");
	$("#ApplicationSettings_radio1").attr('checked', true);
	$("#ApplicationSettings_1").attr('disabled', false);
	$("#ApplicationSettings_2").attr('disabled', "disabled");
}


function urlChoosen() {
	$("#ApplicationSettings_1").attr("value", "");
	$("#ApplicationSettings_radio2").attr('checked', true);
	$("#ApplicationSettings_2").attr('disabled', false);
	$("#ApplicationSettings_1").attr('disabled', "disabled");
}


function validateForm(formName) {
	var form = document.getElementById(formName);
	var appSettingsRadio		= form.elements['{/literal}{$id}{literal}[add_parameter]'];
	var appSettingsEmailValue	= form.elements["{/literal}{$id}{literal}_1"].value;
	var appSettingsWebValue		= form.elements["{/literal}{$id}{literal}_2"].value;
	
	var radios_application = document.getElementsByName("ApplicationSettings[add_parameter]"); 
	
	for(var i = 0; i < appSettingsRadio.length; i++) {
		
		if($("#ApplyNowBtnChoice option:selected").val() == "Yes") {
					if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 1)
						var exp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
						if( (appSettingsEmailValue != '') && !(appSettingsEmailValue.match(exp)) ) {
							error('{/literal}[["Application Settings" wrong Email format]]{literal}');
							return false;
						}
						else if (appSettingsEmailValue == '' && appSettingsRadio[i].checked && appSettingsRadio[i].value == 1) {
							error('{/literal}[["Application Settings" empty Email]]{literal}');
							return false;
						}				
					else if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 2) {
								if(appSettingsWebValue == '') {
									error('{/literal}[["Application Settings" url is empty']]{literal});
									return false;
						//								} else if( !( appSettingsWebValue.match(/http:\/\//)) ) {
								} else if( !( appSettingsWebValue.match(/https?:\/\//)) ) {
									form.elements["{/literal}{$id}{literal}_2"].value = 'http://' + appSettingsWebValue;
									return true;
								}				
					}
					
					
					else if(!radios_application[0].checked && !radios_application[1].checked) {
							error('{/literal}[[Choose an "Application Settings" option']]{literal});
							return false;
					}
		}			 
		
	}
	return true;
}
function error(error_text) {
	$("#dialog").dialog( 'destroy' ).html(error_text);
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		title: '{/literal}[[Error]]{literal}',
		buttons: {
			Ok: function() {
				$(this).dialog('close');
			}
		}
	});
}

function getUrl(name) {
		var url = document.getElementById(name);
		if (url.value != '') {
			if (!(url.value.match(/https?:\/\//)) ) {
				url.value = 'http://' + url.value;
			}
			window.open(url.value, "target");
		}
	}

--></script>
{/literal}


{literal}
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
					$("#ApplicationSettingsWarning").css({'display':'none'});
					$("#ApplicationSettingsFieldset").css({'display':'block'});
				}
				else if ( $("#ApplyNowBtnChoice option:selected").val() == "No" ) {
					$("#ApplicationSettingsWarning").css({'display':'block'});
					$("#ApplicationSettingsFieldset").css({'display':'none'});
					
					$("#ApplicationSettings_2").attr("value", "");
					$("#ApplicationSettings_radio1").attr('checked', false);
					$("#ApplicationSettings_1").attr("value", "");
					$("#ApplicationSettings_radio2").attr('checked', false);

				}				
				else {
					$("#ApplicationSettingsWarning").css({'display':'none'});
					$("#ApplicationSettingsFieldset").css({'display':'none'});
				}		
			});	
						
			// check fields
			var applSetVal1 = $("#ApplicationSettings_1").val();
			var applSetVal2 = $("#ApplicationSettings_2").val();
			
	
			if (applSetVal1 =="" && applSetVal2 =="" ) {
 				// clear radios
 				$(".ApplicationSettingsRadio").attr('checked', false);
			}	
		});
	</script>
{/literal}

<div id="dialog"></div>
<table>
	<tr>
		<td colspan="2">[[Send applications online via web site]]</td>
	</tr>
	<tr>
		<td valign="top">
			<input id="{$id}_radio1" class="{$id}Radio inputRadio {if $complexField}complexField{/if}" 
			name="{if $complexField}{$complexField}{$id}[add_parameter][{$complexStep}]{else}{$id}[add_parameter]{/if}" 
			value="1" {if $value.add_parameter == 1 || $value.add_parameter == ''}checked="checked"{/if} 
			onclick="emailChoosen(); displayInput(false, '{$id}_1');" onfocus="emailChoosen(); displayInput(false, '{$id}_1');"  type="radio" />&nbsp;[[Send applications to this e-mail]]:</td>
		<td>
			<input value="{if $value.add_parameter == 1}{$value.value}{/if}" 
			class="inputString" style='width:250px;' name="{$id}[value]" 
			{if $value.add_parameter == 2}disabled="disabled"{/if} id="{$id}_1" 
			type="text" onclick="emailChoosen();" onfocus="emailChoosen();" /></td>
	</tr>
	<tr>
		<td valign="top">
		<input id="{$id}_radio2" class="inputRadio {if $complexField}complexField{/if}" 
		name="{if $complexField}{$complexField}[{$id}[add_parameter][{$complexStep}]{else}{$id}[add_parameter]{/if}" 
		value="2" {if $value.add_parameter == 2}checked="checked"{/if} 
		onfocus="urlChoosen(); displayInput(false, '{$id}_2');"  onclick="urlChoosen(); displayInput(false, '{$id}_2');" type="radio" />[[Redirect to this URL]]:</td>
		<td>
			<input value="{if $value.add_parameter == 2}{$value.value}{/if}" 
			class="inputString {if $complexField}complexField{/if}" 
			style='width:250px;' 
			name="{if $complexField}{$complexField}[{$id}][{$complexStep}][value]{else}{$id}[value]{/if}" 
			id="{$id}_2" {if $value.add_parameter != 2}disabled="disabled"{/if} 
			type="text" onclick="urlChoosen();"  />
			<input type="button" name="browse" value="Test URL" onclick="getUrl('{$id}_2')" />
			<br />
			<span style="font-size:11px">[[Use the following format:]] <i><b>http://</b>yoursite.com</i></span>
		</td>
	</tr>
</table>
