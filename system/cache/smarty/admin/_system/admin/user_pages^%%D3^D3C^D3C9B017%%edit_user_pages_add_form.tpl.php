<?php  /* Smarty version 2.6.14, created on 2018-04-01 03:26:08
         compiled from edit_user_pages_add_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'edit_user_pages_add_form.tpl', 88, false),)), $this); ?>
<script language="JavaScript" type="text/javascript">
<!--//

var ModulesFunctions = new Array();
<?php  $_from = $this->_tpl_vars['LIST_FUNCTIONS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_MOD'] => $this->_tpl_vars['VALUE_ARRAY_FUNC']):
?>  				    	
	ModulesFunctions["<?php  echo $this->_tpl_vars['KEY_MOD']; ?>
"]=[[-1,'Choose function:']<?php  $_from = $this->_tpl_vars['VALUE_ARRAY_FUNC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_FUNC'] => $this->_tpl_vars['VALUE_FUNC']):
?>,[<?php  echo $this->_tpl_vars['KEY_FUNC']; ?>
,'<?php  echo $this->_tpl_vars['VALUE_FUNC']; ?>
']<?php  endforeach; endif; unset($_from); ?>];
<?php  endforeach; endif; unset($_from); ?>

var Params = new Array();
<?php  $_from = $this->_tpl_vars['LIST_PARAMS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_MOD'] => $this->_tpl_vars['VALUE_ARRAY_FUNC']):
?>
  <?php  $_from = $this->_tpl_vars['VALUE_ARRAY_FUNC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_FUNC'] => $this->_tpl_vars['VALUE_ARRAY_PARAM']):
?>
     Params["<?php  echo $this->_tpl_vars['KEY_MOD']; ?>
", "<?php  echo $this->_tpl_vars['KEY_FUNC']; ?>
"]=[[-1,'reserved']<?php  $_from = $this->_tpl_vars['VALUE_ARRAY_PARAM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_PARAM'] => $this->_tpl_vars['VALUE_PARAM']):
?>,[<?php  echo $this->_tpl_vars['KEY_PARAM']; ?>
,'<?php  echo $this->_tpl_vars['VALUE_PARAM']; ?>
']<?php  endforeach; endif; unset($_from); ?>];
  <?php  endforeach; endif; unset($_from); ?>   
<?php  endforeach; endif; unset($_from); ?>

<?php  echo '

function loadFunctionsForModule(form) {	
    document.getElementById("table_params").innerHTML = \'\';	
   	  	    
	module_value = form.modules.options[form.modules.selectedIndex].text;
	form.functions.options.length=0;
	for (var i = 0; i < ModulesFunctions[module_value].length; i++) {
		newOpt = document.createElement("option");
		newOpt.text = ModulesFunctions[module_value][i][1];
		form.functions.options.add(newOpt);
	}
}

function loadParamsForFunction() {
  document.getElementById("table_params").innerHTML = \'\'; 

  cbModules=document.getElementById("modules");
  cbFunctions=document.getElementById("functions");	  
  module_value = cbModules[cbModules.selectedIndex].text;
  function_value = cbFunctions[cbFunctions.selectedIndex].text;  

  if ( (module_value != "Choose module:") && (function_value != "Choose function:") ) {
     strHTML = \'\';
     for (var i = 1; i < Params[module_value,function_value].length; i++) {
        str_key = \'value_param\' + (i-1);
        
        strHTML = strHTML + "<tr><td>"+ Params[module_value,function_value][i][1] +
         		  "</td><td>= <input type=\'text\' name=\'"+ Params[module_value,function_value][i][1] +"\' id=\'"+ str_key +"\' value=\'\' class=\'text\'> </td></tr>";   		   						           		  
     } //for     
     if (strHTML != \'\') {
     	strHTML = \'<table class="fieldset" name="table_parameters">\'+ strHTML + \'</table>\';
     	document.getElementById("table_params").innerHTML = strHTML;     
     }
  } //if  
  
}

function formTextOfParams() {
  str_param = \'\';
  i = 0;
  while (1==1) {  
    param = document.getElementById("value_param" + i);    
    if (param == null) break; 
    key_param   = param.name;      
    value_param = trim(param.value);
    if (value_param != \'\') {
	    if (str_param == \'\')
	      str_param = key_param +"="+ value_param;
	    else
	      str_param = str_param +"\\r\\n"+ key_param +"="+ value_param;    
	}
    i++;    
  }
  document.getElementById("parameters").value = str_param;
}	

// *************************************************************************

function check() {
  obj_params = document.getElementById("table_params");
  obj_params.innerHTML = "";
} 


'; ?>



//-->
</script>

<?php  if ($this->_tpl_vars['IS_NEW'] == 1): ?>
    <?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-pages/">Site Pages</a> &#187; Add User Page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <h1>Add User Page</h1>
<?php  else: ?>
    <?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-pages/">Site Pages</a> &#187; Edit User Page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <h1>Edit User Page</h1>
<?php  endif; ?>

    <?php  $_from = $this->_tpl_vars['ERRORS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ERROR'] => $this->_tpl_vars['ERROR_DATA']):
?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'URI_NOT_SPECIFIED'): ?><p class="error">The page URI is not specified</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'MODULE_NOT_SPECIFIED'): ?><p class="error">Module is not specified</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'FUNCTION_NOT_SPECIFIED'): ?><p class="error">Function is not specified</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'ADD_ERROR'): ?><p class="error">Cannot add new User Page. (must be not exist module and function)</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'CHANGE_ERROR'): ?><p class="error">Cannot change data of User Page. (must be not exist module and function)</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'PAGE_EXISTS'): ?><p class="error">Page with such URI is already exist</p><?php  endif; ?>	
    	<?php  if ($this->_tpl_vars['ERROR'] == 'DELETE_PAGE'): ?><p class="error">Page URI is not defined</p><?php  endif; ?>
    	<?php  if ($this->_tpl_vars['ERROR'] == 'NON_EXISTENT_MODULE'): ?><p class="error">Module named "<?php  echo $this->_tpl_vars['ERROR_DATA']; ?>
" does not exist.</p><?php  endif; ?> 
    	<?php  if ($this->_tpl_vars['ERROR'] == 'PAGE_ALREADY_EXISTS'): ?><p class="error">User page with such uri already exists</p><?php  endif; ?> 
    <?php  endforeach; endif; unset($_from); ?>

<form name="form1" method="post">
	<input type="hidden" name="action" value="<?php  echo $this->_tpl_vars['action']; ?>
">
	<fieldset>
		<legend><?php  if ($this->_tpl_vars['IS_NEW'] == 1): ?>Add a New User Page<?php  else: ?>Edit User Page<?php  endif; ?></legend>
		<table>
			<tr><td colspan="2"><input type="hidden" name="ID" value="<?php  echo $this->_tpl_vars['user_page']['ID']; ?>
" class="text" /></td></tr>
			<tr>
				<td>URI</td>
				<td><input type="text" name="uri" value="<?php  echo $this->_tpl_vars['user_page']['uri']; ?>
" class="text" /></td>
			</tr>
			<tr>
				<td>Pass parameters via URI</td>
				<td><input type="checkbox" name="pass_parameters_via_uri" <?php  if ($this->_tpl_vars['user_page']['pass_parameters_via_uri']): ?> checked <?php  endif; ?> class="text" /></td>
			</tr>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title" value="<?php  echo $this->_tpl_vars['user_page']['title']; ?>
" class="text" /></td>
			</tr>
			<tr>
				<td>Template</td>
				<td><input type="text" name="template" value="<?php  echo $this->_tpl_vars['user_page']['template']; ?>
" class="text" /></td>
			</tr>
			<tr>
				<td>Module</td>
				<td>
					<select size="1" name="module" id="modules" class="list" onchange="loadFunctionsForModule(this.form)" LANGUAGE="Javascript">	    
						<option selected>Choose module:</option>
					    <?php  $_from = $this->_tpl_vars['LIST_MODULES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_MOD'] => $this->_tpl_vars['VALUE_MOD']):
?>  				    
						    <?php  if ($this->_tpl_vars['VALUE_MOD'] == $this->_tpl_vars['user_page']['module']): ?> <option selected> <?php  echo $this->_tpl_vars['VALUE_MOD']; ?>
 </option> 
						    <?php  else: ?> <option> <?php  echo $this->_tpl_vars['VALUE_MOD']; ?>
 </option>  	    	
						    <?php  endif; ?>				
					  	<?php  endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Function</td>
				<td>
					<select size="1" name="function" id="functions" class="list" onchange="loadParamsForFunction()" LANGUAGE="Javascript">	    				
						<option selected>Choose function:</option>		
					    <?php  $_from = $this->_tpl_vars['LIST_FUNCTIONS'][$this->_tpl_vars['user_page']['module']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_FUNC'] => $this->_tpl_vars['VALUE_FUNC']):
?>  				    		    	
						    <?php  if ($this->_tpl_vars['VALUE_FUNC'] == $this->_tpl_vars['user_page']['function']): ?> <option selected> <?php  echo $this->_tpl_vars['VALUE_FUNC']; ?>
 </option> 
						    <?php  else: ?> <option> <?php  echo $this->_tpl_vars['VALUE_FUNC']; ?>
 </option>  	    	
						    <?php  endif; ?>				
					  	<?php  endforeach; endif; unset($_from); ?>
				</td>
			</tr>
			<tr>
				<td valign=top>Parameters:</td>
				<td> 
					<div id="table_params">
						<table class="fieldset" name="table_parameters">
					    <?php  $_from = $this->_tpl_vars['LIST_PARAMS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_MOD'] => $this->_tpl_vars['VALUE_ARRAY_FUNC']):
?>  				    
					      <?php  if (( $this->_tpl_vars['KEY_MOD'] == $this->_tpl_vars['user_page']['module'] )): ?>
					    	<?php  $_from = $this->_tpl_vars['VALUE_ARRAY_FUNC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_FUNC'] => $this->_tpl_vars['VALUE_ARRAY_PARAM']):
?>  				    	    
					      	  <?php  if (( $this->_tpl_vars['KEY_FUNC'] == $this->_tpl_vars['user_page']['function'] )): ?>	    	
								<?php  $_from = $this->_tpl_vars['VALUE_ARRAY_PARAM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['KEY_PARAM'] => $this->_tpl_vars['VALUE_PARAM']):
?>			
					    		  <tr><td> <?php  echo $this->_tpl_vars['VALUE_PARAM']; ?>
 </td>
					    		  <?php  $this->assign('flag_param', '0'); ?>
								  <?php  $_from = $this->_tpl_vars['a_params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_a'] => $this->_tpl_vars['value_a']):
?>			
								    <?php  if (( $this->_tpl_vars['key_a'] == $this->_tpl_vars['VALUE_PARAM'] )): ?>  
					    		   		<td>= <input type="text" name="<?php  echo $this->_tpl_vars['VALUE_PARAM']; ?>
" id="value_param<?php  echo $this->_tpl_vars['KEY_PARAM']; ?>
" value="<?php  echo $this->_tpl_vars['value_a']; ?>
" class="text"> </td>
					    		   		<?php  $this->assign('flag_param', '1'); ?>
								    <?php  endif; ?>
								  <?php  endforeach; endif; unset($_from); ?>
								  <?php  if (( $this->_tpl_vars['flag_param'] == 0 )): ?>
				    		   		<td>= <input type="text" name="<?php  echo $this->_tpl_vars['VALUE_PARAM']; ?>
" id="value_param<?php  echo $this->_tpl_vars['KEY_PARAM']; ?>
" value="" class="text"> </td>				  
								  <?php  endif; ?>	
								  </tr>	      	  
					    		<?php  endforeach; endif; unset($_from); ?>	      	  
				    	      <?php  endif; ?>				
					  	    <?php  endforeach; endif; unset($_from); ?>
						  <?php  endif; ?>				
					  	<?php  endforeach; endif; unset($_from); ?>
					  	</table>
				  	</div>
				</td>
			</tr>
			<tr>
				<td coslpan="2"><input type="hidden" name="parameters" id="parameters" value="<?php  echo $this->_tpl_vars['user_page']['parameters']; ?>
" class="text" /></td>
			</tr>
			<tr>
				<td valign="top">Keywords</td>
				<td><textarea name="keywords" class="text" cols=55 rows=4><?php  echo $this->_tpl_vars['user_page']['keywords']; ?>
</textarea></td>
			</tr>
			<tr>
				<td valign=top>Description</td>
				<td><textarea name="description" class="text" cols=55 rows=4><?php  echo $this->_tpl_vars['user_page']['description']; ?>
</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="<?php  if ($this->_tpl_vars['IS_NEW'] == 1): ?>Add<?php  else: ?>Update<?php  endif; ?>" class="greenButton" onclick="formTextOfParams()" LANGUAGE="Javascript"></span></td>
			</tr>
		</table>
	</fieldset>
</form>