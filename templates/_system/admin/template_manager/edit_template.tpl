<script language="JavaScript" type="text/javascript">
<!--//
 
var ModulesFunctions = new Array();
{foreach from=$LIST_FUNCTIONS key=KEY_MOD item=VALUE_ARRAY_FUNC}  				    	
	ModulesFunctions["{$KEY_MOD}"]=[[-1,'Choose function:']{foreach from=$VALUE_ARRAY_FUNC key=KEY_FUNC item=VALUE_FUNC},[{$KEY_FUNC},'{$VALUE_FUNC}']{/foreach}];
{/foreach}

var Params = new Array();
{foreach from=$LIST_PARAMS key=KEY_MOD item=VALUE_ARRAY_FUNC}
  {foreach from=$VALUE_ARRAY_FUNC key=KEY_FUNC item=VALUE_ARRAY_PARAM}
     Params["{$KEY_MOD}", "{$KEY_FUNC}"]=[[-1,'reserved']{foreach from=$VALUE_ARRAY_PARAM key=KEY_PARAM item=VALUE_PARAM},[{$KEY_PARAM},'{$VALUE_PARAM}']{/foreach}];
  {/foreach}   
{/foreach}

{literal}

function loadFunctionsForModule(form) {	
    document.getElementById("table_params").innerHTML = '';	
    
	module_value = form.modules.options[form.modules.selectedIndex].text;
	form.functions.options.length=0;
	for (var i = 0; i < ModulesFunctions[module_value].length; i++) {
		newOpt = document.createElement("option");
		newOpt.text = ModulesFunctions[module_value][i][1];
		form.functions.options.add(newOpt);
	}	
}

function loadParamsForFunction() {
  document.getElementById("table_params").innerHTML = '<b>There are no parameters for this function</b>';
  cbModules=document.getElementById("modules");
  cbFunctions=document.getElementById("functions");	  
  module_value = cbModules[cbModules.selectedIndex].text;
  function_value = cbFunctions[cbFunctions.selectedIndex].text;  


  if ( (module_value != "Choose module:") && (function_value != "Choose function:") ) {
     strHTML = '';     
     for (var i = 1; i < Params[module_value,function_value].length; i++) {
        str_key = 'value_param' + (i-1);
        
        strHTML = strHTML + "<tr><td>"+ Params[module_value,function_value][i][1] +
         		  "</td><td>= <input type='text' name='"+ Params[module_value,function_value][i][1] +"' id='"+ str_key +"' value='' class='text' size=15> </td></tr>";   		   						           		  
     } //for
     if (strHTML != '') {
     	strHTML = '<table class="fieldset" name="table_parameters">'+ strHTML + '</table>';
     	document.getElementById("table_params").innerHTML = strHTML;     
     }     
  } //if
}

function insertStr() {

   tArea = document.getElementById("template_content");
   tArea.focus();  

   cbModules=document.getElementById("modules");
   cbFunctions=document.getElementById("functions");	  
 
   module_value = cbModules[cbModules.selectedIndex].text;
   function_value = cbFunctions[cbFunctions.selectedIndex].text;  

   if ( (module_value != "Choose module:") && (function_value != "Choose function:") ) 
   {
     str_param = '';
     i = 0;
     while (1==1) {  
        param = document.getElementById("value_param" + i);    
	    if (param == null) break; 
	    key_param   = param.name;      
	    value_param = trim(param.value);
	    if (value_param != '') {
		    if (str_param == '')
		      str_param = key_param +"=\""+ value_param +"\"";
		    else
		      str_param = str_param +" "+ key_param +"=\""+ value_param +"\"";    
		}
//alert(str_param);
	    i++;    
	 }
	 if (str_param != '') str_param = " "+str_param; 
	 
	 str_ins = "{module name=\""+ module_value +"\" function=\"" + function_value +"\""+ str_param +"}"; 
     
	 if (document.selection) // IE
	 {   
		var s = document.selection.createRange(); 
		s.text = str_ins;
		s.select(); 	   
	 }
	 else 
	 {
		if (typeof(tArea.selectionStart) != "undefined")   // Mozilla
			cursor = tArea.selectionStart;	
		else											   // other browser
			cursor = tArea.length;	
			
		str = tArea.value;
		strBeg = str.substr(0, cursor);
		strEnd = str.substr(cursor, (str.length - cursor) );
				
		scrTop = tArea.scrollTop;	
		tArea.value = strBeg + str_ins + strEnd;
		tArea.scrollTop = scrTop;				
			
	 }   
   }	   
}

{/literal}
//-->
</script>

{if $ERROR eq "MODULE_DOES_NOT_EXIST"}
	<p class="error">There is no such module.</p>
{elseif $ERROR eq "TEMPLATE_DOES_NOT_EXIST"}
	<p class="error">There is no such template.</p>
{elseif $ERROR eq "NOT_ALLOWED_IN_DEMO"}
	<p class="error">Template is not editable in demo.</p>
{else}

	{if $ERROR eq "CANNOT_FETCH_TEMPLATE"}
		<p class="error">Cannot fetch template "{$template_name}"</p>
	{elseif $ERROR eq "TEMPLATE_IS_NOT_WRITEABLE"}
		<p class="error">Template is not writeable.</p>
	{else}
		{if $show_insert_form == 0}
			<div class="clr"><br/></div>
			<div class="setting_button" id="fullButton"><strong>Click to insert module function</strong><div class="setting_icon"><div id="accordeonClosed"></div></div></div>
			<div class="setting_block" id="fullSettingBlock" style="display: none">
			{else}
				<div class="setting_block" id="fullSettingBlock">
			{/if}
		
			<form action="" method="POST" id="form1">
				<table width="100%" id="clearTable">
					<tr>
					<td valign="top">
						<table width="100%" id="clearTable">
							<tr>
								<td>Module</td>
								<td>    	    
									<select size="1" name="module" id="modules" class="list" onchange="loadFunctionsForModule(this.form)" LANGUAGE="Javascript">	    
										<option selected>Choose module:</option>
									    {foreach from=$LIST_MODULES key=KEY_MOD item=VALUE_MOD}  				    
										    <option> {$VALUE_MOD} </option>  	    	
									  	{/foreach}
									</select>
									
								</td>
							</tr>
							<tr>
								<td>Function</td>
								<td>
									<select size="1" name="function" id="functions" class="list" onchange="loadParamsForFunction()" LANGUAGE="Javascript">	    				
										<option selected>Choose function:</option>		
									    {foreach from=$LIST_FUNCTIONS[$user_page.module] key=KEY_FUNC item=VALUE_FUNC}  				    		    	
										    <option> {$VALUE_FUNC} </option>  	    	
									  	{/foreach}
									</select>  	
								</td>
							</tr>		
						</table>
			      	</td>
			      	</tr>
			    </table>
			      
			    <table width="100%" id="clearTable">
			    	<tr>
			    		<td>Parameters:</td>
			    	</tr>
					<tr>
						<td><div id="table_params"></div></td>
					</tr>
					<tr>
						<td><span class="greenButtonInEnd"><input type="button" class="greenButtonIn" name="btnInsStr" value=" Insert" size=5  onclick="insertStr(this.form)" LANGUAGE="Javascript"></span></td>
					</tr>
				</table>
			</div>
			  	
			<table width="100%">		
				<tr>
					<td><textarea id="template_content" name="template_content" class="text" style="width:100%;height:400px">{$template_content|escape}</textarea></td>
				</tr>
				<tr id="clearTable">
					<td><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
				</tr>
			</table>
		      
				<!--<input type="button" name="btnInsStr" value=" Insert" size=5  onclick="insertStr(this.form)" LANGUAGE="Javascript">-->
				
				<input type="hidden" name="template_name" value="{$template_name}">
				<input type="hidden" name="module_name" value="{$module_name}">
				<input type="hidden" name="action" value="save_template">
			</form>

	{/if}
{/if}

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>

<script>
{literal}

$( function() {

	$(".setting_button").click(function(){
		var butt = $(this);
		$(this).next(".setting_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
					butt.children("strong").text("Click to hide");
				} else {
					butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
					butt.children("strong").text("Click to insert module function");
				}
			});
	});	
});

{/literal}
</script>
