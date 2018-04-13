<?php  /* Smarty version 2.6.14, created on 2018-02-08 15:30:11
         compiled from view.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'view.tpl', 8, false),array('modifier', 'escape', 'view.tpl', 98, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
<?php  echo '
$.ui.dialog.defaults.bgiframe = true;
function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
	reloadPage = false;
	$("#messageBox").dialog( \'destroy\' ).html(\''; ?>
<img style="vertical-align: middle" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/progbar.gif" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please, wait ...<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if(newPageReload == true) {
				if(reloadPage == true)
					parent.document.location.reload();
			}
		}
	}).dialog( \'open\' );
	$.get(url, function(data){
		$("#messageBox").html(data);  
	});
	return false;
}

function SaveAd(noteId, url){
	$.get(url, function(data){
		$("#"+noteId).html(data);  
	});
}
'; ?>

</script>

<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Application Tracking<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error_code'] => $this->_tpl_vars['error_message']):
?>
	<font size="3" class="error">
		<?php  if ($this->_tpl_vars['error_code'] == 'NO_SUCH_FILE'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No such file<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php  elseif ($this->_tpl_vars['error_code'] == 'NO_SUCH_APPS'): ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No such application with this ID<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php  endif; ?>
	</font>
<?php  endforeach; endif; unset($_from); ?>
<form method="post" name="applicationFilter" action=""  id="applications">
<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select Job Posting<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
	<select name="appJobId">
		<option value=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  $_from = $this->_tpl_vars['appJobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appJob']):
?>
		<option value="<?php  echo $this->_tpl_vars['appJob']['id']; ?>
"<?php  if ($this->_tpl_vars['appJob']['id'] == $this->_tpl_vars['current_filter']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['appJob']['title']; ?>
</option>
	<?php  endforeach; endif; unset($_from); ?>
	</select>
	<?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires')): ?>
	<select name="score">
		<option value=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Any Score<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
		<option value="passed" <?php  if ($this->_tpl_vars['score'] == 'passed'): ?> selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Passed<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
		<option value="not_passed" <?php  if ($this->_tpl_vars['score'] == 'not_passed'): ?> selected="selected"<?php  endif; ?>><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Not Passed<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	</select>
	<?php  endif; ?>
<input type="submit" name="applicationFilterSubmit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />


<form method="post" name="applicationForm" action="">
	<input type="hidden" name="orderBy" value="<?php  echo $this->_tpl_vars['orderBy']; ?>
" />
	<input type="hidden" name="order" value="<?php  echo $this->_tpl_vars['order']; ?>
" />
	<input id="action" type="hidden" name="action" value="" />
	<p><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="if (confirm('<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure you want to delete selected application(s)?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>')) submitForm('delete');" /> / <input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Approve selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="submitForm('approve'); return false;" /> / <input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reject selected<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="submitForm('reject')" /></p>
	
	<table border="0" cellpadding="0" cellspacing="0" class="tableSearchResultApplications" width="100%">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th class="pointedInListingInfo2"><input type="checkbox" id="all_checkboxes_control"></th>
				<th class="pointedInListingInfo2" width="15%"><a href="?orderBy=date&amp;order=<?php  if ($this->_tpl_vars['orderBy'] == 'date' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif;   if ($this->_tpl_vars['current_filter']): ?>&amp;appJobId=<?php  echo $this->_tpl_vars['current_filter'];   endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date Applied<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=title&amp;order=<?php  if ($this->_tpl_vars['orderBy'] == 'title' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif;   if ($this->_tpl_vars['current_filter']): ?>&amp;appJobId=<?php  echo $this->_tpl_vars['current_filter'];   endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Title<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=applicant&amp;order=<?php  if ($this->_tpl_vars['orderBy'] == 'applicant' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif;   if ($this->_tpl_vars['current_filter']): ?>&amp;appJobId=<?php  echo $this->_tpl_vars['current_filter'];   endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Applicant’s Name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th class="pointedInListingInfo2"><a href=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attached Resume<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires')): ?>
				<th class="pointedInListingInfo2" colspan="2"><a href="?orderBy=score&amp;order=<?php  if ($this->_tpl_vars['orderBy'] == 'score' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif;   if ($this->_tpl_vars['current_filter']): ?>&amp;appJobId=<?php  echo $this->_tpl_vars['current_filter'];   endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Score<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<?php  endif; ?>
				<th class="pointedInListingInfo2"><a href="?orderBy=status&amp;order=<?php  if ($this->_tpl_vars['orderBy'] == 'status' && $this->_tpl_vars['order'] == 'asc'): ?>desc<?php  else: ?>asc<?php  endif;   if ($this->_tpl_vars['current_filter']): ?>&amp;appJobId=<?php  echo $this->_tpl_vars['current_filter'];   endif; ?>"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<?php  $_from = $this->_tpl_vars['applications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['applications'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['applications']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['application']):
        $this->_foreach['applications']['iteration']++;
?>
		<tr>
			<td>&nbsp;</td>
			<td rowspan="3" class="ApplicationPointedInListingInfo2" width="1"><input type="checkbox" name="applications[<?php  echo $this->_tpl_vars['application']['id']; ?>
]" value="1" id="checkbox_<?php  echo $this->_foreach['applications']['iteration']; ?>
" /></td>
			<td class="ApplicationPointedInListingInfo" width="10%"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['application']['date'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['application']['date'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
			<td class="ApplicationPointedInListingInfo"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-job-details/<?php  echo $this->_tpl_vars['application']['job']['sid']; ?>
/"><?php  echo $this->_tpl_vars['application']['job']['Title']; ?>
</a></td>
			<td class="ApplicationPointedInListingInfo"><?php  echo $this->_tpl_vars['application']['user']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['application']['user']['LastName']; ?>
 <br/>
					<?php  if ($this->_tpl_vars['application']['user']['sid']): ?>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/send/?to=<?php  echo $this->_tpl_vars['application']['user']['sid']; ?>
" onclick="popUpWindow('<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/?to=<?php  echo $this->_tpl_vars['application']['user']['username']; ?>
', 560, 440, '<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', true, <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>true<?php  else: ?>false<?php  endif; ?>); return false;"  class="pm_send_link"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Private Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
					<?php  else: ?>
						<a href="mailto:<?php  echo $this->_tpl_vars['application']['email']; ?>
" class="pm_send_link"><?php  echo $this->_tpl_vars['application']['email']; ?>
</a>
					<?php  endif; ?>
			</td>
			<td class="ApplicationPointedInListingInfo">
					<?php  if ($this->_tpl_vars['application']['resume']): ?>- <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['application']['resume']; ?>
/"><?php  echo $this->_tpl_vars['application']['resumeInfo']['Title']; ?>
</a><?php  endif; ?>
					<?php  if ($this->_tpl_vars['application']['file']): ?><br />- <a href="?appsID=<?php  echo $this->_tpl_vars['application']['id']; ?>
&amp;filename=<?php  echo ((is_array($_tmp=$this->_tpl_vars['application']['file'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View Attached File<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php  endif; ?>
			</td>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires')): ?>
			<td class="ApplicationPointedInListingInfo"><?php  echo $this->_tpl_vars['application']['score']; ?>
</td>
			<td class="ApplicationPointedInListingInfo"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/applications/view-questionaire/<?php  echo $this->_tpl_vars['application']['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['application']['passing_score'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
			<?php  endif; ?>
			<td class="ApplicationPointedInListingInfo" width="10%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['application']['status'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td <?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires')): ?>colspan="7"<?php  else: ?>colspan="5"<?php  endif; ?> class="ApplicationPointedInListingInfo">
				<div class="applicationCommentsHeader"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cover Letter<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong></div>
				<div class="applicationComments">
					<?php  echo $this->_tpl_vars['application']['comments']; ?>

				</div>
				<br/>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td <?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires')): ?>colspan="7"<?php  else: ?>colspan="5"<?php  endif; ?> class="ApplicationPointedInListingInfo">
			<div  id = 'formNote_<?php  echo $this->_tpl_vars['application']['id']; ?>
'>
			<?php  if ($this->_tpl_vars['application']['note']): ?>
			<div class="applicationCommentsHeader"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>:</div>
			<div class="applicationComments">
				<?php  echo $this->_tpl_vars['application']['note']; ?>

			</div>
			<br/>
			<?php  endif; ?>
			</div>
			<span id='notes_<?php  echo $this->_tpl_vars['application']['id']; ?>
'>
				<?php  if ($this->_tpl_vars['application']['note'] != ''): ?>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?apps_id=<?php  echo $this->_tpl_vars['application']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['application']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-notes/?apps_id=<?php  echo $this->_tpl_vars['application']['id']; ?>
&page=apps'); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
				<?php  else: ?>
					<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?apps_id=<?php  echo $this->_tpl_vars['application']['id']; ?>
" onclick="SaveAd( 'formNote_<?php  echo $this->_tpl_vars['application']['id']; ?>
', '<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-notes/?apps_id=<?php  echo $this->_tpl_vars['application']['id']; ?>
&page=apps'); return false;"  class="action"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add notes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
				<?php  endif; ?>
			<br /><br />
			</td>
		</tr>
		<?php  endforeach; else: ?>
		<tr>
			<td colspan="8" class="pointedInListingInfo"><br/><center><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have no Applications now<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></center><br/></td>
		</tr>
		<?php  endif; unset($_from); ?>
	</table>
</form>

<script type="text/javascript">
var total = <?php  echo $this->_foreach['applications']['total']; ?>
;
<?php  echo '

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById(\'checkbox_\' + i))
			checkbox.checked = param;
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});

function submitForm(action) {
	document.getElementById(\'action\').value = action;
	var form = document.applicationForm;
	form.submit();
}

</script>
'; ?>