<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.form.js"></script>
{breadcrumbs}Backup/Restore{/breadcrumbs}
<h1>Backup/Restore</h1>
<div id="error" class="error" style="display:none;"></div>
	<div id="settingsPane">
		<ul class="ui-tabs-nav">
			<li class="ui-tabs-selected"><a href="#backup"><span>Backup</span></a></li>
			<li class="ui-tabs-unselect"><a href="#restore"><span>Restore</span></a></li>
			<li class="ui-tabs-unselect"><a href="{$GLOBALS.site_url}/backup/?action=created_backups"><span>Created Backups</span></a></li>
		</ul>
		<div id="backup" class="ui-tabs-panel">
		<form method="post" action="">
			<input type="hidden" name='action' value='backup' />
            Backup Type &nbsp;

            <select name='backup_type' id='backup_type'>
                <option value="full">Full site backup</option>
                <option value="database">Site database only</option>
                <option value="files">Site files only</option>
            </select>

            &nbsp; <input  type='button' name='save' class="grayButton" value='Generate Backup' onclick='submitForm()'>

            <div id='progbar'></div>
		</form>
		</div>
	
		<div id="restore" class="ui-tabs-panel ui-tabs-hide">
		<form method="post" action="" enctype="multipart/form-data" id='restoreForm' onsubmit = "return restore();">
			<input type="hidden" name='action' value='restore' />
            Backup File &nbsp;
            <input type='file' name='restore_file'>
            &nbsp; <input type='submit' name='save' value='Restore Now' class="grayButton" />

            <div class="clr"><br/></div>
            <div id='progbarRestore'></div>
		</form>
		</div>
	</div>	

{literal}
<script type="text/javascript">
	$(document).ready(function(){
		$("#settingsPane").tabs();
	});

	function submitForm() {
		var url = "{/literal}{$GLOBALS.site_url}/backup/{literal}";
		var backup_type = $('#backup_type').val();
		var identifier = "{/literal}{$identifier}{literal}";
		$("#progbar").html('{/literal}<img style="vertical-align: middle" src="{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif" alt="Please, wait ..." />Please, wait ...{literal}');
		$.post(url, {action: "backup", backup_type: backup_type, identifier: identifier}, function(data){
			
		});
		setTimeout('check()',5000);
	}

	function restore() {
		var options = {
				  url:  "{/literal}{$GLOBALS.site_url}/backup/{literal}",
				  identifier: "{/literal}{$identifier}{literal}"
				}; 
		$("#restoreForm").ajaxSubmit(options);
		$("#progbarRestore").html('{/literal}<img style="vertical-align: middle" src="{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif" alt="Please, wait ..." /> Please, wait ...{literal}');
		setTimeout('restoreCheck()',5000);
		return false;
	}
	
	function check() {
		var url = "{/literal}{$GLOBALS.site_url}/backup/{literal}";
		var identifier = "{/literal}{$identifier}{literal}";
		$.post(url, {action: "check", identifier: identifier}, function(data){
			$("#error").hide();
			if (data == 1) {
				setTimeout('check()',2000);
			}
			else if (data == 'error' || data.search('Error') != -1) {
				$("#progbar").html('');
				$.post(url, {action: "error"}, function(data){
					$("#error").html(data);
					$("#error").show();
				});
			}
			else {
				$("#progbar").html('');
				window.location = data;
			}
				
		});
	}

	function restoreCheck() {
		var url = "{/literal}{$GLOBALS.site_url}/backup/{literal}";
		var identifier = "{/literal}{$identifier}{literal}";
		$.post(url, {action: "check", identifier: identifier}, function(data){
			$("#error").hide();
			if (data == 1) {
				setTimeout('restoreCheck()',2000);
			}
			else if (data == 'error' || data.search('Error') != -1) {
				$("#progbarRestore").html('');
				$.post(url, {action: "error"}, function(data){
					$("#error").html(data);
					$("#error").show();
				});
			}
			else {
				$("#progbarRestore").html('');
				window.location = data;
			}
		});
	}
</script>
{/literal}