<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:51:32
         compiled from user_search_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'user_search_form.tpl', 1, false),array('function', 'search', 'user_search_form.tpl', 9, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Users<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Manage <?php  echo $this->_tpl_vars['page_title']; ?>
s</h1>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-user/?user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
">Add a New <?php  echo $this->_tpl_vars['page_title']; ?>
</a></p>

<div class="setting_button" id="mediumButton"><strong>Click to modify search criteria</strong><div class="setting_icon"><div id="accordeonClosed"></div></div></div>
<div class="setting_block" style="display: none"  id="clearTable">
	<form method="get" name="search_form">
		<table  width="100%">
			<tr><td>User ID:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'sid'), $this);?>
</td></tr>
			<tr><td>Username:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'username','template' => "string.like.tpl"), $this);?>
</td></tr>
            
             <?php  if ($this->_tpl_vars['user_group_name'] == 'Employer'): ?>
             <tr><td>Company Name:</td><td><input type="text" name="CompanyName" value="<?php  echo $this->_tpl_vars['CompanyName']; ?>
"/></td></tr>
             <?php  else: ?>
             <tr><td>Last Name:</td><td><input type="text" name="LastName" value="<?php  echo $this->_tpl_vars['LastName']; ?>
"/></td></tr>
             <?php  endif; ?>
             
           			             <tr><td>First Name:</td><td><input type="text" name="FirstName" value="<?php  echo $this->_tpl_vars['FirstName']; ?>
"/></td></tr>
					 
		    <tr><td>Email:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'email','template' => "string.like.tpl"), $this);?>
</td></tr>
		    <!--<tr><td>User Group:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'user_group'), $this);?>
</td></tr>-->
		    <tr><td>Registration Date:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'registration_date'), $this);?>
</td></tr>
			<tr>
				<td>Membership Plan:</td>
				<td><select name="membership_plan[simple_equal]">
						<option value="">Any</option>
					<?php  $_from = $this->_tpl_vars['plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plan']):
?>
						<option value="<?php  echo $this->_tpl_vars['plan']['id']; ?>
" <?php  if ($this->_tpl_vars['membership_plan']['simple_equal'] == $this->_tpl_vars['plan']['id']): ?>selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['plan']['caption']; ?>
</option>
					<?php  endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
		    <tr><td>Status:</td><td><?php  echo $this->_plugins['function']['search'][0][0]->tpl_search(array('property' => 'active'), $this);?>
</td></tr>
		    <tr><td>Online:</td><td><input type="checkbox" value="1" name="online" <?php  if ($this->_tpl_vars['online']): ?>checked="checked"<?php  endif; ?> /></td></tr>
		
		 <?php  if ($this->_tpl_vars['user_group_name'] == 'Employer'): ?>
		  <tr>	
		  	<td>Browse Company Name:</td>
		  	<td>
				<?php  $_from = $this->_tpl_vars['alphabets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['alphabet'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['alphabet']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['alphabet']):
        $this->_foreach['alphabet']['iteration']++;
?>  
				<div>
					<div class="browseCompanyAB">
						<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company-admin/?first_char=any_char">#</a>
					</div>
					<?php  $_from = $this->_tpl_vars['alphabet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['char'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['char']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['char']):
        $this->_foreach['char']['iteration']++;
?>  
					<div class="browseCompanyAB">
						<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-company-admin/?first_char=<?php  echo $this->_tpl_vars['char']; ?>
"><?php  echo $this->_tpl_vars['char']; ?>
</a>
					</div>
					<?php  endforeach; endif; unset($_from); ?>
					<div class="clr"></div>
				</div>
				<?php  endforeach; endif; unset($_from); ?>
			</td>
		  </tr>
		  
		  
		  
		  
		  		
	<?php  else: ?>
		  <tr>	
		  	<td>Browse Job Seeker's Name:</td>
		  	<td>
				<?php  $_from = $this->_tpl_vars['alphabets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['alphabet'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['alphabet']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['alphabet']):
        $this->_foreach['alphabet']['iteration']++;
?>  
				<div>
					<div class="browseCompanyAB">
						<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-usernamejs-admin/?first_char=any_char">#</a>
					</div>
					<?php  $_from = $this->_tpl_vars['alphabet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['char'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['char']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['char']):
        $this->_foreach['char']['iteration']++;
?>  
					<div class="browseCompanyAB">
						<a class='browseItem' href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/browse-by-usernamejs-admin/?first_char=<?php  echo $this->_tpl_vars['char']; ?>
"><?php  echo $this->_tpl_vars['char']; ?>
</a>
					</div>
					<?php  endforeach; endif; unset($_from); ?>
					<div class="clr"></div>
				</div>
				<?php  endforeach; endif; unset($_from); ?>
			</td>
		  </tr>		  
	<?php  endif; ?>
				
			
			<tr>
				<td>&nbsp;</td>
				<td>
		            <input type="hidden" name="action" value="search" />
                    <input type="hidden" name="user_group_id" value="<?php  echo $this->_tpl_vars['user_group_name']; ?>
" />
					<span class="greenButtonEnd"><input type="submit" value="Search" class="greenButton" /></span>
				</td>
			</tr>
		</table>
	</form>
</div>

<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
<script>
	$( function () {
	
		var dFormat = '<?php  echo $this->_tpl_vars['GLOBALS']['current_language_data']['date_format']; ?>
';
		<?php  echo '
		dFormat = dFormat.replace(\'%m\', "mm");
		dFormat = dFormat.replace(\'%d\', "dd");
		dFormat = dFormat.replace(\'%Y\', "yy");
		
		$("#registration_date_notless, #registration_date_notmore").datepicker({dateFormat: dFormat, showOn: \'button\', yearRange: \'-99:+99\', buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/calendar.gif<?php  echo '\', buttonImageOnly: true });
				
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("<div id=\'accordeonOpen\'></div>");
						butt.children("strong").text("Click to hide search criteria");
					} else {
						butt.children(".setting_icon").html("<div id=\'accordeonClosed\'></div>");
						butt.children("strong").text("Click to modify search criteria");
					}
				});
		});
	
		'; ?>

	
	});
</script>