<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:51:33
         compiled from users.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'users.tpl', 35, false),array('function', 'image', 'users.tpl', 294, false),array('function', 'cycle', 'users.tpl', 342, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
<?php  echo '
<script type="text/javascript">
	$.ui.dialog.defaults.bgiframe = true;
	var progbar = "<img src=\'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/progbar.gif<?php  echo '\'>";
	var parentReload = false;
	$(function() {
		$(".getUser").click(function(){
			$("#dialog").dialog(\'destroy\');
			$("#dialog").attr({title: "Loading"});
			$("#dialog").html(progbar).dialog({width: 180});
			var link = $(this).attr("href");
			$.get(link, function(data){
				$("#dialog").dialog(\'destroy\');
				$("#dialog").attr({title: "User Membership Plan Details"});
				$("#dialog").html(data).dialog({
					width: 560,
					close: function(event, ui) {
						$("#expired_date").datepicker( \'hide\' );
						if(parentReload == true) {
							parent.document.location.reload();
					}}
				});
			});
			return false;
			});
		

		$("#change_plan_send_button").click(function(){
			val = $("#plan_select").val();
			$("#plan_to_change").val( val );
			$("input[name=\'action_name\']").val(\'change_plan\');
			$("#change_plan_dialog").dialog(\'destroy\').html("';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please wait...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '" + progbar).dialog( {width: 200});
			$("form[name=\'users_form\']").submit();
		});

		$("#user_reject_send_button").click(function(){
			val = $("#rejection_reason_text").val();
			$("#rejection_reason").val(val);
			$("input[name=\'action_name\']").val(\'reject\');
			$("#user_reject_dialog").dialog(\'destroy\').html("';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please wait...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '" + progbar).dialog( {width: 200});
			$("form[name=\'users_form\']").submit();
		});
		
		$("tr[id^=\'users\']").click(function(){
			var name = ($(this).attr(\'id\'));
			if( !$(this).attr(\'style\') ) {
				$("input[name=\'" + name + "\']").attr(\'checked\',\'checked\');
				$(this).attr(\'style\',\'background-color: #ffcc99\');
				
			}else {
				$(this).removeAttr(\'style\');
				$("input[name=\'" + name + "\']").removeAttr(\'checked\');
			}

			});
		
	});

	function mem_plans ( link ) {
		$("#dialog").dialog(\'destroy\');
		$("#dialog").attr({title: "Loading"});
		$("#dialog").html(progbar).dialog({width: 180});
		$.get(link, function(data){
			$("#dialog").dialog(\'destroy\');
			$("#dialog").attr({title: "User Membership Plans"});
			$("#dialog").html(data).dialog({
				width: 400,
				close: function(event, ui) {
				}
			});
		});			
	}
	
	function login_as_user( name, pass ) {
		$.get(\'';   echo $this->_tpl_vars['GLOBALS']['site_url'];   echo '/login-as-user/\', { username: name, password: pass}, function (data) {
			var response = $.trim(data);
			if (response == "") {
				document.login.username.value = name;
				document.login.password.value = pass;
				document.getElementById(\'login\').submit();
			}
			else {
				popUpWindow(300,100,\'Error\',data);
			}
		});
	}

	function popUpWindow(widthWin, heightWin, title, message){
		$("#messageBox").dialog( \'destroy\' ).html(message);
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title
			
		}).dialog( \'open\' );
		
		return false;
	}

	function go( button ){
		if($("input:checked").length > 0 && $("#selectedAction_"+button).val() != \'\'){
			var action = $("#selectedAction_"+button).val();

			switch ( action ) {
			case \'send_activation_letter\':
				var users = [];
				var userids = [];
				users = $("input:checked");
			
				for (var i = 0; i < users.length; i++) {
					userids[i] = users[i].name.substring(users[i].name.indexOf(\'[\')+1,users[i].name.lastIndexOf(\']\'));
				}
			
				var progbar = "<img src=\'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/progbar.gif<?php  echo '\'>";
				$(function() {
					var data = \'\';
					$("#dialog").dialog(\'destroy\');
					$("#dialog").attr({title: "Loading"});
					$("#dialog").html(progbar).dialog({width: 180});
					
					$.get("';   echo $this->_tpl_vars['GLOBALS']['site_url'];   echo '/send-activation-letter/",{\'userids[]\':userids, ajax:true}, function(data){
			
						$("#dialog").dialog(\'destroy\');
						$("#dialog").attr({title: "Sending activation emails "});
						$("#dialog").html(data).dialog({width: 300});
					});
				});
				break;
			case \'reject\':
				$("#user_reject_dialog").dialog(\'destroy\');
				$("#user_reject_dialog").dialog({title: "User Rejection", width: 350});
				break;
			case \'change_plan\':
				$("#change_plan_dialog").dialog(\'destroy\');
				$("#change_plan_dialog").dialog({title: "Change Membership Plan", width: 350});
				break;
			case \'delete\':
				if ( !confirm(\'Are you sure you want to delete selected user(s)?\') )
					break;
			default:
				document.getElementById( \'action_name\' ).value = action;
				var form = document.users_form;
				form.submit();
			}		
		} else {
			$(function() {
				$("#dialog").dialog(\'destroy\');
				$("#dialog").attr({title: "Information"});
				$("#dialog").html("Please choose an action first").dialog({width: 300});
			});
		} 
	}
	</script>
'; ?>


<?php  if ($this->_tpl_vars['rangeIPs']): ?>
	<div id="bannedIPsInfo" title="Attention!" style='display:none'>
		<p>
			<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
			The range of the IP addresses has been banned. That's why you are not able to unblock the following IP addresses:
			<?php  $_from = $this->_tpl_vars['rangeIPs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['IP']):
?>
				<b><?php  echo $this->_tpl_vars['IP']; ?>
</b><br/>
			<?php  endforeach; endif; unset($_from); ?>
		</p>
	</div>
	<?php  echo '
	<script type="text/javascript"><!--
	$("#bannedIPsInfo").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Close: function() {
				$(this).dialog(\'close\');
			}
		}
	});
	--></script>
	'; ?>

<?php  endif; ?>

<?php  if ($this->_tpl_vars['cantBanUsers']): ?>
	<div id="usersInfo" title="Attention!" style='display:none'>
		<p>
			<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
			IPs of the following users were not defined, therefore they can’t be banned:<br/>
			<?php  $_from = $this->_tpl_vars['cantBanUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['username']):
?>
				<b><?php  echo $this->_tpl_vars['username']; ?>
</b><br/>
			<?php  endforeach; endif; unset($_from); ?>
		</p>
	</div>
	<?php  echo '
	<script type="text/javascript"><!--
	$("#usersInfo").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Close: function() {
				$(this).dialog(\'close\');
			}
		}
	});
	--></script>
	'; ?>

<?php  endif; ?>

<div id="dialog" style="display: none"></div>

<form id="login" name="login" target="_blank"  action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
../../login/" method="post">
	<input type="hidden" name="action" value="login">
	<input type="hidden" name="as_user">
	<input type="hidden" name="username" value="">
	<input type="hidden" name="password" value="">
</form>

<form method="post" name="users_form">
<input type="hidden" name="action_name" id="action_name" value="">
<input type="hidden" name="plan_to_change" id="plan_to_change" value="">
<input type="hidden" name="rejection_reason" id="rejection_reason" value="">

<div id="change_plan_dialog" style="display: none">
	Select Action:
	<select name="plan_select" id="plan_select" style="width: 219px;">
		<option value='0'>Clear Subscriptions</option>
			<?php  $_from = $this->_tpl_vars['plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plan']):
?>
				<option value="<?php  echo $this->_tpl_vars['plan']['id']; ?>
">Add <?php  echo $this->_tpl_vars['plan']['caption']; ?>
</option>
			<?php  endforeach; endif; unset($_from); ?>
	</select>
	<div class="clr"><br/></div>
	<span class="greenButtonEnd"><input type="submit" id="change_plan_send_button" name="change_plan_send_button" value="Change" class="greenButton" /></span>
</div>

<div id="user_reject_dialog" style="display: none">
	Enter Reject Reason:
	<textarea name="rejection_reason_text" id="rejection_reason_text" style="width: 315px; height: 200px;"></textarea>
	<div class="clr"><br/></div>
	<span class="greenButtonEnd"><input type="submit" id="user_reject_send_button" name="user_reject_send_button" value="Reject" class="greenButton" /></span>
</div>
<div class="clr"><br/></div>
<div style="display:inline-block;">
<div class="actionSelected">
     Actions with Selected:
     <select id="selectedAction_up" name="selectedAction_up">
          <option value="">Select action</option>
          <option value="activate">Activate</option>
          <option value="deactivate">Deactivate</option>
          <?php  if ($this->_tpl_vars['ApproveByAdminChecked']): ?>
          <option value="approve">Approve</option>
          <option value="reject">Reject</option>
          <?php  endif; ?>
          <option value="send_activation_letter">Send Activation Email</option>
          <option value="delete">Delete</option>
          <option value="change_plan">Change Plan</option>
          <option value="ban_ip">Ban IP</option>
          <option value="unban_ip">Unban IP</option>
     </select>
     <span class="greenButtonEnd"><input type="button" value="Go" class="greenButton" onclick="go('up');"/></span>
</div>

<div class="numberPerPage">
	<strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Number of users per page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong>
	<select id="users_per_page" name="users_per_page" onchange="window.location = '?user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&restore=1<?php  if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>&users_per_page='+this.value;" class="perPage">
		<option value="10" <?php  if ($this->_tpl_vars['users_per_page'] == 10): ?>selected="selected"<?php  endif; ?>>10</option>
		<option value="20" <?php  if ($this->_tpl_vars['users_per_page'] == 20): ?>selected="selected"<?php  endif; ?>>20</option>
		<option value="50" <?php  if ($this->_tpl_vars['users_per_page'] == 50): ?>selected="selected"<?php  endif; ?>>50</option>
		<option value="100" <?php  if ($this->_tpl_vars['users_per_page'] == 100): ?>selected="selected"<?php  endif; ?>>100</option>
	</select>
</div>

<div class="clr"><br/></div>

<div class="numberPage">
	<?php  $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
		<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['currentPage']): ?>
			<strong><?php  echo $this->_tpl_vars['page']; ?>
</strong>
		<?php  else: ?>
			<?php  if ($this->_tpl_vars['page'] == $this->_tpl_vars['totalPages'] && $this->_tpl_vars['currentPage'] < $this->_tpl_vars['totalPages']-3): ?> ... <?php  endif; ?>
			<a href="?user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&page=<?php  echo $this->_tpl_vars['page'];   if ($this->_tpl_vars['sorting_field'] != null): ?>&sorting_field=<?php  echo $this->_tpl_vars['sorting_field'];   endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif;   if ($this->_tpl_vars['sorting_order'] != null): ?>&sorting_order=<?php  echo $this->_tpl_vars['sorting_order'];   endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   echo $this->_tpl_vars['searchFields']; ?>
"><?php  echo $this->_tpl_vars['page']; ?>
</a>
			<?php  if ($this->_tpl_vars['page'] == 1 && $this->_tpl_vars['currentPage'] > 4): ?> ... <?php  endif; ?>
		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
</div>
<div class="clr"></div>

<table>
	<thead>
		<tr>
			<th><input type="checkbox" id="all_checkboxes_control"></th>
			<th>
	            <a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=users.sid&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'users.sid'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">ID</a>
   				<?php  if ($this->_tpl_vars['sorting_field'] == 'users.sid'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=username&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'username'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">Username</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'username'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=user_group&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'user_group'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">User Group</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'user_group'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
            <?php  if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>
            <th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=LastName&LastName=<?php  echo $this->_tpl_vars['LastName']; ?>
&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'LastName'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif; ?>">Last Name</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'LastName'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
            <?php  else: ?>
             <th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=CompanyName&CompanyName=<?php  echo $this->_tpl_vars['CompanyName']; ?>
&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'CompanyName'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif; ?>">Company Name</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'CompanyName'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
            <?php  endif; ?>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=email&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'email'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">Email</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'email'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<?php  if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?> <th>Membership Plan</th> <?php  endif; ?>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=registration_date&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'registration_date'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">Registration Date</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'registration_date'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=active&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'active'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">Status</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'active'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<?php  if ($this->_tpl_vars['ApproveByAdminChecked']): ?>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=approval&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'approval'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">Approval Status</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'approval'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<?php  endif; ?>
			<th>
				<a href="?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
&sorting_field=ip&sorting_order=<?php  if ($this->_tpl_vars['sorting_order'] == 'ASC' && $this->_tpl_vars['sorting_field'] == 'ip'): ?>DESC<?php  else: ?>ASC<?php  endif; ?>&users_per_page=<?php  echo $this->_tpl_vars['users_per_page'];   if ($this->_tpl_vars['online'] == 1): ?>&online=1<?php  endif;   if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>&LastName=<?php  echo $this->_tpl_vars['LastName'];   else: ?>&CompanyName=<?php  echo $this->_tpl_vars['CompanyName'];   endif; ?>">IP Address</a>
				<?php  if ($this->_tpl_vars['sorting_field'] == 'ip'):   if ($this->_tpl_vars['sorting_order'] == 'ASC'): ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_down_arrow.gif"><?php  else: ?><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
b_up_arrow.gif"><?php  endif;   endif; ?>
			</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	<?php  $_from = $this->_tpl_vars['found_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['users_block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['users_block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['found_user']):
        $this->_foreach['users_block']['iteration']++;
?>
		<tr id="users[<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
]" class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
			<td><input type="checkbox" name="users[<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['users_block']['iteration']; ?>
"></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?user_sid=<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
" title="Edit"><b><?php  echo $this->_tpl_vars['found_user']['sid']; ?>
</b></a></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?user_sid=<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
" title="Edit"><b><?php  echo $this->_tpl_vars['found_user']['username']; ?>
</b></a></td>
			<td><?php  echo $this->_tpl_vars['found_user']['user_group']; ?>
</td>
            <td><?php  if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>
					<?php  echo $this->_tpl_vars['found_user']['LastName']; ?>

				<?php  else: ?>
					<?php  echo $this->_tpl_vars['found_user']['CompanyName']; ?>

				<?php  endif; ?></td>
			<!-- for ie -->	<td style="word-break: break-all;"><!-- for firefox--><div style="word-wrap: break-word; width: 130px;"><a href="mailto:<?php  echo $this->_tpl_vars['found_user']['email']; ?>
"><?php  echo $this->_tpl_vars['found_user']['email']; ?>
</a></div></td>
			<?php  if ($this->_tpl_vars['user_group_name'] == 'JobSeeker'): ?>
				<td><?php  $_from = $this->_tpl_vars['found_user']['membership_plan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['membership_plan']):
?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-membership-plan/?userId=<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
&contract_id=<?php  echo $this->_tpl_vars['membership_plan']['id']; ?>
" target="_blank" class="getUser"><?php  echo $this->_tpl_vars['membership_plan']['name']; ?>
</a><br/><?php  endforeach; endif; unset($_from); ?></td> 
			<?php  endif; ?>
			<td><?php  echo $this->_tpl_vars['found_user']['registration_date']; ?>
</td>
			<td>
				<?php  if ($this->_tpl_vars['found_user']['active'] == '1'): ?>
					Active
				<?php  else: ?>
					Not Active
				<?php  endif; ?>
			</td>
			<?php  if ($this->_tpl_vars['ApproveByAdminChecked']): ?>
			<td><?php  echo $this->_tpl_vars['found_user']['approval']; ?>
</td>
			<?php  endif; ?>	
			<td><?php  if ($this->_tpl_vars['found_user']['ip_is_banned'] == 1): ?><p class='error'><?php  echo $this->_tpl_vars['found_user']['ip']; ?>
</p><?php  else:   echo $this->_tpl_vars['found_user']['ip'];   endif; ?></td>
			<td><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/?user_sid=<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
" title="Edit"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
edit.png" border=0 alt="Edit"></a></td>
			<td><?php  if ($this->_tpl_vars['found_user']['membership_plan']): ?><span class="greenButtonEnd"><input type="button" name="button" value="Change Plan" class="greenButton" id="ChangePlan" onclick="mem_plans('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-membership-plans/?userId=<?php  echo $this->_tpl_vars['found_user']['sid']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_name']; ?>
');"></span><?php  endif; ?></td>
			<td><span class="greenButtonEnd"><input type="button" name="button" value="Login" class="greenButton" onclick="login_as_user('<?php  echo $this->_tpl_vars['found_user']['username']; ?>
', '<?php  echo $this->_tpl_vars['found_user']['password']; ?>
');"></span></td>
		</tr>
	<?php  endforeach; endif; unset($_from); ?>
</table>

<div class="clr"><br/></div>
<div class="actionSelected">
	Actions with Selected:
	<select id="selectedAction_down" name="selectedAction_down" >
		<option value="">Select action</option>
		<option value="activate">Activate</option>
		<option value="deactivate">Deactivate</option>
		<?php  if ($this->_tpl_vars['ApproveByAdminChecked']): ?>
        <option value="approve">Approve</option>
        <option value="reject">Reject</option>
        <?php  endif; ?>
		<option value="send_activation_letter">Send Activation Email</option>
		<option value="delete">Delete</option>
		<option value="change_plan">Change Plan</option>
		<option value="ban_ip">Ban IP</option>
		<option value="unban_ip">Unban IP</option>
	</select>
	<span class="greenButtonEnd"><input type="button" value="Go" class="greenButton" onclick="go('down');"></span>
</div>
</div>

<script>
var total=<?php  echo $this->_foreach['users_block']['total']; ?>
;
var user_group_name="<?php  echo $this->_tpl_vars['user_group_name']; ?>
";
<?php  echo '

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById(\'checkbox_\' + i)) {
			checkbox.checked = param;
		}
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false){
		set_checkbox(false);
		$("tr[id^=\'users\']").removeAttr(\'style\');
	}else {
		set_checkbox(true);
		$("tr[id^=\'users\']").attr( \'style\',\'background-color: #ffcc99\' );
	}
});

$(document).ready(function(){
		if(user_group_name=="JobSeeker")
			$(\'#Manage_Job_Seekers\').addClass(\'lmsih\');
		else
			$(\'#Manage_Employers\').addClass(\'lmsih\');
 });

'; ?>

</script>